<header
    class="sticky top-0 py-4 shadow-lg bg-gradient-to-r from-white to-blue-50 animate__animated animate__fadeInDown z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
        <!-- LOGO -->
        <a href="#inicio" class="flex items-center space-x-3 group">
            <img src="https://datalanbo.com/assets/img/logodatalan.png" alt="Datalan Bolivia"
                class="h-12 transition-transform duration-300 group-hover:scale-110">
            <span
                class="text-xl font-bold text-blue-600 group-hover:text-blue-800 transition-colors duration-300">Datalan
                Bolivia</span>
        </a>

        <!-- MENÚ PRINCIPAL -->
        <nav class="hidden xl:block">
            <ul class="flex items-center space-x-8">
                <li><a href="#inicio"
                        class="text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-300">Inicio</a>
                </li>
                <li><a href="#empresa"
                        class="text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-300">Empresa</a>
                </li>
                <li><a href="#servicios"
                        class="text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-300">Servicios</a>
                </li>
                <li><a href="#productos"
                        class="text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-300">Productos</a>
                </li>
                <li><a href="#contacto"
                        class="text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-300">Contacto</a>
                </li>
                @auth
                    <li><a href="#agregar-direccion"
                            class="text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-300">Información Extra</a></li>
                @endauth
                    @guest
                        <a href="{{ route('login') }}"
                            class="btn font-bold py-2 px-5 border border-blue-500 rounded-full text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-md text-base">
                            <i class="fas fa-user-circle me-1"></i> Iniciar Sesión
                        </a>
                    @else
                        <div class="relative">
                            <button id="user-menu-btn"
                                class="btn font-bold py-1 px-4 border border-blue-500 rounded-full text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-md text-sm flex items-center">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </button>
                            <div id="user-menu"
                                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-50">
                                <div class="flex flex-col items-center">
                                    <button id="abrirDirecciones"
                                        class="w-full text-blue-600 hover:bg-blue-100 py-2 px-4 text-sm font-bold text-center transition-all duration-300">
                                        <i class="fas fa-map-marker-alt me-1"></i> Mis Direcciones
                                    </button>

                                    <form action="{{ route('logout') }}" method="POST" class="block text-center w-full">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-red-500 hover:bg-red-500 hover:text-white py-2 px-4 text-sm font-bold rounded-lg transition-all duration-300">
                                            <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script>
                            const userMenuBtn = document.getElementById('user-menu-btn');
                            const userMenu = document.getElementById('user-menu');

                            userMenuBtn.addEventListener('click', () => {
                                userMenu.style.display = (userMenu.style.display === 'none' || userMenu.style.display === '') ? 'block' : 'none';
                            });

                            document.addEventListener('click', (event) => {
                                if (!userMenu.contains(event.target) && !userMenuBtn.contains(event.target)) {
                                    userMenu.style.display = 'none';
                                }
                            });
                        </script>
                    @endguest
                </li>
            </ul>
        </nav>

        <!-- BOTÓN HAMBURGUESA -->
        <button class="xl:hidden text-gray-800 focus:outline-none" id="hamburger-btn">
            <i class="fas fa-bars fa-lg"></i>
        </button>
    </div>

    <!-- MENÚ MÓVIL -->
    <div class="md:hidden bg-white w-full absolute top-16 left-0 px-6 py-4 shadow-lg" id="mobile-menu"
        style="display: none;">
        <ul class="flex flex-col space-y-4">
            <li><a href="#inicio" class="text-gray-800 font-semibold hover:text-blue-600">Inicio</a></li>
            <li><a href="#empresa" class="text-gray-800 font-semibold hover:text-blue-600">Empresa</a></li>
            <li><a href="#servicios" class="text-gray-800 font-semibold hover:text-blue-600">Servicios</a></li>
            <li><a href="#productos" class="text-gray-800 font-semibold hover:text-blue-600">Productos</a></li>
            <li><a href="#contacto" class="text-gray-800 font-semibold hover:text-blue-600">Contacto</a></li>
            @auth
                <li><a href="#agregar-direccion"
                        class="text-gray-800 font-semibold hover:text-blue-600">Información Extra</a></li>
            @endauth
            </li>
            <li class="flex items-center space-x-3">
                @guest
                    <a href="{{ route('login') }}"
                        class="btn font-bold py-2 px-5 border border-blue-500 rounded-full text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-md text-sm">
                        <i class="fas fa-user-circle me-1"></i> Iniciar Sesión
                    </a>
                @else
                    <span class="font-bold text-blue-600 flex items-center">
                        <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="btn font-bold py-2 px-5 border border-red-500 rounded-full text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 shadow-md text-sm">
                            <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                        </button>
                    </form>
                @endguest
            </li>
        </ul>
    </div>
</header>

<!-- MODAL DIRECCIONES -->
<x-modals.direcciones-modal />


<!-- SCRIPTS -->
<script>
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    hamburgerBtn.addEventListener('click', () => {
        mobileMenu.style.display = (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') ? 'block' : 'none';
    });

    const abrirDirecciones = document.getElementById('abrirDirecciones');
    const modalDirecciones = document.getElementById('direccionesModal');
    const contenidoDirecciones = document.getElementById('contenidoDirecciones');
    const cerrarModalDirecciones = document.getElementById('cerrarModalDirecciones');

    if (abrirDirecciones) {
        abrirDirecciones.addEventListener('click', function () {
            modalDirecciones.classList.remove('hidden');
            contenidoDirecciones.innerHTML = '<p class="text-gray-500">Cargando direcciones...</p>';

            fetch('/direcciones-adicionales')
                .then(response => response.json())
                .then(data => {
                    // data es directamente un array
                    if (!Array.isArray(data) || data.length === 0) {
                        contenidoDirecciones.innerHTML = '<p class="text-gray-600">No tienes direcciones adicionales registradas.</p>';
                    } else {
                        const tabla = `
                            <table class="w-full border-collapse border border-gray-300 text-smrounded-lg overflow-hidden shadow-md">
                                <thead>
                                    <tr class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                                        <th class="border border-gray-300 px-4 py-2 font-semibold">Dirección</th>
                                        <th class="border border-gray-300 px-4 py-2 font-semibold">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${data.map(direccion => `
                                        <tr class="hover:bg-blue-100 transition-colors duration-300">
                                            <td class="border border-gray-300 px-4 py-2 text-gray-700">${direccion.direccion}</td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <form action="/direcciones-adicionales/${direccion.id_direccion}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:text-red-700 font-semibold transition-colors duration-300 flex items-center space-x-1">
                                                        <i class="fas fa-trash-alt"></i> <span>Eliminar</span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        `;
                        contenidoDirecciones.innerHTML = tabla;
                    }
                })

        });
    }

    cerrarModalDirecciones.addEventListener('click', function () {
        modalDirecciones.classList.add('hidden');
    });
</script>