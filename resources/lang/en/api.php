<?php

return [
    'messages' => [
        'register' => [
            'success' => 'You have registered successfully. Please check your email for activation!',
            'status' => 'Ok',
        ],
        'login' => [
            'success' => 'Login successful.',
            'failed' => 'Invalid credentials! Please try again.',
        ],
        'logout' => [
            'success' => 'Successfully logged out.',
        ],
        'forgot_password' => [
            'success' => 'We have sent email with reset password link. Please check your inbox!',
            'validation' => [
                'email_not_found' => 'This email address is not registered.',
            ],
        ],
        'refresh' => [
            'token' => [
                'not_provided' => 'Token not provided.',
            ],
            'status' => 'Ok',
        ],
    ],
];
