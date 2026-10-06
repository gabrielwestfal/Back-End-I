<?php
include 'config.php';

criarTopo('IFES - Google');
echo criarPesquisa("https://www.google.com/search", "Google", "q");
?>
<!-- <main>
    <form  class="formulario" action="https://www.google.com/search" method="GET">
            <h1>Google</h1>
            <p>Faça sua pesquisa abaixo</p>
                        <div class="campo">
                            <input
                                type="text"
                                id="google"
                                name="q"
                                placeholder="Digite a sua pesquisa"
                                required
                            >
                            <button><ion-icon name="search-outline"></ion-icon> Buscar</button>
                        </div> 
        </form>      
</main> -->

<?php
echo $rodape;
?>
<?php

?>