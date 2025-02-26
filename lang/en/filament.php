<?php

return [
    'navigation' => [
        'groups' => [
            'employees-management' => 'Employees Management',
            'system-management' => 'System Management',
        ],
    ],
    
    'resources' => [
        'users' => [
            'label' => 'Employee',
            'plural_label' => 'Employees',
        ],
        'timesheet' => [
            'label' => 'Timesheet',
            'plural_label' => 'Timesheets',
        ],
        'holidays' => [
            'label' => 'Holiday',
            'plural_label' => 'Holidays',
        ],
        'calendars' => [
            'label' => 'Calendar',
            'plural_label' => 'Calendars',
        ],
        'countries' => [
            'label' => 'Country',
            'plural_label' => 'Countries',
        ],
        'states' => [
            'label' => 'State',
            'plural_label' => 'States',
        ],
        'cities' => [
            'label' => 'City',
            'plural_label' => 'Cities',
        ],
        'departments' => [
            'label' => 'Department',
            'plural_label' => 'Departments',
        ],
    ],

    'common' => [
        'fields' => [
            'name' => 'Name',
            'email' => 'Email',
            'email_verified_at' => 'Email Verified',
            'password' => 'Password',
            'roles' => 'Roles',
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'address' => 'Address',
            'postal_code' => 'Postal Code',
            'type' => 'Type',
            'day' => 'Day',
            'active' => 'Active',
            'year' => 'Year',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ],
        'sections' => [
            'personal-information' => 'Personal Information',
            'address-information' => 'Address Information',
        ],
    ],

    'enums' => [
        'status' => [
            'decline' => 'Declined',
            'approved' => 'Approved',
            'pending' => 'Pending',
        ],
        'type' => [
            'work' => 'Work',
            'vacation' => 'Vacation',
            'sick' => 'Sick',
            'holiday' => 'Holiday',
        ],
    ],

    'forms' => [
        'timesheet' => [
            'calendar' => 'Calendar',
            'user' => 'User',
            'type' => 'Type',
            'day_in' => 'Day In',
            'day_out' => 'Day Out',
        ],
        'holiday' => [
            'calendar' => 'Calendar',
            'user' => 'User',
            'day' => 'Day',
            'type' => 'Status',
        ],
    ],

    'tables' => [
        'timesheet' => [
            'calendar' => 'Calendar',
            'user' => 'User',
            'type' => 'Type',
            'day_in' => 'Day In',
            'day_out' => 'Day Out',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ],
        'holiday' => [
            'calendar' => 'Calendar',
            'user' => 'User',
            'day' => 'Day',
            'type' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ],
    ],

    'filters' => [
        'timesheet' => [
            'type' => 'Type',
        ],
        'holiday' => [
            'type' => 'Status',
        ],
    ],
];
