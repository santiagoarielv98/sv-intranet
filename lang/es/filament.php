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
            'pause' => 'Pausa',
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
        'calendar' => [
            'name' => 'Nombre',
            'year' => 'Año',
            'active' => 'Activo',
        ],
        'country' => [
            'name' => 'Nombre',
            'iso2' => 'Código ISO2',
            'iso3' => 'Código ISO3',
            'numeric_code' => 'Código Numérico',
            'phonecode' => 'Código Telefónico',
            'capital' => 'Capital',
            'currency' => 'Moneda',
            'currency_name' => 'Nombre de Moneda',
            'currency_symbol' => 'Símbolo de Moneda',
            'tld' => 'TLD',
            'native' => 'Nombre Nativo',
            'region' => 'Región',
            'subregion' => 'Subregión',
            'timezones' => 'Zonas Horarias',
            'translations' => 'Traducciones',
            'latitude' => 'Latitud',
            'longitude' => 'Longitud',
            'emoji' => 'Emoji',
            'emojiU' => 'Emoji Unicode',
            'flag' => 'Bandera',
            'is_active' => 'Activo',
        ],
        'state' => [
            'country' => 'País',
            'name' => 'Nombre',
            'latitude' => 'Latitud',
            'longitude' => 'Longitud',
            'is_active' => 'Activo',
        ],
        'city' => [
            'country' => 'País',
            'state' => 'Estado/Provincia',
            'name' => 'Nombre',
            'latitude' => 'Latitud',
            'longitude' => 'Longitud',
            'is_active' => 'Activo',
        ],
        'department' => [
            'name' => 'Nombre',
            'description' => 'Descripción',
            'manager' => 'Gerente',
            'parent' => 'Departamento Superior',
            'is_active' => 'Activo',
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
        'calendar' => [
            'name' => 'Nombre',
            'year' => 'Año',
            'active' => 'Activo',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
        ],
        'country' => [
            'name' => 'Nombre',
            'iso2' => 'ISO2',
            'iso3' => 'ISO3',
            'numeric_code' => 'Código Numérico',
            'phonecode' => 'Código Telefónico',
            'capital' => 'Capital',
            'currency' => 'Moneda',
            'currency_name' => 'Nombre de Moneda',
            'currency_symbol' => 'Símbolo',
            'tld' => 'TLD',
            'native' => 'Nativo',
            'region' => 'Región',
            'subregion' => 'Subregión',
            'latitude' => 'Latitud',
            'longitude' => 'Longitud',
            'emoji' => 'Emoji',
            'emojiU' => 'Emoji Unicode',
            'flag' => 'Bandera',
            'is_active' => 'Activo',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
            'deleted_at' => 'Eliminado',
        ],
        'state' => [
            'country' => 'País',
            'name' => 'Nombre',
            'latitude' => 'Latitud',
            'longitude' => 'Longitud',
            'is_active' => 'Activo',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
            'deleted_at' => 'Eliminado',
        ],
        'city' => [
            'country' => 'País',
            'state' => 'Estado/Provincia',
            'name' => 'Nombre',
            'latitude' => 'Latitud',
            'longitude' => 'Longitud',
            'is_active' => 'Activo',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
            'deleted_at' => 'Eliminado',
        ],
        'department' => [
            'name' => 'Nombre',
            'description' => 'Descripción',
            'manager' => 'Gerente',
            'parent' => 'Departamento Superior',
            'is_active' => 'Activo',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
            'deleted_at' => 'Eliminado',
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

    'timesheet' => [
        'status' => [
            'working' => 'Trabajando',
            'paused' => 'En Pausa',
            'stopped' => 'No Trabajando',
        ],
        'actions' => [
            'start' => [
                'label' => 'Iniciar Trabajo',
                'heading' => '¿Iniciar trabajo?',
                'description' => 'Esto comenzará a registrar tu tiempo de trabajo.',
            ],
            'pause' => [
                'label' => 'Tomar Descanso',
                'heading' => '¿Tomar un descanso?',
                'description' => 'Esto pausará el registro de tu tiempo de trabajo.',
            ],
            'resume' => [
                'label' => 'Reanudar Trabajo',
                'heading' => '¿Reanudar trabajo?',
                'description' => 'Esto finalizará tu descanso y reanudará el registro de tiempo de trabajo.',
            ],
            'stop' => [
                'label' => 'Finalizar Trabajo',
                'heading' => '¿Finalizar trabajo?',
                'description' => 'Esto finalizará tu sesión de trabajo actual.',
            ],
        ],
    ],
];
