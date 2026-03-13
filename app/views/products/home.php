<?php 
    

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title  ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/home.css">

</head>
<body class="">
    <header class="bg-primary p-4 mb-2 text-center ">
        <h1>Sistema de Gerenciamento de Produtos</h1>
    </header>
    <main class="container mt-4 mb-5">
       <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary w-100" onclick="window.location.href='/listar-produtos'">Listar Produtos</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-success w-100" onclick="window.location.href='/cadastrar-produto'">Cadastrar Produto</button>
            </div>
       </div>
    </main>
    <footer class="bg-primary p-3 text-center fixed-bottom">
        <p class="fst-italic text-light">Copyright &copy; 2024</p>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
crossorigin="anonymous"></script>

</html>