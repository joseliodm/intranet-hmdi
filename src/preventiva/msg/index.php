<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
	<title>Document</title>
</head>
<body>
<?php   
include_once './conexao.php';
require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$query = "SELECT * FROM computadores";
$result = $conn->prepare($query);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row) {
	$data_prox = $row['data_prox'];
	if ($data_prox < date('Y-m-d')) {
		$data_prev = date('d-m-Y', strtotime($row['data_prox']));
		$mail = new PHPMailer(true);
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->Host = 'smtp.office365.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'hmdiprev@outlook.com';
		$mail->Password = 'hmdi12345';
		$mail->Port = 587;
		$mail->setFrom('hmdiprev@outlook.com');
		$mail->addAddress('ti@hmdi.com.br');
		$mail->isHTML(true);
		$mail->Subject = 'Preventiva';
		$mail->Body = '<h1>Preventivas Atrasadas</h1>
		<div class="container">
			<div class="row">
				<div class="col">
					<img src="https://files.cercomp.ufg.br/weby/up/267/o/Logomarca_Dona_Iris.png" alt="logo hmdi" width="200px">
					<p>Patrimonio: '.$row['patrimonio'].'</p>
					<p>Modelo: '.$row['descricao'].'</p>
					<p>Local: '.$row['local_'].'</p>
					<p>Tecnico: '.$row['tecnico'].'</p>
					<p>Ultima Preventiva: '.$data_prev.'</p>
				</div>
			</div>
		';
		$mail->Body .= '<p><a href="http://10.1.1.108/intranet/preventiva/">Acesse o sistema</a></p>';
		$mail->AltBody = 'Alerta de manutencao';
		$mail->send();
	}else{
		header('Location: http://10.1.1.108/intranet/intranet-dashboard-hmdi/src/preventiva/index.php');	
	}}
	header('Location: http://10.1.1.108/intranet/intranet-dashboard-hmdi/src/preventiva/index.php');
?>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>