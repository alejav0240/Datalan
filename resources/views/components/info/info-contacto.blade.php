<section class="py-16 bg-gradient-to-r from-blue-100 to-white" id="contacto">
    <div class="container mx-auto">
        <h2 class="text-4xl font-bold text-center text-blue-900 mb-12">Contáctanos</h2>
        <div class="flex flex-wrap lg:flex-nowrap justify-center gap-12">
            <!-- Información de contacto -->
            <div class="w-full lg:w-1/2 text-lg bg-white p-8 rounded-xl shadow-lg">
                <h4 class="font-semibold text-xl text-blue-700 mb-4">Oficina Central</h4>
                <p class="text-gray-700"><i class="fas fa-map-marker-alt me-2 text-blue-500"></i>Edif. Krsul, Piso 3 Of. 311<br>La Paz, Bolivia</p>
                <h4 class="mt-6 text-xl font-semibold text-blue-700">Email</h4>
                <p class="text-gray-700"><i class="fas fa-envelope me-2 text-blue-500"></i>datalanlp@datalanbo.com</p>
                <h4 class="mt-6 text-xl font-semibold text-blue-700">Teléfonos</h4>
                <p class="text-gray-700"><i class="fas fa-phone me-2 text-blue-500"></i>(+591) 70567872 / 70511549</p>
            </div>

            <!-- Formulario de contacto -->
            <div class="w-full lg:w-1/2 bg-white p-8 rounded-xl shadow-lg">
                <form action="send.php" method="POST" class="space-y-6">
                    <input type="text" name="nombre" class="form-control p-4 rounded-lg w-full border border-gray-300 focus:ring-2 focus:ring-blue-500" placeholder="Nombre completo" required>
                    <input type="email" name="email" class="form-control p-4 rounded-lg w-full border border-gray-300 focus:ring-2 focus:ring-blue-500" placeholder="Correo electrónico" required>
                    <textarea name="mensaje" rows="4" class="form-control p-4 rounded-lg w-full border border-gray-300 focus:ring-2 focus:ring-blue-500" placeholder="Escribe tu mensaje..." required></textarea>
                    <button type="submit" class="btn bg-blue-500 text-white py-3 px-6 w-full rounded-lg hover:bg-blue-600 transition-all duration-200">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </div>
</section>