<template>
    <div class="h-screen flex flex-col sm:justify-center items-center sm:pt-0 bg-zinc-800">
        <figure class="absolute w-full">
            <img class="h-screen w-full" src="@/../../public/assets/images/fondo_login.png" alt="fondo">
        </figure>

        <div class="h-[400px] lg:h-[90%] w-[80%] px-1 py-1 bg-white overflow-hidden rounded-[30px] z-40 lg:grid grid-cols-2">
            <div class="items-center justify-center flex flex-col">
                <div class="mb-10">
                    <slot name="logo" />
                </div>
                <div class=" lg:w-1/2">
                    <slot />
                </div>
            </div>
            <figure class="h-[87%] flex justify-end">
                <img class="h-full rounded-[30px]" src="@/../../public/assets/images/fondo_login_interno.png" alt="fondo">
            </figure>
        </div>
    </div>
</template>
