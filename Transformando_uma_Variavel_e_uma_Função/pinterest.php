<?php
include 'config.php';

criarTopo('IFES - Pinterest');
?>
    <main>
        <h1></h1> 
        <form  class="formulario" action="https://br.pinterest.com/search/pins/" method="GET">
            <h1>Pinterest</h1>
            <p>Faça sua pesquisa abaixo</p>
                        <div class="campo">
                            <input
                                type="text"
                                id="pinterest"
                                name="q"
                                placeholder="Digite a sua pesquisa"
                                required
                            >
                            <button><ion-icon name="search-outline"></ion-icon> Buscar</button>
                        </div> 
        </form>    
</main>

<?php
echo $rodape;
?>
<?php

?>