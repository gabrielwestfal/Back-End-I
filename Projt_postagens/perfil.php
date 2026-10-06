<?php
include 'config.php';

paginaRestrita(@$_SESSION["logado"]);

criarTopo('IFES - Perfil');
echo $rodape;
