// =========================================================
// ELEMENTOS DO HTML
// =========================================================

const cidadeInput = document.getElementById("cidade");
const btnPesquisar = document.getElementById("btnPesquisar");

const nomeCidade = document.getElementById("nomeCidade");
const temperaturaAtual = document.getElementById("temperaturaAtual");
const iconeAtual = document.getElementById("iconeAtual");
const descricaoAtual = document.getElementById("descricaoAtual");

const maxima = document.getElementById("maxima");
const minima = document.getElementById("minima");

const umidade = document.getElementById("umidade");
const vento = document.getElementById("vento");
const sensacao = document.getElementById("sensacao");
const uv = document.getElementById("uv");

const dias = document.getElementById("dias");

const status = document.getElementById("status");

const horaAtual = document.getElementById("horaAtual");
const dataAtual = document.getElementById("dataAtual");

const btnHoje = document.getElementById("btnHoje");


// =========================================================
// EVENTOS
// =========================================================

btnPesquisar.addEventListener("click", pesquisarCidade);

cidadeInput.addEventListener("keydown", function (event) {

    if (event.key === "Enter") {
        pesquisarCidade();
    }

});


// Botão "Hoje"
btnHoje.addEventListener("click", function () {

    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });

});


// =========================================================
// RELÓGIO
// =========================================================

function atualizarRelogio() {

    const agora = new Date();

    const horas = String(agora.getHours()).padStart(2, "0");
    const minutos = String(agora.getMinutes()).padStart(2, "0");

    horaAtual.textContent = `${horas}:${minutos}`;


    const opcoes = {
        weekday: "long",
        day: "numeric",
        month: "long"
    };

    let data = agora.toLocaleDateString("pt-BR", opcoes);

    data = data.charAt(0).toUpperCase() + data.slice(1);

    dataAtual.textContent = data;

}


// Atualiza imediatamente
atualizarRelogio();

// Atualiza a cada segundo
setInterval(atualizarRelogio, 1000);


// =========================================================
// PESQUISAR CIDADE
// =========================================================

async function pesquisarCidade() {

    const cidade = cidadeInput.value.trim();


    // Verificação
    if (cidade === "") {

        mostrarStatus("Digite uma cidade para pesquisar.", true);

        cidadeInput.focus();

        return;
    }


    // Estado de carregamento
    iniciarCarregamento();


    try {

        // =====================================================
        // BUSCAR LOCALIZAÇÃO
        // =====================================================

        const respostaCidade = await fetch(
            `https://geocoding-api.open-meteo.com/v1/search?name=${encodeURIComponent(cidade)}&count=1&language=pt&format=json`
        );


        if (!respostaCidade.ok) {
            throw new Error("Erro ao buscar cidade.");
        }


        const dadosCidade = await respostaCidade.json();


        // Cidade não encontrada
        if (!dadosCidade.results || dadosCidade.results.length === 0) {

            throw new Error("Cidade não encontrada.");
        }


        const local = dadosCidade.results[0];


        // =====================================================
        // BUSCAR PREVISÃO
        // =====================================================

        const respostaTempo = await fetch(
            `https://api.open-meteo.com/v1/forecast?latitude=${local.latitude}&longitude=${local.longitude}&current=temperature_2m,relative_humidity_2m,apparent_temperature,is_day,precipitation,weather_code,wind_speed_10m&hourly=temperature_2m,weather_code&daily=weather_code,temperature_2m_max,temperature_2m_min,uv_index_max&timezone=auto&forecast_days=7`
        );


        if (!respostaTempo.ok) {
            throw new Error("Erro ao buscar previsão.");
        }


        const dadosTempo = await respostaTempo.json();


        // =====================================================
        // MOSTRAR RESULTADOS
        // =====================================================

        mostrarTempo(local, dadosTempo);


        mostrarStatus(
            `Previsão atualizada para ${local.name}.`
        );


    } catch (erro) {

        console.error(erro);

        mostrarStatus(
            erro.message || "Não foi possível buscar a previsão.",
            true
        );

        pararCarregamento();

    }

}


// =========================================================
// MOSTRAR TEMPO
// =========================================================

function mostrarTempo(local, dados) {

    // =====================================================
    // LOCALIZAÇÃO
    // =====================================================

    let localizacao = local.name;

    if (local.admin1) {
        localizacao += `, ${local.admin1}`;
    }

    nomeCidade.textContent = localizacao;


    // =====================================================
    // TEMPERATURA
    // =====================================================

    const temperatura =
        dados.current.temperature_2m;

    temperaturaAtual.textContent =
        Math.round(temperatura);


    // =====================================================
    // CLIMA
    // =====================================================

    const clima =
        obterClima(dados.current.weather_code);

    iconeAtual.textContent =
        clima.icone;

    descricaoAtual.textContent =
        clima.descricao;


    // =====================================================
    // MÁXIMA E MÍNIMA
    // =====================================================

    maxima.textContent =
        `${Math.round(
            dados.daily.temperature_2m_max[0]
        )}°C`;

    minima.textContent =
        `${Math.round(
            dados.daily.temperature_2m_min[0]
        )}°C`;


    // =====================================================
    // UMIDADE
    // =====================================================

    if (dados.current.relative_humidity_2m != null) {

        umidade.textContent =
            `${Math.round(
                dados.current.relative_humidity_2m
            )}%`;
    }


    // =====================================================
    // VENTO
    // =====================================================

    if (dados.current.wind_speed_10m != null) {

        vento.textContent =
            `${Math.round(
                dados.current.wind_speed_10m
            )} km/h`;
    }


    // =====================================================
    // SENSAÇÃO TÉRMICA
    // =====================================================

    if (dados.current.apparent_temperature != null) {

        sensacao.textContent =
            `${Math.round(
                dados.current.apparent_temperature
            )}°`;
    }


    // =====================================================
    // ÍNDICE UV
    // =====================================================

    if (dados.daily.uv_index_max) {

        uv.textContent =
            Math.round(
                dados.daily.uv_index_max[0]
            );
    }


    // =====================================================
    // ALTERAR FUNDO DE ACORDO COM O CLIMA
    // =====================================================

    alterarTemaClima(
        dados.current.weather_code,
        dados.current.is_day
    );


    // =====================================================
    // CRIAR PREVISÃO DOS DIAS
    // =====================================================

    criarPrevisao(dados);


    // Finaliza carregamento
    pararCarregamento();

}


// =========================================================
// CRIAR CARDS DOS PRÓXIMOS DIAS
// =========================================================

function criarPrevisao(dados) {

    dias.innerHTML = "";


    const quantidadeDias =
        Math.min(5, dados.daily.time.length);


    for (let i = 0; i < quantidadeDias; i++) {

        const data =
            new Date(
                dados.daily.time[i] + "T12:00:00"
            );


        const nomeDia =
            obterNomeDia(data, i);


        const clima =
            obterClima(
                dados.daily.weather_code[i]
            );


        const maximaDia =
            Math.round(
                dados.daily.temperature_2m_max[i]
            );


        const minimaDia =
            Math.round(
                dados.daily.temperature_2m_min[i]
            );


        // =================================================
        // CRIAR CARD
        // =================================================

        const card =
            document.createElement("div");

        card.classList.add("dia");


        card.innerHTML = `

            <p>${nomeDia}</p>

            <span>${clima.icone}</span>

            <p>${clima.descricao}</p>

            <div class="temperaturas-dia">

                <strong class="max">
                    ${maximaDia}°
                </strong>

                <strong class="min">
                    ${minimaDia}°
                </strong>

            </div>

        `;


        // =================================================
        // EFEITO DE CLIQUE
        // =================================================

        card.addEventListener("click", function () {

            document.querySelectorAll(".dia")
                .forEach(function (elemento) {

                    elemento.classList.remove("selecionado");

                });


            card.classList.add("selecionado");

        });


        dias.appendChild(card);

    }

}


// =========================================================
// NOME DO DIA
// =========================================================

function obterNomeDia(data, indice) {

    if (indice === 0) {
        return "Hoje";
    }

    if (indice === 1) {
        return "Amanhã";
    }


    const nomesDias = [

        "Domingo",
        "Segunda",
        "Terça",
        "Quarta",
        "Quinta",
        "Sexta",
        "Sábado"

    ];


    return nomesDias[data.getDay()];

}


// =========================================================
// INTERPRETAR CÓDIGO DO TEMPO
// =========================================================

function obterClima(codigo) {

    // Céu limpo
    if (codigo === 0) {

        return {
            icone: "☀️",
            descricao: "Céu limpo"
        };

    }


    // Parcialmente nublado
    if (codigo === 1) {

        return {
            icone: "🌤️",
            descricao: "Principalmente limpo"
        };

    }


    if (codigo === 2) {

        return {
            icone: "⛅",
            descricao: "Parcialmente nublado"
        };

    }


    // Nublado
    if (codigo === 3) {

        return {
            icone: "☁️",
            descricao: "Nublado"
        };

    }


    // Neblina
    if (
        codigo === 45 ||
        codigo === 48
    ) {

        return {
            icone: "🌫️",
            descricao: "Neblina"
        };

    }


    // Chuva fraca
    if (
        codigo >= 51 &&
        codigo <= 55
    ) {

        return {
            icone: "🌦️",
            descricao: "Chuvisco"
        };

    }


    // Chuva congelante
    if (
        codigo === 56 ||
        codigo === 57
    ) {

        return {
            icone: "🌧️",
            descricao: "Chuvisco congelante"
        };

    }


    // Chuva
    if (
        codigo >= 61 &&
        codigo <= 67
    ) {

        return {
            icone: "🌧️",
            descricao: "Chuva"
        };

    }


    // Neve
    if (
        codigo >= 71 &&
        codigo <= 77
    ) {

        return {
            icone: "❄️",
            descricao: "Neve"
        };

    }


    // Pancadas de chuva
    if (
        codigo >= 80 &&
        codigo <= 82
    ) {

        return {
            icone: "🌦️",
            descricao: "Pancadas de chuva"
        };

    }


    // Tempestade
    if (
        codigo >= 95
    ) {

        return {
            icone: "⛈️",
            descricao: "Tempestade"
        };

    }


    return {

        icone: "🌡️",
        descricao: "Condição desconhecida"

    };

}


// =========================================================
// ALTERAR TEMA DE ACORDO COM O CLIMA
// =========================================================

function alterarTemaClima(codigo, dia) {

    const body =
        document.body;


    // Remove temas antigos
    body.classList.remove(
        "tema-sol",
        "tema-nublado",
        "tema-chuva",
        "tema-tempestade",
        "tema-neve",
        "tema-noite"
    );


    // Noite
    if (!dia) {

        body.classList.add("tema-noite");

        return;
    }


    // Sol
    if (
        codigo === 0 ||
        codigo === 1
    ) {

        body.classList.add("tema-sol");

        return;
    }


    // Nublado
    if (
        codigo === 2 ||
        codigo === 3
    ) {

        body.classList.add("tema-nublado");

        return;
    }


    // Chuva
    if (
        codigo >= 51 &&
        codigo <= 82
    ) {

        body.classList.add("tema-chuva");

        return;
    }


    // Neve
    if (
        codigo >= 71 &&
        codigo <= 77
    ) {

        body.classList.add("tema-neve");

        return;
    }


    // Tempestade
    if (codigo >= 95) {

        body.classList.add("tema-tempestade");

    }

}


// =========================================================
// ESTADO DE CARREGAMENTO
// =========================================================

function iniciarCarregamento() {

    btnPesquisar.disabled = true;

    btnPesquisar.innerHTML =
        "⏳ Pesquisando...";


    status.textContent =
        "Buscando informações do clima...";


    status.style.opacity = "1";

}


// =========================================================
// FINALIZAR CARREGAMENTO
// =========================================================

function pararCarregamento() {

    btnPesquisar.disabled = false;

    btnPesquisar.innerHTML =
        "<span>🔍</span> Pesquisar";

}


// =========================================================
// STATUS
// =========================================================

function mostrarStatus(mensagem, erro = false) {

    status.textContent = mensagem;

    status.style.opacity = "1";


    if (erro) {

        status.style.color = "#ffcccc";

    } else {

        status.style.color = "white";

    }

}


// =========================================================
// PESQUISA INICIAL
// =========================================================

// Mostra uma mensagem inicial
mostrarStatus(
    "Digite uma cidade para começar."
);