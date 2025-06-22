@php
    $tipos_trabajo = [
        'instalacion' => 'Instalación',
        'mantenimiento' => 'Mantenimiento',
        'reparacion' => 'Reparación',
        'configuracion' => 'Configuración',
        'otro' => 'Otro'
    ];
    $prioridades = [
        'normal' => 'Normal',
        'alta' => 'Alta',
        'urgente' => 'Urgente'
    ];
@endphp
<x-app-layout>

    <body class="bg-gradient-to-br from-indigo-50 to-purple-50 min-h-screen">
        <style>
            .form-card {
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                border-radius: 1.5rem;
            }

            .input-error {
                border-color: #f87171;
            }

            .error-message {
                color: #ef4444;
                font-size: 0.875rem;
                margin-top: 0.25rem;
            }

            .input-focus:focus {
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
            }
        </style>
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-4xl mx-auto">
                <!-- Encabezado -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-indigo-800 mb-3">
                        <i class="fas fa-plus-circle mr-2"></i> Registrar Nuevo Trabajo
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Completa el formulario para crear un nuevo trabajo y asignar un equipo
                    </p>
                </div>
                <!-- Tarjeta del Formulario -->
                <div class="form-card dark:bg-gray-800 text-white overflow-hidden">
                    <div class="md:flex">
                        <!-- Panel Lateral Decorativo -->
                        <div class="hidden md:block md:w-1/3 bg-gradient-to-b from-indigo-600 to-purple-700 p-8">
                            <div class="text-white mb-8">
                                <h2 class="text-xl font-bold mb-2">Información Requerida</h2>
                                <p class="text-indigo-200 text-sm">Todos los campos marcados con (*) son obligatorios
                                </p>
                            </div>
                            <div class="mt-16">
                                <div class="flex items-center mb-6">
                                    <div class="bg-indigo-500 rounded-full p-4 mr-4">
                                        <i class="fas fa-clipboard-list fa-lg"></i>
                                    </div>
                                    <p class="text-indigo-200 text-lg">Detalles del trabajo</p>
                                </div>
                                <div class="flex items-center mb-6">
                                    <div class="bg-indigo-500 rounded-full p-4 mr-4">
                                        <i class="fas fa-users fa-lg"></i>
                                    </div>
                                    <p class="text-indigo-200 text-lg">Equipo de trabajo</p>
                                </div>
                                <div class="flex items-center mb-6">
                                    <div class="bg-indigo-500 rounded-full p-4 mr-4">
                                        <i class="fa-solid fa-hourglass-start fa-lg"></i>
                                    </div>
                                    <p id="prediccion-tiempo" class="text-indigo-200 text-lg">Estimando tiempo...</p>
                                </div>
                            </div>
                        </div>

                        <!-- Formulario -->
                        <div class="md:w-2/3 p-8">
                            <form action="{{ route('trabajos.store') }}" method="POST">
                                @csrf

                                <!-- Mensajes de error generales -->
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

                                <!-- Sección: Información del Trabajo -->
                                <div class="mb-10">
                                    <div class="flex items-center mb-6">
                                        <div class="bg-indigo-100 dark:bg-indigo-700 p-2 rounded-full mr-3">
                                            <i class="fas fa-clipboard-list fa-lg text-indigo-600 dark:text-indigo-300"></i>
                                        </div>
                                        <h3 class="text-xl font-semibold text-black dark:text-white">Información del Trabajo</h3>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Reporte de Falla -->
                                        <div class="col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Reporte <span class="text-red-500">*</span>
                                            </label>
                                            <select name="reporte_id"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('reporte_id') input-error @enderror">
                                                <option value="" class="text-gray-500 dark:text-gray-400">Seleccione un reporte...</option>
                                                @foreach($reportes as $reporte)
                                                    <option value="{{ $reporte->id }}" @selected(old('reporte_id') == $reporte->id)>
                                                        {{ $reporte->cliente->nombre }} - {{ $reporte->tipo_falla }} - {{ $reporte->direccionAdicional->direccion }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('reporte_id')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Tipo de Trabajo -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Tipo de Trabajo <span class="text-red-500">*</span>
                                            </label>
                                            <select name="tipo_trabajo"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('tipo_trabajo') input-error @enderror">
                                                <option value="" class="text-gray-500 dark:text-gray-400">Seleccione...</option>
                                                @foreach($tipos_trabajo as $key => $tipo)
                                                    <option value="{{ $key }}" @selected(old('tipo_trabajo') == $key)>{{ $tipo }}</option>
                                                @endforeach
                                            </select>
                                            @error('tipo_trabajo')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Prioridad -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Prioridad <span class="text-red-500">*</span>
                                            </label>
                                            <select name="prioridad"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('prioridad') input-error @enderror">
                                                <option value="" class="text-gray-500 dark:text-gray-400">Seleccione...</option>
                                                @foreach($prioridades as $key => $prioridad)
                                                    <option value="{{ $key }}" @selected(old('prioridad') == $key)>{{ $prioridad }}</option>
                                                @endforeach
                                            </select>
                                            @error('prioridad')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Descripción -->
                                        <div class="col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Descripción <span class="text-red-500">*</span>
                                            </label>
                                            <textarea name="descripcion" rows="4"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('descripcion') input-error @enderror"
                                                placeholder="Describa el trabajo a realizar">{{ old('descripcion') }}</textarea>
                                            @error('descripcion')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Materiales -->
                                        <div class="col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Materiales
                                            </label>
                                            <textarea name="materiales" rows="3"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('materiales') input-error @enderror"
                                                placeholder="Liste los materiales necesarios">{{ old('materiales') }}</textarea>
                                            @error('materiales')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Observaciones de Materiales -->
                                        <div class="col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Observaciones de Materiales
                                            </label>
                                            <textarea name="observaciones_materiales" rows="2"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('observaciones_materiales') input-error @enderror"
                                                placeholder="Observaciones adicionales sobre los materiales">{{ old('observaciones_materiales') }}</textarea>
                                            @error('observaciones_materiales')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Sección: Equipo de Trabajo -->
                                <div class="mb-10">
                                    <div class="flex items-center mb-6">
                                        <div class="bg-indigo-100 dark:bg-indigo-700 p-2 rounded-full mr-3">
                                            <i class="fas fa-users fa-lg text-indigo-600 dark:text-indigo-300"></i>
                                        </div>
                                        <h3 class="text-xl font-semibold text-black dark:text-white">Equipo de Trabajo</h3>
                                    </div>

                                    <div class="mb-6">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Seleccionar Empleados <span class="text-red-500">*</span> (Mínimo 2, Máximo 5)
                                        </label>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                            @foreach($empleados as $empleado)
                                                <div class="flex items-center space-x-3 bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                                    <input type="checkbox" name="empleados[]" value="{{ $empleado->id }}" id="empleado_{{ $empleado->id }}"
                                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                        @checked(in_array($empleado->id, old('empleados', [])))>
                                                    <label for="empleado_{{ $empleado->id }}" class="flex-1 text-sm text-gray-700 dark:text-gray-300">
                                                        {{ $empleado->user->name }} - {{ $empleado->cargo }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('empleados')
                                            <p class="error-message mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Encargado del Trabajo <span class="text-red-500">*</span>
                                        </label>
                                        <select name="encargado_id"
                                            class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('encargado_id') input-error @enderror">
                                            <option value="" class="text-gray-500 dark:text-gray-400">Seleccione un encargado...</option>
                                            @foreach($empleados as $empleado)
                                                <option value="{{ $empleado->id }}" @selected(old('encargado_id') == $empleado->id)>
                                                    {{ $empleado->user->name }} - {{ $empleado->cargo }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('encargado_id')
                                            <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Botón Enviar -->
                                <div
                                    class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t border-gray-200">
                                    <a href="{{ route('trabajos.index') }}"
                                        class="px-6 py-3 text-center bg-gray-200 text-gray-800 rounded-lg shadow hover:bg-gray-300 transition">
                                        <i class="fas fa-arrow-left mr-2"></i> Cancelar
                                    </a>
                                    <button type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-700 text-white rounded-lg shadow hover:opacity-90 transition">
                                        <i class="fas fa-save mr-2"></i> Registrar Trabajo
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Font Awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Asegurarse de que solo se pueda seleccionar como encargado a un empleado que esté en el equipo
                const empleadosCheckboxes = document.querySelectorAll('input[name="empleados[]"]');
                const encargadoSelect = document.querySelector('select[name="encargado_id"]');

                empleadosCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateEncargadoOptions);
                });

                function updateEncargadoOptions() {
                    const selectedEmpleados = Array.from(empleadosCheckboxes)
                        .filter(cb => cb.checked)
                        .map(cb => cb.value);

                    Array.from(encargadoSelect.options).forEach(option => {
                        if (option.value === '') return; // Mantener la opción "Seleccione un encargado..."

                        if (!selectedEmpleados.includes(option.value)) {
                            option.disabled = true;
                            if (option.selected) {
                                encargadoSelect.value = '';
                            }
                        } else {
                            option.disabled = false;
                        }
                    });
                }

                // Ejecutar una vez al cargar para configurar el estado inicial
                updateEncargadoOptions();
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const tipoTrabajoSelect = document.querySelector('select[name="tipo_trabajo"]');
                const prioridadSelect = document.querySelector('select[name="prioridad"]');
                const empleadosCheckboxes = document.querySelectorAll('input[name="empleados[]"]');
                const resultadoDiv = document.getElementById('prediccion-tiempo');

                const getCantidadEmpleados = () =>
                    Array.from(empleadosCheckboxes).filter(cb => cb.checked).length;

                const hacerPrediccion = async () => {
                    const tipo_trabajo = tipoTrabajoSelect.value;
                    const prioridad = prioridadSelect.value;
                    const cantidad_empleados = getCantidadEmpleados();

                    if (!tipo_trabajo || !prioridad || cantidad_empleados < 1) {
                        resultadoDiv.textContent = '⏳ Esperando más datos para estimar...';
                        return;
                    }

                    try {
                        const response = await fetch("{{ route('predecir.tiempo.api') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                tipo_trabajo,
                                prioridad,
                                cantidad_empleados,
                                cant_tipo_trabajo: 0, // calculado en backend
                                cant_prioridad: 0     // calculado en backend
                            })
                        });

                        if (!response.ok) throw new Error('Error en la predicción');

                        const json = await response.json();
                        resultadoDiv.textContent = `⏱ Tiempo estimado: ${json.tiempo_estimado.toFixed(2)} minutos`;

                    } catch (err) {
                        resultadoDiv.textContent = '❌ No se pudo calcular el tiempo';
                    }
                };

                tipoTrabajoSelect.addEventListener('change', hacerPrediccion);
                prioridadSelect.addEventListener('change', hacerPrediccion);
                empleadosCheckboxes.forEach(cb => cb.addEventListener('change', hacerPrediccion));
            });
        </script>

    </body>
</x-app-layout>
