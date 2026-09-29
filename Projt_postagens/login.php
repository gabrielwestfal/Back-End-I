<?php

include 'config.php';
criarTopo('IFES - Login');
?>
<main>
   <div class="container">

        <form class="formulario" action="inserir_usuario.php" method="POST">

            <h1>Faça seu Cadastro</h1>

            <p>Preencha os campos abaixo</p>
            <div class="campo">
                <label for="login">email</label>
                <input
                    type="text"
                    id="email"
                    name="email"
                    placeholder="Digite seu email"
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
                Cadastrar
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
