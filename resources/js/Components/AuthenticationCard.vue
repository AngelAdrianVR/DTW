<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 bg-zinc-800">
        <figure class="absolute w-full">
            <img class="h-full w-full" src="@/../../public/assets/images/fondo_login.png" alt="fondo">
        </figure>

        <div class="h-[400px] lg:h-[800px] w-[80%] mt-6 px-6 py-4 bg-white overflow-hidden rounded-[30px] z-40 lg:grid grid-cols-2">
            <div class="items-center justify-center flex flex-col">
                <div class="mb-10">
                    <slot name="logo" />
                </div>
                <div class=" lg:w-1/2">
                    <slot />
                </div>
            </div>
            <figure class="w-full">
                <img class="h-full w-full" src="@/../../public/assets/images/fondo_login_interno.png" alt="fondo">
            </figure>
        </div>
    </div>
</template>
