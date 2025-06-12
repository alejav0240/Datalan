@props(['cliente', 'direcciones', 'reportes'])

<header class="sticky top-0 py-4 shadow-lg bg-gradient-to-r from-white to-blue-50 animate__animated animate__fadeInDown z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
        {{-- LOGO --}}
        <a href="#inicio" class="flex items-center space-x-3 group">
            <img src="https://datalanbo.com/assets/img/logodatalan.png" alt="Datalan Bolivia"
                 class="h-12 transition-transform duration-300 group-hover:scale-110">
            <span class="text-xl font-bold text-blue-600 group-hover:text-blue-800 transition-colors duration-300">
                Datalan Bolivia
            </span>
        </a>

        {{-- MENÚ PRINCIPAL --}}
        <nav class="hidden xl:block">
            <ul class="flex items-center space-x-8 font-semibold text-gray-800">
                @foreach (['#inicio' => 'Inicio', '#empresa' => 'Empresa', '#servicios' => 'Servicios', '#productos' => 'Productos', '#contacto' => 'Contacto'] as $href => $label)
                    <li><a href="{{ $href }}" class="hover:text-blue-600 transition-colors duration-300">{{ $label }}</a></li>
                @endforeach

                @auth
                    @if(Auth::user()->role == 'cliente')
                        <li><a href="#agregar-direccion" class="hover:text-blue-600 transition-colors duration-300">Direcciones y Reportes</a></li>
                    @endif
                @endauth
            </ul>
        </nav>

        {{-- USUARIO / SESIÓN --}}
        <div class="flex items-center space-x-4 xl:block">
            @guest
                <a href="{{ route('login') }}"
                   class="btn font-bold py-2 px-5 border border-blue-500 rounded-full text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-md text-sm">
                    <i class="fas fa-user-circle me-1"></i> Iniciar Sesión
                </a>
            @else
                <div class="relative">
                    <button id="user-menu-btn"
                            class="btn font-bold py-1 px-4 border border-blue-500 rounded-full text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-md text-sm flex items-center">
                        <i class="fas fa-user-circle me-1"></i> {{ $cliente->nombre }}
                    </button>

                    <div id="user-menu"
                         class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-50">
                        <div class="flex flex-col">
                            <button id="abrirDirecciones"
                                    class="w-full py-2 px-4 text-sm font-bold text-blue-600 hover:bg-blue-100 transition">
                                <i class="fas fa-map-marker-alt me-1"></i> Mis Direcciones
                            </button>

                            <button id="abrirReportes"
                                    class="w-full py-2 px-4 text-sm font-bold text-blue-600 hover:bg-blue-100 transition">
                                <i class="fas fa-exclamation-triangle me-1"></i> Mis Reportes
                            </button>

                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit"
                                        class="w-full py-2 px-4 text-sm font-bold text-red-500 hover:bg-red-500 hover:text-white transition rounded-b-lg">
                                    <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest

            {{-- HAMBURGUESA --}}
            <button id="hamburger-btn" class="xl:hidden text-gray-800 focus:outline-none">
                <i class="fas fa-bars fa-lg"></i>
            </button>
        </div>
    </div>

    {{-- MENÚ MÓVIL --}}
    <div id="mobile-menu" class="md:hidden bg-white w-full absolute top-16 left-0 px-6 py-4 shadow-lg hidden z-40">
        <ul class="flex flex-col space-y-4 font-semibold text-gray-800">
            @foreach (['#inicio' => 'Inicio', '#empresa' => 'Empresa', '#servicios' => 'Servicios', '#productos' => 'Productos', '#contacto' => 'Contacto'] as $href => $label)
                <li><a href="{{ $href }}" class="hover:text-blue-600">{{ $label }}</a></li>
            @endforeach

            @auth
                @if(Auth::user()->role == 'cliente')
                    <li><a href="#agregar-direccion" class="hover:text-blue-600">Direcciones</a></li>
                    <li><a href="#reportar-falla" class="hover:text-blue-600">Reportar Falla</a></li>
                @endif
            @endauth

            <li class="flex items-center space-x-3">
                @guest

                    <div id="user-menu"
                         class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-50">
                        <div class="flex flex-col">
                            <button id="abrirDirecciones"
                                    class="w-full py-2 px-4 text-sm font-bold text-blue-600 hover:bg-blue-100 transition">
                                <i class="fas fa-map-marker-alt me-1"></i> Mis Direcciones
                            </button>

                            <button id="abrirReportes"
                                    class="w-full py-2 px-4 text-sm font-bold text-blue-600 hover:bg-blue-100 transition">
                                <i class="fas fa-exclamation-triangle me-1"></i> Mis Reportes
                            </button>

                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit"
                                        class="w-full py-2 px-4 text-sm font-bold text-red-500 hover:bg-red-500 hover:text-white transition rounded-b-lg">
                                    <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
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

{{-- MODALES --}}
<x-modals.direcciones-modal :direcciones="$direcciones" />
@auth
    @if(Auth::user()->role == 'cliente')
        <x-modals.reportes-modal :reportes="$reportes" />
    @endif
@endauth

{{-- SCRIPTS --}}
<script>
    const userMenuBtn = document.getElementById('user-menu-btn');
    const userMenu = document.getElementById('user-menu');
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    userMenuBtn?.addEventListener('click', () => {
        userMenu.classList.toggle('hidden');
    });

    hamburgerBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (event) => {
        if (!userMenu.contains(event.target) && !userMenuBtn.contains(event.target)) {
            userMenu.classList.add('hidden');
        }
    });
</script>
