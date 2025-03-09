<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = UserResource::collection(User::all()->take(20));
        $total_users = User::all()->count();

        // return $users;
        return inertia('User/Index', compact('users', 'total_users'));
    }

    
    public function create()
    {
        return inertia('User/Create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'created_at' => 'required',
            'employee_properties.phone' => 'required',
            'employee_properties.charge' => 'required',
            'employee_properties.department' => 'required',
        ]);

        $user = User::create($request->all() + ['password' => bcrypt('0000')]);

        return to_route('users.show', $user->id);
    }

    
    public function show($user_id)
    {      
        $user = UserResource::make(User::find($user_id));
        $users = User::all(['id', 'name']);

        // return $user;
        return inertia('User/Show', compact('user','users'));
    }

    
    public function edit(User $user)
    {
        return inertia('User/Edit', compact('user'));
    }

    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'created_at' => 'required',
            'employee_properties.phone' => 'required',
            'employee_properties.charge' => 'required',
            'employee_properties.department' => 'required',
        ]);

        $user->update($request->all());

        return to_route('users.show', $user->id);
    }


    public function destroy(user $user)
    {
        //
    }


    public function getNotifications()
    {
        $items = NotificationResource::collection(auth()->user()->notifications);

        return response()->json(compact('items'));
    }


    public function deleteNotifications(Request $request)
    {
        auth()->user()->notifications()->whereIn('id', $request->notifications_ids)->delete();

        return response()->json(['message' => "Se han eliminado las notificaciones seleccionadas"]);
    }


    public function readNotifications(Request $request)
    {
        $unread = auth()->user()->unreadNotifications->count();
        auth()->user()->notifications->markAsRead();

        return response()->json(compact('unread'));
    }


    public function getItemsByPage($currentPage)
    {
        $offset = $currentPage * 20;
        $users = User::latest()
            ->skip($offset)
            ->take(20)
            ->get();

        return response()->json(['items' => $users]);
    }

    public function fetchDashboardInfo()
    {
        $usersData = User::with('assignedTasks:id,title,status,is_paused,user_id,project_id')
        ->get(['id', 'name', 'employee_properties', 'last_access']);

        return response()->json(compact('usersData'));
    }
}
