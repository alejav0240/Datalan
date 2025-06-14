
<x-app-layout>

<body class="bg-gray-100">
<style>
    .form-card {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .form-section {
        transition: all 0.3s ease;
    }
    .form-section:hover {
        background-color: #f9fafb;
    }
    .input-error {
        border-color: #f56565;
    }
    .error-message {
        color: #f56565;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    .password-toggle {
        cursor: pointer;
        transition: color 0.2s;
    }
    .password-toggle:hover {
        color: #3b82f6;
    }
</style>
<div class="min-h-screen flex flex-col">
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
            <strong class="font-bold">¡Error!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-user-edit mr-2 text-blue-600"></i>Editar Empleado
            </h2>
            <a href="{{ route('empleados.show', $empleado->id) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition flex items-center">
                <i class="fas fa-times mr-2"></i>Cancelar
            </a>
        </div>

        <form action="{{ route('empleados.update', $empleado->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl form-card overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6 flex flex-col md:flex-row items-center">
                    <div class="relative mb-4 md:mb-0 md:mr-6">
                        <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center">
                            <i class="fas fa-user text-blue-600 text-4xl"></i>
                        </div>
                        <button type="button" class="absolute bottom-0 right-0 bg-blue-500 rounded-full p-2 hover:bg-blue-600 transition">
                            <i class="fas fa-camera text-white text-sm"></i>
                        </button>
                    </div>
                    <div class="text-center md:text-left">
                        <h3 class="text-2xl font-bold">{{ $empleado->user->name }}</h3>
                        <div class="mt-2">
                            @php
                                $roleColors = [
                                    'empleado' => 'bg-blue-500',
                                    'supervisor' => 'bg-yellow-500',
                                    'administrador' => 'bg-red-500',
                                    'cliente' => 'bg-green-500',
                                ];
                            @endphp
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold text-white {{ $roleColors[$empleado->user->role] ?? 'bg-gray-500' }}">
                                    {{ ucfirst($empleado->user->role) }}
                                </span>
                        </div>
                    </div>
                </div>

                <!-- Form Sections -->
                <div class="p-6 space-y-8">
                    <!-- Personal Information -->
                    <div class="form-section p-6 border border-gray-200 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-user-circle text-blue-600 mr-3"></i>
                            Información Personal
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nombre -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nombre Completo <span class="text-red-600">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name', $empleado->user->name) }}"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('name') input-error @enderror"
                                       placeholder="Ingrese el nombre completo">
                                @error('name')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email <span class="text-red-600">*</span>
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email', $empleado->user->email) }}"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('email') input-error @enderror"
                                       placeholder="ejemplo@empresa.com">
                                @error('email')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Teléfono -->
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">
                                    Teléfono <span class="text-red-600">*</span>
                                </label>
                                <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $empleado->telefono) }}"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('telefono') input-error @enderror"
                                       placeholder="+34 600 000 000">
                                @error('telefono')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Cédula de Identidad -->
                            <div>
                                <label for="ci" class="block text-sm font-medium text-gray-700 mb-1">
                                    Cédula de Identidad <span class="text-red-600">*</span>
                                </label>
                                <input type="text" id="ci" name="ci" value="{{ old('ci', $empleado->ci) }}"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('ci') input-error @enderror"
                                       placeholder="12345678-X">
                                @error('ci')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Estado Civil -->
                            <div>
                                <label for="estado_civil" class="block text-sm font-medium text-gray-700 mb-1">
                                    Estado Civil <span class="text-red-600">*</span>
                                </label>
                                <select id="estado_civil" name="estado_civil"
                                        class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('estado_civil') input-error @enderror">
                                    <option value="">Seleccione un estado civil</option>
                                    @foreach(['soltero', 'casado', 'divorciado', 'viudo'] as $estado)
                                        <option value="{{ $estado }}" {{ old('estado_civil', $empleado->estado_civil) == $estado ? 'selected' : '' }}>
                                            {{ ucfirst($estado) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('estado_civil')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Contraseña -->
                            <div x-data="{ showPassword: false }">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                    Contraseña
                                </label>
                                <div class="relative">
                                    <input :type="showPassword ? 'text' : 'password'" id="password" name="password"
                                           class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('password') input-error @enderror"
                                           placeholder="Nueva contraseña">
                                    <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 password-toggle"
                                          @click="showPassword = !showPassword">
                                            <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                        </span>
                                </div>
                                @error('password')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div x-data="{ showPassword: false }">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                                    Confirmar Contraseña
                                </label>
                                <div class="relative">
                                    <input :type="showPassword ? 'text' : 'password'" id="password_confirmation" name="password_confirmation"
                                           class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="Confirme la contraseña">
                                    <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 password-toggle"
                                          @click="showPassword = !showPassword">
                                            <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div class="form-section p-6 border border-gray-200 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-briefcase text-blue-600 mr-3"></i>
                            Información Profesional
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Cargo -->
                            <div>
                                <label for="cargo" class="block text-sm font-medium text-gray-700 mb-1">
                                    Cargo <span class="text-red-600">*</span>
                                </label>
                                <input type="text" id="cargo" name="cargo" value="{{ old('cargo', $empleado->cargo) }}"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('cargo') input-error @enderror"
                                       placeholder="Ej: Desarrollador Frontend">
                                @error('cargo')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Rol -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                                    Rol <span class="text-red-600">*</span>
                                </label>
                                <select id="role" name="role"
                                        class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('role') input-error @enderror">
                                    @foreach(['empleado', 'supervisor', 'administrador', 'cliente'] as $rol)
                                        <option value="{{ $rol }}" {{ old('role', $empleado->user->role) == $rol ? 'selected' : '' }}>
                                            {{ ucfirst($rol) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Salario -->
                            <div>
                                <label for="salario" class="block text-sm font-medium text-gray-700 mb-1">
                                    Salario (€) <span class="text-red-600">*</span>
                                </label>
                                <input type="number" id="salario" name="salario" value="{{ old('salario', $empleado->salario) }}" step="0.01" min="0"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('salario') input-error @enderror"
                                       placeholder="0.00">
                                @error('salario')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Estado -->
                            <div>
                                <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">
                                    Estado
                                </label>
                                <select id="estado" name="estado"
                                        class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    <option value="activo" {{ old('estado', $empleado->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ old('estado', $empleado->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    <option value="vacaciones" {{ old('estado', $empleado->estado) == 'vacaciones' ? 'selected' : '' }}>Vacaciones</option>
                                    <option value="licencia" {{ old('estado', $empleado->estado) == 'licencia' ? 'selected' : '' }}>Licencia Médica</option>
                                </select>
                            </div>

                            <!-- Experiencia -->
                            <div class="md:col-span-2">
                                <label for="experiencia" class="block text-sm font-medium text-gray-700 mb-1">
                                    Experiencia
                                </label>
                                <textarea id="experiencia" name="experiencia" rows="3"
                                          class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Describa la experiencia del empleado">{{ old('experiencia', $empleado->experiencia) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="form-section p-6 border border-gray-200 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                            Información Adicional
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Fecha de Contratación -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Fecha de Contratación
                                </label>
                                <div class="px-4 py-2 border rounded-lg bg-gray-50">
                                    {{ $empleado->created_at->format('d M, Y') }}
                                </div>
                            </div>

                            <!-- Última Actualización -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Última Actualización
                                </label>
                                <div class="px-4 py-2 border rounded-lg bg-gray-50">
                                    {{ $empleado->updated_at->format('d M, Y') }}
                                </div>
                            </div>

                            <!-- Notas -->
                            <div class="md:col-span-2">
                                <label for="notas" class="block text-sm font-medium text-gray-700 mb-1">
                                    Notas Adicionales
                                </label>
                                <textarea id="notas" name="notas" rows="3"
                                          class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Agregue cualquier información adicional relevante">{{ old('notas', $empleado->notas) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="p-6 border-t flex justify-between">
                    <a href="{{ route('empleados.show', $empleado->id) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg transition flex items-center">
                        <i class="fas fa-times mr-2"></i>Cancelar
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition flex items-center">
                        <i class="fas fa-save mr-2"></i>Guardar Cambios
                    </button>
                </div>
            </div>
        </form>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-lg font-semibold">Sistema de Gestión de Empleados</h3>
                    <p class="text-gray-400 text-sm">Versión 2.1.5</p>
                </div>
                <div class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Empresa XYZ. Todos los derechos reservados.
                </div>
            </div>
        </div>
    </footer>
</div>

<script>
    // Funcionalidad para mostrar/ocultar contraseña
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar cambios en el rol para mostrar/ocultar campos
        const roleSelect = document.getElementById('role');

        if (roleSelect) {
            roleSelect.addEventListener('change', function() {
                // Aquí puedes agregar lógica para mostrar/ocultar campos según el rol
                // Por ejemplo, si es administrador, mostrar campos adicionales
            });
        }

        // Formatear salario mientras se escribe
        const salarioInput = document.getElementById('salario');

        if (salarioInput) {
            salarioInput.addEventListener('blur', function() {
                const value = parseFloat(this.value);
                if (!isNaN(value)) {
                    this.value = value.toFixed(2);
                }
            });
        }
    });
</script>
</body>
</x-app-layout>
