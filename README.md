# SV Intranet

![Badge en Desarollo](https://img.shields.io/badge/STATUS-EN%20DESAROLLO-green?style=for-the-badge)
![GitHub last commit](https://img.shields.io/github/last-commit/santiagoariel/sv-intranet?style=for-the-badge)
![GitHub license](https://img.shields.io/github/license/santiagoariel/sv-intranet?style=for-the-badge)

<!-- [![Demo en Vivo](https://img.shields.io/badge/🔗_Demo_en_Vivo-Click_aquí-blue?style=for-the-badge&logo=vercel)](https://tudemo.com) -->

## 📋 Descripción
SV Intranet es una aplicación web desarrollada con Laravel y Filament que tiene como objetivo gestionar y optimizar los procesos internos de una organización. La aplicación permite a los usuarios gestionar empleados, departamentos, vacaciones, horarios de trabajo, y más.

<!-- ## 🖼️ Capturas de Pantalla
![Vista Previa](/ruta/a/tu/imagen.png) -->

## ✨ Características Destacadas
- Gestión de empleados
- Gestión de departamentos
- Gestión de vacaciones
- Registro y seguimiento de horarios de trabajo
- Integración con APIs externas
- Optimización de rendimiento
- Gestión de roles y permisos

## 🚀 Demo Rápida
`git clone https://github.com/santiagoariel/sv-intranet.git`

## 🛠️ Tecnologías Utilizadas
| Frontend          | Backend           |
|-------------------|-------------------|
| Filament          | Laravel           |
| Livewire          | SQLite            |

## ⚙️ Instalación
1. Clona el repositorio:
```bash
git clone https://github.com/santiagoariel/sv-intranet.git
```
2. Instala dependencias:
```bash
composer install
```
3. Configura variables de entorno (crea un archivo `.env` con tus credenciales)
4. Inicia el servidor:
```bash
php artisan serve
```

## 🌐 Despliegue
Guía breve para despliegue en servicios populares:
- **Vercel**: `vercel deploy`
- **Netlify**: Importa tu repositorio directamente
- **Heroku**: Crea un nuevo app y conecta tu GitHub

## 🤝 Cómo Contribuir
1. Haz un Fork del proyecto
2. Crea tu Feature Branch (`git checkout -b feature/NuevaFuncionalidad`)
3. Commit tus cambios (`git commit -m 'Agrega NuevaFuncionalidad'`)
4. Push a la Branch (`git push origin feature/NuevaFuncionalidad`)
5. Abre un Pull Request

## 📄 Licencia
Distribuido bajo la licencia [MIT](https://choosealicense.com/licenses/mit/).

## 📬 Contacto
Enlace al proyecto: [https://github.com/santiagoariel/sv-intranet](https://github.com/santiagoariel/sv-intranet)

## 🙌 Reconocimientos
- Inspirado en [Proyecto Similar](https://ejemplo.com)

## 🔮 Futuras Características
- Notificaciones en tiempo real
- Integración con servicios de terceros
- Soporte multilenguaje

## 🎯 MVP
- Gestión de usuarios
- Gestión de departamentos
- Gestión de vacaciones
- Registro de horarios de trabajo

## MVP - Aplicación de Gestión de Empleados
### 1. Módulos Principales
#### 🔹 Gestión de Empleados
- Crear, editar y eliminar empleados.
- Asignar empleados a departamentos.
- Registrar información básica (nombre, email, teléfono, puesto, fecha de ingreso).

#### 🔹 Gestión de Departamentos
- Crear, editar y eliminar departamentos.
- Listar empleados por departamento.

#### 🔹 Gestión de Horarios de Trabajo
- Asignar horarios de trabajo a empleados.
- Registrar y modificar turnos (mañana, tarde, noche).
- Gestionar horas extras.

#### 🔹 Gestión de Vacaciones y Permisos
- Solicitud y aprobación de vacaciones.
- Control de días disponibles por empleado.
- Registro de ausencias justificadas o no.

#### 🔹 Autenticación y Roles
- Inicio de sesión y registro de usuarios.
- Roles de usuario: Administrador (gestiona todo) y Empleado (solo visualiza su información y solicita permisos).
