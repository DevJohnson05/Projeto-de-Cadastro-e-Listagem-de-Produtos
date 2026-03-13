<?php 

    $routes = [
        'get' => [
            '/' => 'HomeController@index',
            '/listar-produtos' => 'ProductController@list',
            '/editar-produto/{id}' => 'ProductController@edit',
            '/cadastrar-produto' => 'ProductController@create'
            
        ],
        'post' => [
            '/cadastrar-produto' => 'ProductController@postCreate',
        ],
    ];

    
?>