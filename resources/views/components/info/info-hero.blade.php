<section class="hero text-center text-white flex items-center justify-center relative" id="inicio" style="height: 60vh;">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="container mx-auto relative z-10 text-center">
        <h1 class="text-4xl font-extrabold opacity-0 transition-opacity duration-1000 ease-in-out animate__animated animate__fadeInUp">Transmisión de Datos y Cableado Estructurado</h1>
        <p class="text-lg mb-4 opacity-0 transition-opacity duration-1000 ease-in-out animate__animated animate__fadeInUp animate__delay-1s">Soluciones de fibra óptica para empresas y hogares.</p>
        <a href="#contacto" class="btn btn-warning px-6 py-3 text-lg font-bold animate__animated animate__pulse animate__infinite bg-yellow-500 text-white rounded-md hover:bg-yellow-600 hover:scale-105 transition-all duration-200">Contáctanos</a>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const hero = document.querySelector('.hero');
        const title = hero.querySelector('h1');
        const subtitle = hero.querySelector('p');

        // Arreglo con imágenes y mensajes correspondientes
        const slides = [
            {
                imagen: '{{ asset('images/portada/imghero1.png') }}',
                titulo: 'Transmisión de Datos y Cableado Estructurado',
                texto: 'Enlaces por Fibra Óptica Dedicados tipo Punto a Punto - Punto Multipunto'
            },
            {
                imagen: '{{ asset('images/portada/imghero2.png') }}',
                titulo: 'Servicio de Internet por Fibra Óptica',
                texto: 'Ofrecemos el mejor servicio con la más amplia cobertura'
            },
            {
                imagen: '{{ asset('images/portada/imghero3.png') }}',
                titulo: 'Productos y Soluciones de Telecomunicaciones',
                texto: 'Equipamiento de Telecomunicaciones, hecha un vistazo a nuestro catálogo de Productos.'
            }
        ];

        let index = 0;

        function actualizarHero() {
            const actual = slides[index];

            // Añadimos transiciones suaves en el fondo de la imagen
            hero.style.transition = 'background-image 1s ease-in-out, opacity 1s ease-in-out';
            hero.style.opacity = '0'; // Hacemos que se desvanezca antes de cambiar la imagen

            // Cambiar el fondo después de un pequeño retraso
            setTimeout(() => {
                // Actualizamos la imagen de fondo
                hero.style.backgroundImage = `linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('${actual.imagen}')`;
                
                // Aseguramos que la imagen cubra todo el fondo
                hero.style.backgroundSize = 'cover';  // Esto hace que la imagen cubra toda el área
                hero.style.backgroundPosition = 'center'; // Esto asegura que la imagen se centre
                hero.style.backgroundRepeat = 'no-repeat'; // Evita que la imagen se repita

                // Volver a la opacidad 1 para mostrar el nuevo fondo
                hero.style.opacity = '1';
            }, 500); // 500ms de retraso para permitir que se desvanezca antes de cambiar la imagen

            // Transición de opacidad para los textos (título y subtítulo)
            title.classList.add('opacity-0');
            subtitle.classList.add('opacity-0');

            // Esperamos que el fondo termine de cambiar antes de actualizar el texto
            setTimeout(() => {
                title.textContent = actual.titulo;
                subtitle.textContent = actual.texto;

                // Animamos la opacidad después de que el fondo se actualice
                title.classList.remove('opacity-0');
                subtitle.classList.remove('opacity-0');
            }, 1000); // 1000ms para que el fondo cambie completamente antes de animar los textos

            index = (index + 1) % slides.length;
        }

        // Ejecutar inicialmente
        actualizarHero();

        // Cambiar cada 6 segundos con una transición suave
        setInterval(actualizarHero, 6000);
    });
</script>
