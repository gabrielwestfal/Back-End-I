<?php
include 'config.php';

paginaRestrita(@$_SESSION["logado"]);

criarTopo('IFES - Postagens');
?>
<main>
    <article>
        <h2>Título da Postagem 1</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.</p>
    </article>
</main>
<?php
echo $rodape;
