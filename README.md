#🃏 CardMaster






¡Bienvenido a **CardMaster**! Un juego de coleccionismo de cartas basado en la apertura de sobres, donde la estrategia económica y la suerte se dan la mano. Este proyecto está desarrollado sobre **Laravel 12** siguiendo los estándares de la Fase 1.





---





## 🏢 1. Nombre de la Empresa


**GachaCard Studios S.L.** *"Tu suerte, nuestro juego."*





## 🕹️ 2. Actividad Principal


CardMaster es una plataforma web de entretenimiento centrada en el **coleccionismo de cartas digitales**. 


* **El Reto:** El jugador comienza con **100€**.


* **La Mecánica:** Puede comprar tres tipos de sobres (Barato, Caro, Muy Caro). A mayor precio, mayores probabilidades de obtener cartas legendarias.


* **El Álbum:** El objetivo final es completar la colección. El jugador puede vender cartas de su álbum para recuperar liquidez o guardarlas para alcanzar el 100%. 


* **Game Over:** Si el saldo llega a 0€ y no quedan cartas valiosas para vender, la partida termina.





## 📊 3. Base de Datos (Estructura Técnica)


Utilizamos **SQLite** para una portabilidad total. El diagrama lógico es el siguiente:





| Tabla | Campos | Descripción |


| :--- | :--- | :--- |


| **users** | `id`, `name`, `email`, `wallet` (decimal) | Almacena el saldo del jugador (init: 100€). |


| **cards** | `id`, `name`, `image_front`, `price`, `rarity` | El catálogo maestro de cartas disponibles. |


| **inventories** | `user_id`, `card_id`, `quantity` | Relación de cartas que el usuario posee. |











## 🚀 4. Funcionalidades a Desarrollar


Basándonos en el temario del curso, implementaremos:


1. **Sistema de Rutas con Nombre:** Navegación segura entre Inicio, Tienda, Álbum y Contacto.


2. **Motor de Plantillas Blade:** Interfaz coherente con una plantilla base (`layout`) y secciones dinámicas.


3. **Gestión de Assets con Vite:** Estilos responsive usando Bootstrap y SASS personalizado para el diseño de las cartas.


4. **Lógica de Sobres:** Algoritmo de probabilidad para la generación de cartas aleatorias.


5. **Mercado Interno:** Sistema de compra/venta que afecta al saldo del usuario en tiempo real.





## 🛠️ 5. Instalación y Configuración


Para que cualquier miembro del equipo o la profesora pueda ejecutar el proyecto:





1. **Clonar el repositorio:** `git clone <url-del-repo>`


2. **Instalar dependencias de PHP:** `composer install`


3. **Instalar dependencias de JS/Estilos:** `npm install`


4. **Configurar el entorno:**


   - Copiar `.env.example` a `.env`


   - Asegurarse de que `DB_CONNECTION=sqlite` está configurado.


   - Crear el archivo vacío: `touch database/database.sqlite`


5. **Preparar la app:**


   - `php artisan key:generate`


   - `php artisan migrate` (Crea las tablas)


6. **Lanzar el proyecto:**


   - Terminal 1: `php artisan serve`


   - Terminal 2: `npm run dev`
