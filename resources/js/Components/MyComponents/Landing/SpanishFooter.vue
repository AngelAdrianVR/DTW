<template>
    <footer class="p-4 text-white bg-[#1A1A1A] min-h-72 mt-24 md:relative overflow-auto rounded-2xl">
        <figure class="w-full">
            <img class="md:w-[9%] w-[29%]" src="@/../../public/assets/images/white_logo.png" alt="" />
        </figure>
        <div class="md:grid grid-cols-3 h-28">
            <div class="border-r border-white flex justify-center items-cente">
                <p class="text-lg">"Liberando tu potencial en linea"</p>
            </div>

            <div class="border-r border-white flex justify-center items-center">
                <div class="flex flex-col">
                    <h2 class="text-center mb-5 text-xl">Contacto</h2>
                    <div>
                        <p><i class="fa-solid fa-phone mr-2 mb-3"></i>3322268824</p>
                        <p>
                            <i class="fa-solid fa-envelope mr-2"></i>contacto@dtw.com.mx
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex justify-center items-center">
                <div class="flex flex-col justify-center items-center">
                    <h2 class="text-center mb-5 text-xl">Síguenos</h2>
                    <div>
                        <a href="https://www.facebook.com/profile.php?id=100094614796876" target="_blank"><i
                                class="fa-brands fa-facebook text-2xl border border-white rounded-full px-3 py-2 cursor-pointer mr-5"></i></a>
                        <a href="https://instagram.com/digital_tw?utm_source=qr&igshid=NGExMmI2YTkyZg%3D%3D"
                            target="_blank"><i
                                class="fa-brands fa-instagram text-2xl border border-white rounded-full px-3 py-2 cursor-pointer"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <a class="hidden md:block" href="">
                <p class="text-xs mt-3 hover:underline">
                    Política de privacidad - Plítica de cookies
                </p>
            </a>
            <a class="hidden md:block" href="">
                <p class="text-xs mt-3 hover:underline">
                    Copyright &copy; {{ currentYear }} Todos los derechos reservados por DTW
                </p>
            </a>
        </div>
    </footer>
</template>

<script>
export default {
data() {
    return {
        currentYear: new Date().getFullYear(),
    };
}
}
</script>
