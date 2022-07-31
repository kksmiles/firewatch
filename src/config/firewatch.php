<?php
return [
    'user' => [
        'model' => "App\\Models\\User",
        'table' => "users",
        'attributes' => [
            'id' => 'id',
            'name' => 'name',
            'email' => 'email'
        ]
    ],
    'notify_to' => [
        'telegram',
    ],
    'telegram_chat_id' => 1
];
