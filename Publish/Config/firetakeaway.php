<?php

return [
    'version'         => '1.0.3',   // site version
    'register_enable' => true,     // if true users can register
    // Needed for the laravel sanctum
    'boot_token'           => 'skeleton_default_token',
    'default_status' => 1,
    'confirm_status' => 2
];
