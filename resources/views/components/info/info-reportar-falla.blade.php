<section class="py-16 bg-gradient-to-r from-red-100 to-white" id="reportar-falla">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold text-red-600 mb-8">Reportar Falla</h2>
        <p class="text-lg text-gray-700 mb-6">¿Tienes algún problema o falla? ¡Cuéntanos para ayudarte a solucionarlo!</p>
        <form action="procesar_reporte.php" method="POST" class="mx-auto w-full max-w-2xl bg-white p-8 rounded-xl shadow-lg space-y-6 text-left">
            <div>
                <label for="nombreFalla" class="block text-lg font-semibold text-gray-800 mb-2">Nombre Completo</label>
                <input type="text" class="form-control p-4 rounded-lg w-full border border-gray-300 focus:ring-2 focus:ring-red-500" id="nombreFalla" name="nombre" required placeholder="Tu nombre completo">
            </div>
            <div>
                <label for="emailFalla" class="block text-lg font-semibold text-gray-800 mb-2">Correo Electrónico</label>
                <input type="email" class="form-control p-4 rounded-lg w-full border border-gray-300 focus:ring-2 focus:ring-red-500" id="emailFalla" name="email" required placeholder="tuemail@ejemplo.com">
            </div>
            <div>
                <label for="descripcionFalla" class="block text-lg font-semibold text-gray-800 mb-2">Descripción de la Falla</label>
                <textarea class="form-control p-4 rounded-lg w-full border border-gray-300 focus:ring-2 focus:ring-red-500" id="descripcionFalla" name="descripcion" rows="4" required placeholder="Describe la falla que estás experimentando"></textarea>
            </div>
            <button type="submit" class="btn bg-red-500 text-white py-3 px-6 w-full rounded-lg hover:bg-red-600 transition-all duration-200">Enviar Reporte</button>
        </form>
    </div>
</section>