<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectTaskResource;
use App\Models\Comment;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $projects = Project::with(['user'])->latest()->get();
        $users = User::all();
        $parent_id = $request->input('projectId') ?? 1;

        return inertia('ProjectTask/Create', compact('projects', 'users', 'parent_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'department' => 'required|string',
            'participants' => 'required|array|min:1',
            'priority' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $project_task = ProjectTask::create($request->except('participants') + ['user_id' => auth()->id()]);

        foreach ($request->participants as $user_id) {
            // Adjuntar el usuario a la tarea
            $project_task->participants()->attach($user_id);
        }

        $project_task->addAllMediaFromRequest('media')->each(fn ($file) => $file->toMediaCollection('files'));

        return to_route('projects.show', ['project' => $request->project_id]);
    }
    
    public function show(ProjectTask $project_task)
    {
        //
    }

    public function edit(ProjectTask $project_task)
    {
        //
    }

    public function update(Request $request, ProjectTask $project_task)
    {
        
        $validated = $request->validate([
            'status' => 'required|string|max:255',
            'description' => 'nullable',
            'title' => 'required|string|max:255',
            'department' => 'required|string',
            'priority' => 'nullable|string',
            'participants' => 'nullable|array',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $project_task->update($validated);

        $project_task->participants()->sync($request->participants);

        if ($request->comment) {
            $comment = new Comment([
                'body' => $request->comment,
                'user_id' => auth()->id(),
            ]);
            $project_task->comments()->save($comment);
        }

        $this->handleUpdatedTaskStatus($project_task->project_id);


        return response()->json(['item' => ProjectTaskResource::make($project_task->fresh(['participants', 'project', 'user', 'comments.user', 'media']))]);
    }

    public function destroy(ProjectTask $project_task)
    {
        $project_task->comments()->delete();
        $project_task->delete();
    }

    public function comment(Request $request, ProjectTask $project_task)
    {
        $comment = new Comment([
            'body' => $request->comment,
            'user_id' => auth()->id(),
        ]);

        $project_task->comments()->save($comment);

        // $mentions = $request->mentions;
        //mencionar a algun usuario
        // foreach ($mentions as $mention) {
        //     $user = User::find($mention['id']);
        //     $user->notify(new MentionNotification($project_task, "", 'projects'));
        // }
        
        return response()->json(['item' => $comment->fresh('user')]);
    }

    public function pausePlayTask(ProjectTask $project_task)
    {
        if ($project_task->is_paused) {
            $project_task->update([
                'is_paused' => false
            ]);
        } else {
            $project_task->update([
                'is_paused' => true
            ]);
        }
        $project_task->save();

        return response()->json(['item' => ProjectTaskResource::make($project_task->fresh(['participants', 'project', 'user', 'comments.user', 'media']))]);
    }

    public function updateStatus(ProjectTask $project_task, Request $request)
    {
        $project_task->update(['status' => $request->status]);
        $this->handleUpdatedTaskStatus($project_task->project_id);

        return response()->json([]);
    }

    public function getLateTasks()
    {
        $late_tasks = ProjectTask::with(['participants', 'project'])->where('status', '!=', 'Terminada')->whereDate('end_date', '<', today())->get();

        $currentDate = today();

        $late_tasks = $late_tasks->map(function ($task) use ($currentDate) {
            $lateDays = $task->end_date->diffInDays($currentDate); // Calcula la diferencia en días entre end_date y la fecha actual
            $task['late_days'] = $lateDays; // Agrega la propiedad "late_days" al objeto de la tarea
            return $task;
        });

        return response()->json(['items' => $late_tasks]);
    }

    private function handleUpdatedTaskStatus($project_id)
    {
        // Obtén el proyecto al que pertenece la tarea
        $project = Project::with('tasks')->find($project_id);

        // Verifica si todas las tareas del proyecto están terminadas y actualiza propiedad finished_at
        if ($project->tasks->where('status', 'Terminada')->count() === $project->tasks->count()) {
            $project->finished_at = now();
            $project->save();
        } else if ($project->finished_at !== null) {
            $project->finished_at = null;
            $project->save();
        }
    }
}
