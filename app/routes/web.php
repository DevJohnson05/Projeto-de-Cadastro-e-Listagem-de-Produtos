<?php 

    $routes = [
        'get' => [
            '/' => 'HomeController@index',
            '/listar-produtos' => 'ProductController@list',
            '/editar-produto/{id}' => 'ProductController@edit',
            '/cadastrar-produto' => 'ProductController@create',
            '/deletar-produto/{id}' => 'ProductController@delete'
            
        ],
        'post' => [
            '/cadastrar-produto' => 'ProductController@postCreate',
            '/editar-produto/{id}' => 'ProductController@postEdit'
        ],
    ];

    
?>