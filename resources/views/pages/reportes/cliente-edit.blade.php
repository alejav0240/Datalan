<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reporte - Datalan Bolivia</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto py-10 px-4">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-blue-700">Editar Reporte de Falla</h1>
                <a href="{{ route('inicio') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Volver
                </a>
            </div>
            
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
                <form action="{{ route('reportes.cliente.update', $reporte->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Mensajes de error -->
                    @if (session('error'))
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Tipo de Falla -->
                    <div>
                        <label for="tipo_falla" class="block text-lg font-semibold text-gray-800 mb-2">Tipo de Falla</label>
                        <select id="tipo_falla" name="tipo_falla" required
                                class="p-4 rounded-xl w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm transition-all duration-300">
                            <option value="">Seleccione un tipo</option>
                            <option value="hardware" {{ old('tipo_falla', $reporte->tipo_falla) == 'hardware' ? 'selected' : '' }}>Hardware</option>
                            <option value="software" {{ old('tipo_falla', $reporte->tipo_falla) == 'software' ? 'selected' : '' }}>Software</option>
                            <option value="conectividad" {{ old('tipo_falla', $reporte->tipo_falla) == 'conectividad' ? 'selected' : '' }}>Conectividad</option>
                            <option value="otro" {{ old('tipo_falla', $reporte->tipo_falla) == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('tipo_falla')
                            <p class="text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Dirección -->
                    <div>
                        <label for="direccion_adicional_id" class="block text-lg font-semibold text-gray-800 mb-2">Dirección</label>
                        <select id="direccion_adicional_id" name="direccion_adicional_id" required
                                class="p-4 rounded-xl w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm transition-all duration-300">
                            <option value="">Seleccione una dirección</option>
                            @foreach($direcciones as $direccion)
                                <option value="{{ $direccion->id }}" {{ old('direccion_adicional_id', $reporte->direccion_adicional_id) == $direccion->id ? 'selected' : '' }}>
                                    {{ $direccion->direccion }}
                                </option>
                            @endforeach
                        </select>
                        @error('direccion_adicional_id')
                            <p class="text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Descripción -->
                    <div>
                        <label for="descripcion" class="block text-lg font-semibold text-gray-800 mb-2">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="4" required
                                  class="p-4 rounded-xl w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm transition-all duration-300">{{ old('descripcion', $reporte->descripcion) }}</textarea>
                        @error('descripcion')
                            <p class="text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Botones -->
                    <div class="flex justify-end space-x-4 pt-4">
                        <a href="{{ route('inicio') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-colors duration-300">
                            Cancelar
                        </a>
                        <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors duration-300">
                            <i class="fas fa-save mr-2"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>