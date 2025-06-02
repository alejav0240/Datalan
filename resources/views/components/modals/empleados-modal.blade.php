@props(['empleado' => null, 'tituloBoton' => null])

<div x-data="{ open: false }" x-cloak>
    <!-- Botón para abrir el modal -->
    <x-secondary-button @click="open = true">
        <i class="fas fa-eye"></i>
        <span>{{ $tituloBoton ?? 'Ver Detalles' }}</span>
    </x-secondary-button>

    <!-- Modal Overlay -->
    <div x-show="open" x-transition
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/70"
         role="dialog" aria-modal="true">

        <!-- Modal Content -->
        <div @click.away="open = false" x-transition
             class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-3xl w-full p-6 overflow-y-auto max-h-[80vh]">

            <header class="mb-6 border-b pb-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Información del Empleado
                </h2>
                <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300 mt-2">
                    {{ isset($empleado) ? 'Editar Empleado' : 'Agregar Empleado' }}
                </h3>
            </header>

            <form action="{{ isset($empleado) ? route('empleados.update',  $empleado) : route('empleados.store') }}" method="POST">
                @csrf
                @if(isset($empleado))
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach([
                        ['label' => 'Nombres', 'name' => 'nombres', 'type' => 'text', 'required' => true],
                        ['label' => 'Apellidos', 'name' => 'apellidos', 'type' => 'text', 'required' => true],
                        ['label' => 'CI', 'name' => 'ci', 'type' => 'text', 'required' => true],
                        ['label' => 'Fecha de Nacimiento', 'name' => 'fecha_nacimiento', 'type' => 'date'],
                        ['label' => 'Teléfono', 'name' => 'telefono', 'type' => 'text', 'required' => true],
                        ['label' => 'Email', 'name' => 'email', 'type' => 'email', 'required' => true],
                        ['label' => 'Cargo', 'name' => 'cargo', 'type' => 'text', 'required' => true],
                        ['label' => 'Departamento', 'name' => 'departamento', 'type' => 'text', 'required' => true],
                        ['label' => 'Fecha de Ingreso', 'name' => 'fecha_ingreso', 'type' => 'date'],
                        ['label' => 'Salario', 'name' => 'salario', 'type' => 'number'],
                        ['label' => 'Tipo de Contrato', 'name' => 'tipo_contrato', 'type' => 'text'],
                    ] as $field)
                        <div @class(['md:col-span-2' => in_array($field['name'], ['direccion', 'habilidades', 'observaciones'])])>
                            <label class="block text-sm font-medium">{{ $field['label'] }}</label>
                            <input
                                type="{{ $field['type'] }}"
                                name="{{ $field['name'] }}"
                                value="{{ old($field['name'], $empleado->{$field['name']} ?? '') }}"
                                {{ $field['required'] ?? false ? 'required' : '' }}
                                class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                            @error($field['name'])
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <!-- Selects -->
                    @foreach([
                        ['label' => 'Género', 'name' => 'genero', 'options' => ['masculino', 'femenino', 'otro']],
                        ['label' => 'Estado Civil', 'name' => 'estado_civil', 'options' => ['soltero', 'casado', 'divorciado', 'viudo']],
                    ] as $select)
                        <div>
                            <label class="block text-sm font-medium">{{ $select['label'] }}</label>
                            <select name="{{ $select['name'] }}"
                                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                                @foreach($select['options'] as $option)
                                    <option value="{{ $option }}"
                                        {{ old($select['name'], $empleado->{$select['name']} ?? '') === $option ? 'selected' : '' }}>
                                        {{ ucfirst($option) }}
                                    </option>
                                @endforeach
                            </select>
                            @error($select['name'])
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <!-- Textareas -->
                    @foreach([
                        ['label' => 'Dirección', 'name' => 'direccion'],
                        ['label' => 'Habilidades', 'name' => 'habilidades'],
                        ['label' => 'Observaciones', 'name' => 'observaciones'],
                    ] as $area)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium">{{ $area['label'] }}</label>
                            <textarea name="{{ $area['name'] }}" rows="2"
                                      class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white"
                                      required>{{ old($area['name'], $empleado->{$area['name']} ?? '') }}</textarea>
                            @error($area['name'])
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>


                <footer class="flex justify-end mt-8 gap-4 border-t pt-4">
                    <x-button @click="open = false"
                              class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow">
                        Cerrar
                    </x-button>
                    @if($empleado)

                        <x-button type="submit"
                                  class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow">
                            Editar
                        </x-button>
                        @if ($empleado->activo)
                            <x-button @click="if(confirm('¿Estás seguro de desactivar este empleado?'))" type="submit"
                                      class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow">
                                Desactivar
                            </x-button>
                        @else
                            <x-button @click="if(confirm('¿Estás seguro de activar este empleado?')) window.location.href='{{ route('empleados.destroy', $empleado->id_empleado) }}'"
                                      class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                                Activar
                            </x-button>
                        @endif
                    @else
                        <x-button type="summit"
                                  class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow">
                            Crear
                        </x-button>
                    @endif


                </footer>
            </form>

        </div>
    </div>
</div>
