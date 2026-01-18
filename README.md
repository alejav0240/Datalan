# Sistema de Gestión de Reportes de Datalan 📊

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white) ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) ![FastAPI](https://img.shields.io/badge/FastAPI-009688?style=for-the-badge&logo=fastapi&logoColor=white) ![Python](https://img.shields.io/badge/Python-3776AB?style=for-the-badge&logo=python&logoColor=white) ![Machine Learning](https://img.shields.io/badge/Machine_Learning-FF9900?style=for-the-badge&logo=tensorflow&logoColor=white) ![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white) ![Livewire](https://img.shields.io/badge/Livewire-4E5693?style=for-the-badge&logo=livewire&logoColor=white)

Este proyecto es un sistema integral de gestión de reportes de fallas desarrollado para la empresa Datalan. Su objetivo principal es optimizar la interacción entre clientes y equipos técnicos, permitiendo a los clientes reportar incidentes y facilitando la asignación eficiente de estos a personal cualificado. Además, incorpora un avanzado servicio de Machine Learning para predecir el tiempo estimado de resolución de cada falla, mejorando la planificación y la gestión de expectativas.

## 🌟 Características Principales

*   **Gestión de Clientes y Personal:** Administración completa de usuarios, incluyendo clientes y empleados con roles y permisos diferenciados.
*   **Reporte de Fallas:** Interfaz intuitiva para que los clientes registren nuevas fallas, proporcionando todos los detalles necesarios.
*   **Asignación Inteligente de Reportes:** Funcionalidad para asignar reportes de fallas a equipos de técnicos especializados.
*   **Estimación de Tiempo de Resolución (ML):** Integración de un modelo de Machine Learning que predice el tiempo estimado para solucionar una falla, basado en datos históricos.
*   **Tableros de Trabajo Interactivos:** Visualización del progreso de los reportes a través de tableros Kanban y listas de tareas (desarrollado con Laravel Livewire).
*   **Generación de Documentos PDF:** Capacidad para generar reportes y otros documentos en formato PDF.
*   **Sistema de Autenticación y Autorización Robusto:** Implementación de Laravel Fortify y Jetstream para una gestión segura de usuarios y sesiones.

## 📋 Requisitos Previos

Antes de instalar y ejecutar el proyecto, asegúrate de tener lo siguiente:

*   **Servidor Web:** Nginx o Apache.
*   **PHP:** Versión 8.1 o superior.
*   **Composer:** Gestor de dependencias de PHP.
*   **Node.js y npm/yarn:** Para compilar los assets de frontend.
*   **Python:** Versión 3.9 o superior.
*   **pip:** Gestor de paquetes de Python.
*   **Base de Datos:** MySQL (recomendado) o PostgreSQL.
*   **Git:** Para clonar el repositorio.

## 🚀 Instrucciones de Instalación

Sigue estos pasos para configurar el proyecto localmente:

### 1. Clonar el Repositorio
```bash
git clone https://github.com/alejav0240/DataLan.git
cd DataLan
```

### 2. Configuración de la Aplicación Laravel
```bash

# Instalar dependencias de PHP
composer install

# Copiar el archivo de entorno y generar la clave de aplicación
cp .env.example .env
php artisan key:generate

# Configurar la base de datos en el archivo .env

# DB_CONNECTION=mysql

# DB_HOST=127.0.0.1

# DB_PORT=3306

# DB_DATABASE=datalan_reports

# DB_USERNAME=root

# DB_PASSWORD=

# Ejecutar las migraciones de la base de datos
php artisan migrate --seed # --seed para datos de prueba

# Instalar dependencias de Node.js y compilar assets
npm install
npm run dev # o npm run build para producción

# Iniciar el servidor de desarrollo de Laravel
php artisan serve
```
La aplicación Laravel estará disponible en `http://127.0.0.1:8000`.

### 3. Configuración del Servicio FastAPI (API de Predicción)
```bash

# Navegar al directorio de la API
cd API

# Crear un entorno virtual (opcional pero recomendado)
python -m venv venv
source venv/bin/activate # En Windows: .\venv\Scripts\activate

# Instalar dependencias de Python
pip install -r requirements.txt

# Iniciar el servidor FastAPI
uvicorn main:app --reload --port 8001
```
El servicio FastAPI estará disponible en `http://127.0.0.1:8001`. Asegúrate de que la aplicación Laravel esté configurada para comunicarse con esta URL para las predicciones.

### 4. Configuración del Módulo de Machine Learning (Opcional, para desarrollo/reentrenamiento)
```bash

# Navegar al directorio de Machine Learning
cd MachineLearning

# Crear un entorno virtual (opcional pero recomendado)
python -m venv venv
source venv/bin/activate # En Windows: .\venv\Scripts\activate

# Instalar dependencias de Python
pip install -r requirements.txt

# Si deseas experimentar o reentrenar el modelo:

# jupyter notebook
```

## 💡 Guía de Uso

Una vez que ambas aplicaciones (Laravel y FastAPI) estén en ejecución:

1.  **Acceso a la Plataforma:** Abre tu navegador y ve a `http://127.0.0.1:8000`.
2.  **Registro/Login:** Si no tienes una cuenta, regístrate como cliente o inicia sesión con credenciales de administrador/técnico (si usaste `--seed`, revisa los seeders para credenciales de prueba).
3.  **Reportar una Falla:** Como cliente, navega a la sección de "Reportes" y crea un nuevo reporte de falla.
4.  **Gestionar Reportes:** Como administrador o técnico, podrás ver los reportes, asignarlos a equipos y ver la estimación de tiempo de resolución proporcionada por la API de FastAPI.
5.  **Tablero Kanban:** Explora los tableros de trabajo para una visualización clara del estado de los reportes.

## 🌳 Estructura del Proyecto
```
DataLan/
├── API/                          # Servicio FastAPI para predicción de ML
│   ├── encoder_categorias.pkl    # Codificador de categorías para el modelo
│   ├── main.py                   # Lógica principal de la API FastAPI
│   ├── modelo_regresion.pkl      # Modelo de regresión lineal serializado
│   └── requirements.txt          # Dependencias de Python para FastAPI
├── MachineLearning/              # Módulo de desarrollo del modelo ML
│   ├── datasets/                 # Conjuntos de datos utilizados para el entrenamiento
│   ├── regresionLineal/          # Scripts y notebooks del modelo de regresión
│   │   ├── RegresionLineal.ipynb # Jupyter Notebook para desarrollo del modelo
│   │   ├── encoder_categorias.pkl# Codificador (copia o resultado del entrenamiento)
│   │   ├── modelo_regresion.pkl  # Modelo (copia o resultado del entrenamiento)
│   │   └── predecir.py           # Script de predicción independiente
│   └── requirements.txt          # Dependencias de Python para ML
├── app/                          # Lógica de la aplicación Laravel
│   ├── Actions/                  # Acciones de Fortify/Jetstream
│   ├── Http/                     # Controladores, Middleware, Requests
│   │   ├── Controllers/          # Controladores de la aplicación (e.g., ReporteFallaController, PredecirController)
│   │   ├── Middleware/           # Middleware personalizado (e.g., CheckRole)
│   ├── Livewire/                 # Componentes de Livewire para interactividad
│   ├── Models/                   # Modelos Eloquent de la base de datos
│   ├── PDF/                      # Clases para generación de PDF
│   └── Providers/                # Service Providers de Laravel
├── bootstrap/                    # Archivos de arranque de Laravel
├── config/                       # Archivos de configuración de Laravel
├── database/                     # Migraciones, seeders y factories de la base de datos
├── public/                       # Archivos públicos accesibles (imágenes, CSS, JS compilado)
├── resources/                    # Vistas Blade, assets CSS/JS, archivos de idioma
├── routes/                       # Definiciones de rutas (web, api, clientes_web)
├── storage/                      # Almacenamiento de archivos generados por la aplicación
├── tests/                        # Pruebas automatizadas
├── .env.example                  # Ejemplo de archivo de configuración de entorno
├── artisan                       # Herramienta de línea de comandos de Laravel
├── composer.json                 # Gestor de dependencias de PHP
├── package.json                  # Gestor de dependencias de Node.js
└── README.md                     # Este archivo
```

## 🛠️ Tecnologías Utilizadas

*   **Backend (Web):** PHP 8.x, Laravel 9/10, Livewire, MySQL/PostgreSQL
*   **Backend (API ML):** Python 3.9+, FastAPI, Uvicorn, Pandas, Scikit-learn, Joblib
*   **Frontend:** Blade Templates, JavaScript, Alpine.js (con Livewire), Tailwind CSS (inferido)
*   **Control de Versiones:** Git