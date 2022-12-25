<?php
	session_start();
	include_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Contato</title>
	<head>
	<body>
		<?php
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'Relatorio_Preventivas.xls';
		
		$html = '';
		$html .= '<table border="1">';

		$html .= '<tr>';

		//PATRIMONIO com background color #0d6efd e font color #ffffff
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">PATRIMONIO</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">DESCRICAO</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">CUSTO</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">LOCAL</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">DATA DA PREVENTIVA</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">DATA DA PROX PREVENTIVA</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">OBSERVACAO</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">TECNICO</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">ANDAR</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">MONITOR</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">HOSTNAME ANTERIOR</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">HOSTNAME NOVO</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">LOGIN</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">SISTEMA OPERACIONAL</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">PERIFERICOS</td>';
		$html .= '<td style="background-color:#0d6efd;color:#ffffff;">OFFICE</td>';
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela 
		$result_msg_contatos = "SELECT * FROM computadores";
		$resultado_msg_contatos = mysqli_query($conn , $result_msg_contatos);
		
		while($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)){
			$html .= '<tr>';
			
			$html .= '<td>'.$row_msg_contatos["patrimonio"].'</td>';
			$html .= '<td>'.$row_msg_contatos["descricao"].'</td>';
			$html .= '<td>'.$row_msg_contatos["custo"].'</td>';
			$html .= '<td>'.$row_msg_contatos["local_"].'</td>';
			$html .= '<td>'.$row_msg_contatos["data_prev"].'</td>';
			$html .= '<td>'.$row_msg_contatos["data_prox"].'</td>';
			$html .= '<td>'.$row_msg_contatos["observacao"].'</td>';
			$html .= '<td>'.$row_msg_contatos["tecnico"].'</td>';
			$html .= '<td>'.$row_msg_contatos["Andar"].'</td>';
			$html .= '<td>'.$row_msg_contatos["Monitor"].'</td>';
			$html .= '<td>'.$row_msg_contatos["hostName_Antigo"].'</td>';
			$html .= '<td>'.$row_msg_contatos["hostName_Novo"].'</td>';
			$html .= '<td>'.$row_msg_contatos["login"].'</td>';
			$html .= '<td>'.$row_msg_contatos["sistema_Operacional"].'</td>';
			$html .= '<td>'.$row_msg_contatos["perifericos"].'</td>';
			$html .= '<td>'.$row_msg_contatos["office"].'</td>';
			$html .= '</tr>';
			;
		}
		// Configurações header para forçar o download
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		echo $html;
		exit; ?>
	</body>
</html>