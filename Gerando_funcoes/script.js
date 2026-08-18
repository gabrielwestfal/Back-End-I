const cidadeInput = document.getElementById("cidade");
const btnPesquisar = document.getElementById("btnPesquisar");

const nomeCidade = document.getElementById("nomeCidade");
const temperaturaAtual = document.getElementById("temperaturaAtual");
const iconeAtual = document.getElementById("iconeAtual");
const descricaoAtual = document.getElementById("descricaoAtual");

const maxima = document.getElementById("maxima");
const minima = document.getElementById("minima");

const dias = document.getElementById("dias");


// Quando clicar no botão
btnPesquisar.addEventListener("click", pesquisarCidade);


// Permite pesquisar apertando Enter
cidadeInput.addEventListener("keypress", function(event) {

    if (event.key === "Enter") {
        pesquisarCidade();
    }

});


async function pesquisarCidade() {

    const cidade = cidadeInput.value.trim();

    if (cidade === "") {
        alert("Digite o nome de uma cidade.");
        return;
    }


    try {

        // Procura a cidade
        const respostaCidade = await fetch(
            `https://geocoding-api.open-meteo.com/v1/search?name=${encodeURIComponent(cidade)}&count=1&language=pt&format=json`
        );

        const dadosCidade = await respostaCidade.json();


        if (!dadosCidade.results) {
            alert("Cidade não encontrada.");
            return;
        }


        const local = dadosCidade.results[0];

        const latitude = local.latitude;
        const longitude = local.longitude;


        // Busca a previsão do tempo
        const respostaTempo = await fetch(
            `https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&current=temperature_2m,weather_code&daily=weather_code,temperature_2m_max,temperature_2m_min&timezone=auto`
        );

        const dadosTempo = await respostaTempo.json();


        mostrarTempo(local, dadosTempo);

    } catch (erro) {

        console.error(erro);

        alert("Não foi possível buscar a previsão do tempo.");

    }

}


function mostrarTempo(local, dados) {

    // Nome da cidade
    nomeCidade.textContent = `${local.name}, ${local.admin1 || ""}`;


    // Temperatura atual
    const temperatura = dados.current.temperature_2m;

    temperaturaAtual.textContent = `${Math.round(temperatura)}°C`;


    // Descrição e ícone
    const clima = obterClima(dados.current.weather_code);

    iconeAtual.textContent = clima.icone;
    descricaoAtual.textContent = clima.descricao;


    // Máxima e mínima do primeiro dia
    maxima.textContent = `${Math.round(dados.daily.temperature_2m_max[0])}°C`;
    minima.textContent = `${Math.round(dados.daily.temperature_2m_min[0])}°C`;


    // Limpa os dias anteriores
    dias.innerHTML = "";


    // Cria os cards dos próximos 5 dias
    for (let i = 0; i < 5; i++) {

        const data = new Date(dados.daily.time[i] + "T12:00:00");

        const dia = obterNomeDia(data, i);

        const climaDia = obterClima(dados.daily.weather_code[i]);

        const temperaturaMaxima =
            Math.round(dados.daily.temperature_2m_max[i]);

        const temperaturaMinima =
            Math.round(dados.daily.temperature_2m_min[i]);


        const card = document.createElement("div");

        card.classList.add("dia");


        card.innerHTML = `
            <h3>${dia}</h3>

            <span>${climaDia.icone}</span>

            <p>${temperaturaMaxima}°C / ${temperaturaMinima}°C</p>

            <small>${climaDia.descricao}</small>
        `;


        dias.appendChild(card);

    }

}


function obterNomeDia(data, indice) {

    if (indice === 0) {
        return "Hoje";
    }

    if (indice === 1) {
        return "Amanhã";
    }


    const diasSemana = [
        "Domingo",
        "Segunda",
        "Terça",
        "Quarta",
        "Quinta",
        "Sexta",
        "Sábado"
    ];


    return diasSemana[data.getDay()];

}


function obterClima(codigo) {

    if (codigo === 0) {
        return {
            icone: "☀️",
            descricao: "Ensolarado"
        };
    }

    if (codigo === 1 || codigo === 2) {
        return {
            icone: "🌤️",
            descricao: "Parcialmente nublado"
        };
    }

    if (codigo === 3) {
        return {
            icone: "☁️",
            descricao: "Nublado"
        };
    }

    if (codigo >= 51 && codigo <= 67) {
        return {
            icone: "🌧️",
            descricao: "Chuva"
        };
    }

    if (codigo >= 71 && codigo <= 77) {
        return {
            icone: "❄️",
            descricao: "Neve"
        };
    }

    if (codigo >= 80 && codigo <= 82) {
        return {
            icone: "🌦️",
            descricao: "Pancadas de chuva"
        };
    }

    if (codigo >= 95) {
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