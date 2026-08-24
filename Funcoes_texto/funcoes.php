<?php

function criarHeader()
{
    echo '
    <header>
        <h1>Previsão do Tempo</h1>
        <nav>
            <a href="#">Início</a>
            <a href="#">Previsão</a>
            <a href="#">Sobre</a>
        </nav>
    </header>
    ';
}

function criarPesquisa()
{
    echo '
    <section class="principal">
        <h2>Consulte a previsão do tempo</h2>
        <p>
            Pesquise uma cidade e confira as condições climáticas.
        </p>
        <div class="pesquisa">
            <input
                type="text"
                placeholder="Digite uma cidade"
            >
            <button>
                Pesquisar
            </button>
        </div>
    </section>
    ';
}

function criarCard($dia, $icone, $temperatura, $descricao)
{
    echo "
    <article class='card'>
        <h3>$dia</h3>
        <span>$icone</span>
        <strong>$temperatura</strong>
        <p>$descricao</p>
    </article>
    ";
}

function criarPrevisao()
{
    echo '
    <section class="previsao">
        <h2>Previsão</h2>
        <div class="cards">
    ';

    criarCard(
        "Hoje",
        "☀️",
        "28°C",
        "Ensolarado"
    );

    criarCard(
        "Amanhã",
        "🌤️",
        "27°C",
        "Parcialmente nublado"
    );

    criarCard(
        "Quarta-feira",
        "🌧️",
        "24°C",
        "Muita Chuva"
    );

    echo '
        </div>

    </section>
    ';
}

function criarFooter()
{
    echo '
    <footer>

        <p>
            Site de previsão do tempo
        </p>

    </footer>
    ';
}
?>



