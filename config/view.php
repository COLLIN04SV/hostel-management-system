<?php

return [

   //view storage paths

    'paths' => [
        resource_path('views'),
    ],

   //compiled view path
    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

];