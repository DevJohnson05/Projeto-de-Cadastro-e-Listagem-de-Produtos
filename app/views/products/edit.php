<?php 

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
</head>
<body>
    <header>
        <h1 class="text-center p-4 bg-primary text-white"><?= $title ?></h1>
    </header>
    <main class="container mt-4">
        
        <form action="/editar-produto/<?= $product->id ?>" method="post" class="form-control rounded-0 mt-4">
            <h2 class="text-center mb-2">Editar Produto</h2>
            <div class="mb-3">
                <label for="name" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $product->nome ?>" required>
            </div>
            <div class="mb-3">
                <label for="cod_product" class="form-label">Código do Produto</label>
                <input type="text" class="form-control" id="cod_product" name="cod_product" value="<?= $product->cod_produto ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Preço do Produto</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= $product->preco ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
        <a href="/listar-produtos" class="btn btn-secondary mt-3">Voltar para a lista de produtos</a>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
crossorigin="anonymous"></script>
</html>