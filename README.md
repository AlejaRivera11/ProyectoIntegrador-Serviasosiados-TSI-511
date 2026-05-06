# 🔧 Serviasociados – Sistema Web de Agendamiento

Sistema web para la gestión de citas de mantenimiento preventivo y correctivo de vehículos en el **Taller Serviasociados**, desarrollado como proyecto integrador académico.

---

## 📋 Descripción

Solución digital que reemplaza el proceso manual de agendamiento del taller, permitiendo registrar y controlar clientes, vehículos y citas de forma eficiente desde cualquier dispositivo con conexión a internet.

---

## 🚀 Tecnologías utilizadas

| Tecnología | Uso |
|---|---|
| **PHP** | Lenguaje backend |
| **Laravel** | Framework MVC principal |
| **Blade** | Motor de plantillas (vistas) |
| **MySQL** | Base de datos relacional |
| **JavaScript** | Interactividad del frontend |
| **CSS** | Estilos e interfaz de usuario |
| **Visual Studio Code** | Entorno de desarrollo (IDE) |

---

## ⚙️ Funcionalidades principales

- 📅 Agendamiento y gestión de citas
- 👤 Registro y administración de clientes
- 🚗 Gestión de vehículos
- 🔐 Roles de usuario: Administrador, Recepcionista y Cliente
- 📋 Seguimiento y control de servicios programados

---

## 🏗️ Arquitectura

El sistema implementa el patrón **MVC (Modelo-Vista-Controlador)** nativo de Laravel:

- **Modelo:** Gestión de datos (Clientes, Vehículos, Citas, Mecánicos, Servicios)
- **Vista:** Interfaces dinámicas con Blade según rol del usuario
- **Controlador:** Lógica de negocio, validaciones y rutas

---

## 📦 Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/tu-usuario/serviasociados.git
cd serviasociados

# 2. Instalar dependencias
composer install
npm install

# 3. Configurar variables de entorno
cp .env.example .env
php artisan key:generate

# 4. Configurar la base de datos en .env y ejecutar migraciones
php artisan migrate

# 5. Iniciar servidor local
php artisan serve
```

---

## 👥 Autores

- Sebastián Medellín Quintero
- Alejandra Rivera Montero
- Anderson Andrés Camilo

**Institución Universitaria Antonio José Camacho** – Tecnología en Sistemas de Información  
Grupo 511 · Mayo 2026

---

## 📄 Licencia

Proyecto académico. Todos los derechos reservados.

