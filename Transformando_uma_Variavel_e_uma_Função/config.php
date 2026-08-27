<?php

function criarTopo($titulo){

$topo =    '<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Postagens - '.$titulo.'</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
       
    <header>
        <div class="dflex-center">
            <img src="img/logo.png">
            <h1>'.$titulo.'</h1>
        </div>
           '.criarMenu().'
    </header>';
    echo $topo;
    
};
function criarMenu($logado = false){
            $menu = "";
            if($logado){
                $menu = '<nav>
                        '.criarLinkMenu("perfil.php", 'person-outline', "Perfil").'            
                        '.criarLinkMenu("posts.php", 'add-outline', "Cadastrar Postagem").'    
                        '.criarLinkMenu("sair.php", 'exit-outline', "Sair").'        
                        </nav>';
            }else{
                $menu = '<nav>
                '.criarLinkMenu("index.php", 'home-outline', "Início").'   
                        '.criarLinkMenu("posts.php", 'paper-plane-outline', "Postagens").'     
                        '.criarLinkMenu("login.php", 'lock-closed-outline', "Acessar").'                        
                        '.criarLinkMenu("devs.php", 'bug-outline', "Desenvolvedores").'                         
                        '.criarLinkMenu("contato.php", 'paper-plane-outline', "Contato").'  
                        </nav>';
            }
           return $menu;
}         


$rodape = ' <footer class="dflex-center">
    <p>&copy; 2024 Postagens. Todos os direitos reservados.</p>
</footer>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>    
</body>
</html>';
?>
<?php
    function  linkAtivo($pagina){
        $link = basename($_SERVER['PHP_SELF']);
        $paginaAtiva = "";
        if($link == $pagina){
            $paginaAtiva = "ativo";
        }else{
            $paginaAtiva = "";
        }
        return $paginaAtiva;
    };

    function criarLinkMenu ($pagina,$icon,$nome){
        $html = '<a class="btn '.linkAtivo($pagina).'" href="'.$pagina.'"><ion-icon name="'.$icon.'"></ion-icon>'.$nome.'</a>';

        return $html;
    };

   
?>
