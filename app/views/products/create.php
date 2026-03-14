<?php 

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
</head>
<body>
    <header class="bg-primary mb-4">
        <h1 class="text-center p-4"><?= $title ?></h1>
    </header>
    <main>
        <div class="container mt-4">

          
            <form action="/cadastrar-produto" method="post" class="form-control rounded-0">
                  <h3 class="text-center mt-2 mb-2">Formulario de Cadastro de Produto</h3>

                <div class="mb-3">
                    <label for="name" class="form-label">Nome do Produto</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="cod_product" class="form-label">Código do Produto</label>
                    <input type="text" class="form-control" id="cod_product" name="cod_product" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Preço do Produto</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="quant_product" class="form-label">Quantidade do Produto</label>
                    <input type="number" step="" class="form-control" id="quant_product" name="quant_product" required>
                </div>
                <div class="mb-3">
                    <small class="form-text text-muted">Selecione a unidade de medida</small>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="un_medida_UN" name="un_medida" value="un" required>
                        <label for="un_medida_UN" class="form-check-label">UN</label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="un_medida_CX" name="un_medida" value="cx">
                        <label for="un_medida_CX" class="form-check-label">CX</label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="un_medida_KG" name="un_medida" value="kg">
                        <label for="un_medida_KG" class="form-check-label">KG</label>
                    </div>

                </div>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </form>
            <a href="/" class="btn btn-secondary mt-3">Voltar para a página inicial</a>
        </div>
        
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
crossorigin="anonymous"></script>
</html>