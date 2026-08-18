<?php
function criarHeader($tituloPagina, $titulo){
    $header ='<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>'.$tituloPagina.'</title>
</head>
<body>
    <header><h1>'.$titulo.'</h1></header>';

    return $header;
};

function criarMain ($estado, $cidade){
    $main = '
    <main>
    <h2> Hoje no '.$estado.' em '.$cidade.' choveu muito</h2>
    <a href="cidade.php">Clique aqui para mais informações de '.$cidade.'</a>
    </main>
    ' ;
    return $main;
};

function criarFooter ($data){
    $footer =  '<footer>'.$data.'</footer>
</body>
</html>';
return $footer;
};
echo criarHeader('Tempo', 'Previsão do tempo');
echo criarMain('Espírito santo', 'Santa Teresa');
echo criarFooter('Dia 18/08/2026');

?>