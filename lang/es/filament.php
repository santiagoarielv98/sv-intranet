<?php

return [
    'navigation' => [
        'groups' => [
            'employees-management' => 'Gestión de empleados',
            'system-management' => 'Gestión del Sistema',
        ],
    ],
    
    'resources' => [
        'users' => [
            'label' => 'Empleado',
            'plural_label' => 'Empleados',
        ],
        'timesheet' => [
            'label' => 'Registro de tiempo',
            'plural_label' => 'Registros de tiempo',
        ],
        'holidays' => [
            'label' => 'Vacación',
            'plural_label' => 'Vacaciones',
        ],
        'calendars' => [
            'label' => 'Calendario',
            'plural_label' => 'Calendarios',
        ],
        'countries' => [
            'label' => 'País',
            'plural_label' => 'Países',
        ],
        'states' => [
            'label' => 'Estado/Provincia',
            'plural_label' => 'Estados/Provincias',
        ],
        'cities' => [
            'label' => 'Ciudad',
            'plural_label' => 'Ciudades',
        ],
        'departments' => [
            'label' => 'Departamento',
            'plural_label' => 'Departamentos',
        ],
    ],

    'common' => [
        'fields' => [
            'name' => 'Nombre',
            'email' => 'Correo Electrónico',
            'email_verified_at' => 'Correo Electrónico Verificado',
            'password' => 'Contraseña',
            'roles' => 'Roles',
            'country' => 'País',
            'state' => 'Estado/Provincia',
            'city' => 'Ciudad',
            'address' => 'Dirección',
            'postal_code' => 'Código Postal',
            'type' => 'Tipo',
            'day' => 'Día',
            'active' => 'Activo',
            'year' => 'Año',
            'created_at' => 'Creado En',
            'updated_at' => 'Actualizado En',
        ],
        'sections' => [
            'personal-information' => 'Información Personal',
            'address-information' => 'Información de Dirección',
        ],
    ],

    'enums' => [
        'status' => [
            'decline' => 'Rechazado',
            'approved' => 'Aprobado',
            'pending' => 'Pendiente',
        ],
        'type' => [
            'work' => 'Trabajo',
            'vacation' => 'Vacaciones',
            'sick' => 'Enfermedad',
            'holiday' => 'Feriado',
        ],
    ],

    'forms' => [
        'timesheet' => [
            'calendar' => 'Calendario',
            'user' => 'Usuario',
            'type' => 'Tipo',
            'day_in' => 'Entrada',
            'day_out' => 'Salida',
        ],
        'holiday' => [
            'calendar' => 'Calendario',
            'user' => 'Usuario',
            'day' => 'Día',
            'type' => 'Estado',
        ],
    ],

    'tables' => [
        'timesheet' => [
            'calendar' => 'Calendario',
            'user' => 'Usuario',
            'type' => 'Tipo',
            'day_in' => 'Entrada',
            'day_out' => 'Salida',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
        ],
        'holiday' => [
            'calendar' => 'Calendario',
            'user' => 'Usuario',
            'day' => 'Día',
            'type' => 'Estado',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
        ],
    ],

    'filters' => [
        'timesheet' => [
            'type' => 'Tipo',
        ],
        'holiday' => [
            'type' => 'Estado',
        ],
    ],
];
