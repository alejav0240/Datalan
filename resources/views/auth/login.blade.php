<x-authentication-layout>
    <h1 class="text-3xl text-gray-800 dark:text-gray-100 font-bold mb-6">{{ __('Bienvenido!') }}</h1>
    
    <!-- Mostrar mensaje de éxito -->
    @if (session('success'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de Login -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />                
            </div>
            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="current-password" />                
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <div class="mr-1">
                    <a class="text-sm underline hover:no-underline" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                </div>
            @endif            
            <x-button type="submit" class="ml-3 bg-amber-200 hover:bg-amber-300 text-black font-semibold py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                {{ __('Ingresar') }}
            </x-button>
        </div>
    </form>
    <x-validation-errors class="mt-4" />   

    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-gray-100 dark:border-gray-700/60">
        <div class="text-sm">
            {{ __('¿No tienes una cuenta?') }} <a class="font-medium text-violet-500 hover:text-violet-600 dark:hover:text-violet-400" href="{{ route('register') }}">{{ __('Regístrate') }}</a>
        </div>
    </div>
</x-authentication-layout>
