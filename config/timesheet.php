<?php

return [
    'status' => [
        'working' => [
            'description' => 'Working',
            'icon' => 'heroicon-o-play',
            'color' => 'success'
        ],
        'paused' => [
            'description' => 'On Break',
            'icon' => 'heroicon-o-pause',
            'color' => 'warning'
        ],
        'stopped' => [
            'description' => 'Not Working',
            'icon' => 'heroicon-o-stop',
            'color' => 'danger'
        ],
    ],
    'actions' => [
        'start' => [
            'label' => 'Start Work',
            'heading' => 'Start working?',
            'description' => 'This will start tracking your work time.',
        ],
        'pause' => [
            'label' => 'Take Break',
            'heading' => 'Take a break?',
            'description' => 'This will pause your work time tracking.',
        ],
        'resume' => [
            'label' => 'Resume Work',
            'heading' => 'Resume working?',
            'description' => 'This will end your break and resume work time tracking.',
        ],
        'stop' => [
            'label' => 'End Work',
            'heading' => 'End work?',
            'description' => 'This will end your current work session.',
        ],
    ],
];
