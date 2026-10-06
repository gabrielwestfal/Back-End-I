<?php
include 'config.php';
criarTopo('IFES - Login');
?>
<main>
    <div class="container">
        <form class="formulario" action="autenticar.php" method="POST">
            <h1>Faça seu Login</h1>
            <p>Preencha os campos abaixo</p>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Digite seu email" required>
            </div>
            <div class="campo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit">Entrar</button>
            <?php
                if(isset($_SESSION['mensagem'])){
                    echo $_SESSION['mensagem'];
                    unset($_SESSION['mensagem']);
                }
            ?>
            <p><a href="inserir_usuario.php">Não tem conta? Cadastre-se</a></p>
        </form>
    </div>
</main>
<?php
echo $rodape;
