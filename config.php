<?php 

require_once __DIR__ . '/BlueprintLasetSection.php';
require_once __DIR__ . '/LasetDummy.php';

/* I register the a dummy field (don't use this one) only to load the assets */

$kirby->plugin([
    'name' => 'rasteiner/laset', 
    'extends' => [
        'fields' => [
            'laset-dummy' => \Rasteiner\Laset\LasetDummy::class
        ]
    ]
]);