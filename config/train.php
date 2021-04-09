<?php

return [
    'login'        => 'test',
    'psw'          => 'bYKoDO2it',
    'terminal'     => 'htk_test',
    'represent_id' => 22400 ,

    'base_url'     => 'https://api.starliner.ru/Api/connect/Soap/Train/1.0.0?wsdl',

    'allowed_methods' => [
        'getTrainRoutes' => 'trainRoute',
        'getCities'      => 'getCities'
    ]
];
