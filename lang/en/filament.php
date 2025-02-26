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
        'calendar' => [
            'name' => 'Name',
            'year' => 'Year',
            'active' => 'Active',
        ],
        'country' => [
            'name' => 'Name',
            'iso2' => 'ISO2 Code',
            'iso3' => 'ISO3 Code',
            'numeric_code' => 'Numeric Code',
            'phonecode' => 'Phone Code',
            'capital' => 'Capital',
            'currency' => 'Currency',
            'currency_name' => 'Currency Name',
            'currency_symbol' => 'Currency Symbol',
            'tld' => 'TLD',
            'native' => 'Native Name',
            'region' => 'Region',
            'subregion' => 'Subregion',
            'timezones' => 'Timezones',
            'translations' => 'Translations',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'emoji' => 'Emoji',
            'emojiU' => 'Emoji Unicode',
            'flag' => 'Flag',
            'is_active' => 'Active',
        ],
        'state' => [
            'country' => 'Country',
            'name' => 'Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'is_active' => 'Active',
        ],
        'city' => [
            'country' => 'Country',
            'state' => 'State',
            'name' => 'Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'is_active' => 'Active',
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
        'calendar' => [
            'name' => 'Name',
            'year' => 'Year',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ],
        'country' => [
            'name' => 'Name',
            'iso2' => 'ISO2',
            'iso3' => 'ISO3',
            'numeric_code' => 'Numeric Code',
            'phonecode' => 'Phone Code',
            'capital' => 'Capital',
            'currency' => 'Currency',
            'currency_name' => 'Currency Name',
            'currency_symbol' => 'Symbol',
            'tld' => 'TLD',
            'native' => 'Native',
            'region' => 'Region',
            'subregion' => 'Subregion',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'emoji' => 'Emoji',
            'emojiU' => 'Emoji Unicode',
            'flag' => 'Flag',
            'is_active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ],
        'state' => [
            'country' => 'Country',
            'name' => 'Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'is_active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ],
        'city' => [
            'country' => 'Country',
            'state' => 'State',
            'name' => 'Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'is_active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
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
