<?php
// @session_start();
include 'config.php';

$main = '    <main>
<article>
    <h2>Título da Postagem 1</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.</p>
</article>        
</main>';

echo criarTopo('IFES - Projeto Postagens');

echo $main;
$logado = @$_SESSION["logado"];
paginaRestrita($logado);
echo $rodape;
?>