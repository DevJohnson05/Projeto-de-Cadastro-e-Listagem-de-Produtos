<?php 
    return [
        'app_name' => 'Gerenciador de Produtos',
        'app_url' => 'http://localhost',
        'database' => [
            'host' => getenv('MYSQL_HOST') ?: 'localhost',
            'dbname' => 'sistemaDeCadastroElistagem',
            'username' => 'estudante',
            'password' => '2467',
        ],
    ]

?>