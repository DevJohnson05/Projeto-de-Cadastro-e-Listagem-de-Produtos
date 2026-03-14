<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/list.css">

</head>
<body class="">
    <header class=" bg-primary p-4 mb-3 text-center">
        <h1>Listagem de Produtos</h1>
    </header>
    <main class="container bg-light">
        <table class="table table-primary table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Código</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aqui você pode usar um loop para exibir os produtos dinamicamente -->
               
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product->id ?></td>
                        <td><?= $product->nome ?></td>
                        <td><?= $product->cod_produto ?></td>
                        <td><?= $product->preco ?></td>
                        <td>
                            <a href="/editar-produto/<?= $product->id ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a href="/deletar-produto/<?= $product->id ?>" class="btn btn-sm btn-danger">Deletar</a>
                        </td>
                    </tr>     
                <?php endforeach; ?>
                 
            </tbody>
        </table>

        <a href="/" class="btn btn-secondary ">Voltar para a página inicial</a>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
crossorigin="anonymous"></script>
</html>