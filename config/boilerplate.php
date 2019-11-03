<?php

return [
    // These options are related to the register procedure
    'register' => [
        // This option must be set to true if you want to release a token
        // When your user successfully terminates the sign-in procedure
        'release_token' => env('REGISTER_RELEASE_TOKEN', false)
    ],

    // These options are related to the password recovery procedure
    'reset_password' => [

        // This option must be set to true if you want to release a token
        // When your user successfully terminates the password reset procedure
        'release_token' => env('PASSWORD_RESET_RELEASE_TOKEN', false)
    ]
];
