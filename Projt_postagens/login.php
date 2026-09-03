<?php

include 'config.php';

criarTopo('IFES - Login');
?>
<main>
   <div class="container">

        <form class="formulario" action="teste.php" method="POST">

            <h1>Faça seu login</h1>

            <p>Preencha os campos abaixo</p>
            <div class="campo">
                <label for="login">Login</label>
                <input
                    type="text"
                    id="login"
                    name="login"
                    placeholder="Digite seu login"
                    required
                >
            </div>
            <div class="campo">
                <label for="senha">Senha</label>
                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Digite sua senha"
                    required
                >

            </div>
           
            <button type="submit">
                Logar
            </button>
            <?php
                if(isset($_SESSION['mensagem'])){
                    echo $_SESSION['mensagem'];
                }
            ?>
        </form>

    </div>
</main>


<?php
echo $rodape;

?>
