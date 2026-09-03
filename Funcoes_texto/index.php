
<?php
require_once "funcoes.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Previsão do Tempo</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    criarHeader();
    ?>
    <main>

        <?php
        criarPesquisa();
        criarPrevisao(criarCard("hoje", "", "12", "Ensolarado"));
        ?>
    </main>
    <?php
    criarFooter();
    ?>
</body>
</html>