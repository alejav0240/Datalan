<header class="sticky top-0 py-4 shadow-lg bg-gradient-to-r from-white to-blue-50 animate__animated animate__fadeInDown z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
        <!-- LOGO -->
        <a href="#inicio" class="flex items-center space-x-3 group">
            <img src="https://datalanbo.com/assets/img/logodatalan.png" alt="Datalan Bolivia" class="h-12 transition-transform duration-300 group-hover:scale-110">
            <span class="text-xl font-bold text-blue-600 group-hover:text-blue-800 transition-colors duration-300">Datalan Bolivia</span>
        </a>

        <!-- MENÚ PRINCIPAL -->
        <nav class="hidden xl:block">
            <ul class="flex items-center space-x-8">
                <li><a href="#inicio" class="text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-300">Inicio</a></li>
                <li><a href="#empresa" class="text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-300">Empresa</a></li>
                <li><a href="#servicios" class="text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-300">Servicios</a></li>
                <li><a href="#productos" class="text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-300">Productos</a></li>
                <li><a href="#contacto" class="text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-300">Contacto</a></li>
                <li><a href="#reportar-falla" class="text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-300">Reportar Falla</a></li>
                <li>
                    <a href="{{route('login')}}" class="btn font-bold py-1 px-3 sm:py-2 sm:px-4 md:py-2 md:px-5 border border-blue-500 rounded-full text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-md text-xs sm:text-sm md:text-base">
                        <i class="fas fa-user-circle me-1"></i> Iniciar Sesión
                    </a>
                </li>
            </ul>
        </nav>

        <!-- BOTÓN HAMBURGUESA (solo visible en pantallas pequeñas) -->
        <button class="xl:hidden text-gray-800 focus:outline-none" id="hamburger-btn">
            <i class="fas fa-bars fa-lg"></i>
        </button>
    </div>

    <!-- MENÚ LATERAL (aparece al hacer clic en el botón hamburguesa) -->
    <div class="md:hidden bg-white w-full absolute top-16 left-0 px-6 py-4 shadow-lg" id="mobile-menu" style="display: none;">
        <ul class="flex flex-col space-y-4">
            <li><a href="#inicio" class="text-gray-800 font-semibold hover:text-blue-600">Inicio</a></li>
            <li><a href="#empresa" class="text-gray-800 font-semibold hover:text-blue-600">Empresa</a></li>
            <li><a href="#servicios" class="text-gray-800 font-semibold hover:text-blue-600">Servicios</a></li>
            <li><a href="#productos" class="text-gray-800 font-semibold hover:text-blue-600">Productos</a></li>
            <li><a href="#contacto" class="text-gray-800 font-semibold hover:text-blue-600">Contacto</a></li>
            <li><a href="#reportar-falla" class="text-gray-800 font-semibold hover:text-blue-600">Reportar Falla</a></li>
            <li>
                <a href="{{route('login')}}" class="btn font-bold py-2 px-5 border border-blue-500 rounded-full text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-md text-base">
                    <i class="fas fa-user-circle me-1"></i> Iniciar Sesión
                </a>
            </li>
        </ul>
    </div>
</header>

<!-- Script para manejar el menú hamburguesa -->
<script>
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    hamburgerBtn.addEventListener('click', () => {
        // Alterna la visibilidad del menú
        mobileMenu.style.display = (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') ? 'block' : 'none';
    });
</script>
