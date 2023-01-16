<?php
session_start();
ob_start();
include_once 'conexao.php';
if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
    $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<link rel="stylesheet" href="global.css">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="https://files.cercomp.ufg.br/weby/up/267/o/Logomarca_Dona_Iris.png" type="image/x-ico">
    <title>dashboard</title>
</head>
<body>
<div class="container-fluid">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="/intranet/intranet-dashboard-hmdi/src/dashboard.php">
                <img src="https://files.cercomp.ufg.br/weby/up/267/o/Logomarca_Dona_Iris.png" width="30" height="30" class="d-inline-block align-top" alt="">
                <h5>Bem vindo <?php echo $_SESSION['nome']; ?>!</h5>
            </a>
            <div class="container">
        <ul class=" nav-menu">
                    <li class="nav-item active">
                <a class="nav-link" target="_blank" href="http://10.1.1.108:10000/sysinfo.cgi?xnavigation=1">Configurações</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/intranet/intranet-dashboard-hmdi/src/aniversario">Aniversário</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/intranet/intranet-dashboard-hmdi/src/preventiva">Preventiva</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/intranet/intranet-dashboard-hmdi/src/aniversario/import">Importar-Aniversariantes</a>
            </li>
        </ul>
    </div>
    <a href="sair.php" class="btn btn-danger">Sair</a>
        </nav>
        </div>
</div>
<div class="container-fluid">
    <img src="./imagens/logo.png" alt="" height="230px">
</div>

<div id="previsaoTempo">
    <?php
    // "results": {
    //     "temp": 26,
    //     "date": "25/12/2022",
    //     "time": "11:11",
    //     "condition_code": "29",
    //     "description": "Parcialmente nublado",
    //     "currently": "dia",
    //     "cid": "",
    //     "city": "Goiânia, GO",
    //     "img_id": "29",
    //     "humidity": 65,
    //     "cloudiness": 40.0,
    //     "rain": 0.0,
    //     "wind_speedy": "1.03 km/h",
    //     "wind_direction": 340,
    //     "sunrise": "05:43 am",
    //     "sunset": "06:50 pm",
    //     "condition_slug": "cloud",
    //     "city_name": "Goiânia",
    //     "forecast": [
    //         {
    //             "date": "25/12",
    //             "weekday": "Dom",
    //             "max": 25,
    //             "min": 18,
    //             "cloudiness": 97.0,
    //             "rain": 23.61,
    //             "rain_probability": 100,
    //             "wind_speedy": "2.89 km/h",
    //             "description": "Chuva",
    //             "condition": "rain"
    //         },
    $url = "https://api.hgbrasil.com/weather?woeid=455831&key=2b5b5b1d";
    $json = file_get_contents($url);
    $dados = json_decode($json, true);
    $temp = $dados['results']['temp'];
    $cidade = $dados['results']['city'];
    $descricao = $dados['results']['description'];
    $umidade = $dados['results']['humidity'];
    $vento = $dados['results']['wind_speedy'];
    $nascerSol = $dados['results']['sunrise'];
    $porSol = $dados['results']['sunset'];
    $dia = $dados['results']['date'];
    $hora = $dados['results']['time'];
    $probChuva = $dados['results']['forecast'][0]['rain_probability'];
    $img = $dados['results']['img_id'];
    $img = $img . ".png";
    $img = "https://assets.hgbrasil.com/weather/images/" . $img;
    echo "<div class='container-fluid'>
    <div class='row'>
        <div class='col-sm-12'>
            <div class='card'>
                <div class='card-body'>
                    <h1 class='card-title
                    '>Previsão do tempo</h1>
                    <h5 class='card-text'>Cidade: $cidade</h5>
                    <h5 class='card-text'>Temperatura: $temp °C</h5>
                    <h5 class='card-text'>Descrição: $descricao</h5>
                    <h5 class='card-text'>Umidade: $umidade %</h5>
                    <h5 class='card-text'>Probabilidade de chuva: $probChuva %</h5>
                    <h5 class='card-text'>Vento: $vento</h5>
                    <h5 class='card-text'>Nascer do sol: $nascerSol</h5>
                    <h5 class='card-text'>Por do sol: $porSol</h5>
                    <img src='$img' alt=''>
                </div>
            </div>
        </div>
    </div>
</div>";
    ?>
</div>
<br>
<br>
<footer id="footerColor">
        <div class="card">
            <div class="card-body bg-light">
               <span> ©Intranet-HMDI- Todos os direitos reservados: Hospital e Maternidade Dona Íris Alameda Emílio Póvoa, nº 151 - Vila Redenção - Cep: 74845-250 (62) 3956-8888</span>
                <div id="date"></div>
            </div>
        </div>
    </footer>
<script>
    async function getDate() {
    const response = await fetch('https://worldtimeapi.org/api/timezone/America/Sao_Paulo');
    const data = await response.json();
    const date = new Date(data.datetime);
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();
    const hours = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
    const minutes = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
    const seconds = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();
    document.getElementById('date').innerHTML = `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
}
setInterval(getDate, 1000);

getDate();
</script>

    <script src="global.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>