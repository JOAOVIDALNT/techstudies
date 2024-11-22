<?php
session_start();

$conecta_ny  = "../../connect/conecta_ny.inc.php";
$conecta_spo = "../../connect/conecta_spo.inc.php";
$conecta_var = "../../connect/conecta_var.inc.php";


setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Fortaleza');

$datalog = date('Y-m-d');
$horalog = date('H:i:s');
$horalog2 = date('H:i');
include $conecta_ny;
$usuario = $_SESSION['usuario'];

$usuariolog = trim(strtoupper($usuario));
$key = $_SESSION['key'];

if ($_GET['key']) {
	$key = $_GET['key'];
} else {
	$key = $_SESSION['key'];
}

if ($usuario == "magna" || $usuario == "rafa") {
	header("location:../../spdigitar_pedido/spdigitar_pedido.php?key=$key");
}


$sql = "SELECT 'SPPEDIDO' as sistema, codcli, razsoc, datcad, timecad, vendedor, valorped, tipopgmnto, prazo, descontoglob, aumentoglob, tabela, ref, situacao, pedido, 
tipoentrega, coleta, origem, prioridade, obs, futuro, descontline FROM prevendas WHERE sessaopre = '$key' limit 1;";
$exec = pg_query($sql);
$getPreven = pg_fetch_array($exec);
$codigo_cliente    = $getPreven['codcli'];
$razao_social      = $getPreven['razsoc'];
$data_cadastro     = $getPreven['datcad'];
$hora_cadastro     = $getPreven['timecad'];
$vendedor          = $getPreven['vendedor'];
$valor_pedido      = $getPreven['valorped'];
$tipo_pagamento    = $getPreven['tipopgmnto'];
$prazo             = $getPreven['prazo'];
$descontoglob      = $getPreven['descontoglob'];
$aumentoglob       = $getPreven['aumentoglob'];
$tabela            = trim($getPreven['tabela']);
$prevenda          = $getPreven['ref'];
$situacao          = $getPreven['situacao'];
$pedido            = $getPreven['pedido'];
$assistente        = $getPreven['assis'];
$data_faturamento  = $getPreven['datfat'];
$valor_faturamento = $getPreven['valorfat'];
$data_prev_saida   = $getPreven['dataprevsai'];
$hora_prev_saida   = $getPreven['horaprevsai'];
$tipo_entrega      = $getPreven['tipoentrega'];
$data_entrega      = $getPreven['dataentr'];
$hora_entrega      = $getPreven['horaentr'];
$nota_fiscal       = $getPreven['notafiscal'];
$coleta            = $getPreven['coleta'];
$codigo_entrega    = $getPreven['codent'];
$origem            = $getPreven['origem'];
$prioridade        = $getPreven['prioridade'];
$obs               = $getPreven['obs'];
$futuro            = $getPreven['futuro'];
$desconto_linha    = $getPreven['descontline'];
// desativando o campo de desconto se a prevenda for desconto global

if ($situacao == "Cadastrado") {
	$mensagem_edit = "feito";
} else if ($situacao == "Erroped") {
	$mensagem_edit = "editado";
} else {
?>
	<script>
		alert('Pedido já finalizado!');
		window.close();
	</script>
<?php
}
pg_close($conecta_ny);
include $conecta_spo;
?>
<!doctype html>
<html lang="pt-br">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="jquery-ui.css" rel="stylesheet">
	<style>
		body {
			font-family: "Trebuchet MS", sans-serif;
			margin: 50px;
		}

		.demoHeaders {
			margin-top: 1em;
		}

		#dialog-link {
			padding: .4em 1em .4em 20px;
			text-decoration: none;
			position: relative;
		}

		#dialog-link span.ui-icon {
			margin: 0 5px 0 0;
			position: absolute;
			left: .2em;
			top: 50;
			margin-top: -8px;
		}

		#icons {
			margin: 0;
			padding: 0;
		}

		#icons li {
			margin: 2px;
			position: relative;
			padding: 4px 0;
			cursor: pointer;
			float: left;
			list-style: none;
		}

		#icons span.ui-icon {
			float: left;
			margin: 0 4px;
		}

		.fakewindowcontain .ui-widget-overlay {
			position: absolute;
		}

		select {
			width: 200px;
		}

		table {
			border-collapse: collapse;
			border: 1px solid;
		}

		tr {
			border-collapse: collapse;
			border: 1px solid;
		}

		td {
			border-collapse: collapse;
			border: 1px solid;
			padding: 5px;
		}

		th {
			border-collapse: collapse;
			border: 1px solid;
			padding: 5px;
			text-align: center;
		}
	</style>

	<title>NYBC PEDIDO</title>

</head>

<body>
	<span hidden id="numero-prevenda"><?php echo $prevenda; ?></span>
	<form method="post" name="sppedido" id="sppedido">
		<fieldset>
			<legend>.:Comandos Gerais:.</legend>
			<div id="controlgroup">
				<input type="submit" name="cmd" value="Escolher Modelo" class="ui-button ui-widget ui-corner-all" />
				<input type="submit" name="cmd" value="Visualizar Pedido" class="ui-button ui-widget ui-corner-all" />

				<?php

				if ($situacao == "Cadastrado") {
				?>
					<input type="submit" name="cmd" value="Finalizar Pedido" class="ui-button ui-widget ui-corner-all" />
				<?php
				} elseif ($situacao == "Erroped") {
				?>
					<input type="submit" name="cmd" value="Finalizar Correcao" id="verde" title="Clique se deseja finalizar a correção" />

				<?php

				}
				if ($situacao == 'Cadastrado') {
				?>
					<label for="confexclu">Confirmo</label>
					<input type="checkbox" name="confexclu" id="confexclu" value="confirmo" class="ui-button ui-widget ui-corner-all">
					<input type="submit" name="cmd" value="Cancelar Pedido" id="CancelOrder" title="Cancelar" />
				<?php
				}
				?>
				<select name="prazo" accesskey="z" />
				<option value="<?php echo $prazo ?>"><?php echo ($prazo) ? "$prazo" : "" ?></option>
				<optgroup label="Prazos Novos">
					<option value="A Vista">A Vista</option>
					<option value="30">30</option>
					<option value="60">60</option>
					<option value="30/45/60">30/45/60</option>
					<option value="30/45/60/75">30/45/60/75</option>
					<option value="30/45/60/75/90">30/45/60/75/90</option>
					<option value="30/45/60/75/90/105">30/45/60/75/90/105</option>
					<option value="30/45/60/75/90/105/120">30/45/60/75/90/105/120</option>
					<option value="30/45/60/75/90/120">30/45/60/75/90/120</option>
					<option value="30/60">30/60</option>
					<option value="30/60/90">30/60/90</option>
					<option value="30/60/90/120">30/60/90/120</option>
				</optgroup>
				<optgroup label="Outros Prazos">
					<option value="7">7</option>
					<option value="10">10</option>
					<option value="10/20">10/20</option>
					<option value="10/20/30">10/20/30</option>
					<option value="10/20/30/40">10/20/30/40</option>
					<option value="10/20/30/40/50">10/20/30/40/50</option>
					<option value="10/20/30/40/50/60">10/20/30/40/50/60</option>
					<option value="10/20/30/40/50/60/70">10/20/30/40/50/60/70</option>
					<option value="10/20/30/40/50/60/70/80">10/20/30/40/50/60/70/80</option>
					<option value="10/20/30/40/50/60/70/80/90">10/20/30/40/50/60/70/80/90</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="15/30">15/30</option>
					<option value="15/30/45">15/30/45</option>
					<option value="15/30/45/60">15/30/45/60</option>
					<option value="15/30/45/60/75">15/30/45/60/75</option>
					<option value="15/30/45/60/75/90">15/30/45/60/75/90</option>
					<option value="28">28</option>
					<option value="30/60">30/60</option>
					<option value="30/60/90">30/60/90</option>
					<option value="30/45">30/45</option>
					<option value="30/45/60">30/45/60</option>
					<option value="30/45/60/75">30/45/60/75</option>
					<option value="30/45/60/75/90">30/45/60/75/90</option>
					<option value="45">45</option>
					<option value="45/60">45/60</option>
					<option value="45/60/75">45/60/75</option>
					<option value="45/60/75/90">45/60/75/90</option>
					<option value="60">60</option>
					<option value="90">90</option> </select>
			</div>
		</fieldset>
		<div id="accordion">
			<h3>Pedido</h3>
			<div>
				<?php
				$cmd = $_POST['cmd'];
				if ($cmd) {
				} else {
					$cmd = $_GET['cmd'];
				}

				switch ($cmd) {
						//BLOCO VISUALIZAR PEDIDO	
					case "Cancelar Pedido":

						include $conecta_ny;
						if ($_POST['confexclu'] == "confirmo") {
							$sqlU = "UPDATE prevendas SET situacao='Cancelado' WHERE ref='$prevenda';";
							$exec = pg_query($sqlU);
							$sqli = "INSERT INTO controle(
						data, hora, acao, usuario, prevenda)
						VALUES ('$data_in', '$hora_c','Cancelado', '$usuariolog', '$prevenda');";
							pg_query($sqli);

							$sql9 = "SELECT modelo, tamanho, unidade, cor,quantidade as qtdped, registro, prevenda FROM pedidos WHERE prevenda='$prevenda';";
							$exec25 = pg_query($sql9);

							while ($getOrderToCancel = pg_fetch_array($exec25)) {
								$referencia = $getOrderToCancel['prevenda'];
								$registro_para_del = $getOrderToCancel['registro'];
								$qtd_para_adicionar   = $getOrderToCancel['qtdped'];
								$modelo         = $getOrderToCancel['modelo'];
								$tamanho         = $getOrderToCancel['tamanho'];
								$embalagem         = $getOrderToCancel['unidade'];
								$cor         = $getOrderToCancel['cor'];
								$qty_to_fis = strval($qtd_para_adicionar);
								if ($tabela == 'VAREJO') {
									$estoquefisico = "armazem3";
									$estoquepreco = "estoque";
									$logtable = "logarmazem3";
									include $conecta_spo;
								} elseif ($tabela == "IMPORTACAO") {
									$estoquefisico = "armazem3";
									$estoquepreco = "estoque";
									$logtable = "logarmazem3";
									include $conecta_spo;
								} elseif ($tabela == "LOJA") {
									$estoquefisico = "a3varejo";
									$estoquepreco = "estvarejo";
									$logtable = "logestvarejo";
									include $conecta_var;
								} elseif ($tabela == "SITE") {
									$estoquefisico = "estsite";
									$estoquepreco = "estsite";
									$logtable = "logestsite";
									include $conecta_var;
								}

								//trecho de cancelamento
								if ($error != 1) {
									$sqlU = "UPDATE $estoquefisico SET qtde=qtde + $qtd_para_adicionar WHERE registro='$registro_para_del';";
									$exec = pg_query($sqlU);
									$data_in = date('Y-m-d');
									$hora_in = date('H:i:s');
									$hora_c = date('H:i');
									if ($tabela == 'VAREJO') {
										$estoquefisico = "armazem3";
										$estoquepreco = "estoque";
										$logtable = "logarmazem3";
										include $conecta_spo;
									} elseif ($tabela == "IMPORTACAO") {
										$estoquefisico = "armazem3";
										$estoquepreco = "estoque";
										$logtable = "logarmazem3";
										include $conecta_spo;
									} elseif ($tabela == "LOJA") {
										$estoquefisico = "a3varejo";
										$estoquepreco = "estvarejo";
										$logtable = "logestvarejo";
										include $conecta_var;
									} elseif ($tabela == "SITE") {
										$estoquefisico = "estsite";
										$estoquepreco = "estsite";
										$logtable = "logestsite";
										include $conecta_var;
									}

									$sqlIog = "INSERT INTO $logtable (
							   			data, hora, usuario, modelo, tamanho, embalagem, cor, velhaqtde, 
            				   			novaqtde, totnovo, registro,  acao,  motivo, chave)
    						   			VALUES ('$data_in', '$hora_in', '$usuario','$modelo', '$tamanho', '$embalagem', '$cor','$qty_curr_fis', '$qty_to_fis','$qty_to_update_fis', '$registro_para_del', '+', 'pedido cancelado','$prevenda');";
									$execlog = pg_query($sqlIog);
								} // END ERROR
							} // END WHILE
							// UPDATING PREVENDAS STATUS
							include $conecta_ny;

				?>
							<div class="ui-widget">
								<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
									<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
										<strong>Oi!</strong> Pedido Cancelado!
									</p>
								</div>
							</div>

						<?php
						} else {
						?>
							<div class="ui-widget">
								<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
									<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
										<strong>Oi!</strong>Prevenda não cancelada, por favor, marque a caixinha confirmando o cancelamento!
									</p>
								</div>
							</div>
						<?php
						}
						break;
						//BLOCO VISUALIZAR PEDIDO	
					case "Visualizar Pedido":
						include $conecta_ny;

						$updaTE = "update pedidos set totprice= quantidade::numeric * price_offer   where prevenda='$prevenda';";
						pg_query($updaTE);


						$sql = "select sum(to_number(totprice, '999999.99')) as total_val_ped, sum(quantidade::numeric) as total_iten_ped from pedidos WHERE prevenda='$prevenda';";
						$exec = pg_query($sql);
						$getValor_total_pedido = pg_fetch_array($exec);
						$valor_total_do_pedido = "Valor do pedido:" . strval($getValor_total_pedido['total_val_ped']);
						?>
						<table id="finped" align="center">
							<tr id="trfinped">
								<th id="thfinped">#</th>
								<th id="thfinped">Editar</th>
								<th id="thfinped">Modelo</th>
								<th id="thfinped">Tam</th>
								<th id="thfinped">Cor</th>
								<th id="thfinped">Unidades</th>
								<th id="thfinped">Preço Pedido</th>
								<th id="thfinped">IPI</th>
								<th id="thfinped">Preço c/IPI</th>
								<th id="thfinped">Quantidade</th>
								<th id="thfinped">Valor Total</th>
								<th id="thfinped">Desconto</th>
								<th id="thfinped">Excluir</th>
							</tr>

							<?php
							$sqlS = "SELECT  modelo, tamanho, sum(quantidade::numeric) as total,cor, unidade, priceunit, desconto, ipi, price_offer, registro 
						FROM pedidos 
						WHERE prevenda = '$prevenda' and quantidade <> '0'
						GROUP BY modelo, tamanho,cor, unidade, priceunit, desconto, ipi, price_offer, registro 
						ORDER BY modelo, tamanho,cor, unidade, priceunit, desconto, ipi, price_offer;";
							$exec = pg_query($sqlS);
							$x = 1;
							while ($getTot = pg_fetch_array($exec)) {
								$modelo   = $getTot['modelo'];
								$tamanho  = $getTot['tamanho'];
								$cor  = $getTot['cor'];
								$total    = $getTot['total'];
								$unidade  = $getTot['unidade'];
								$priceunit  = $getTot['priceunit'];
								$desconto  = $getTot['desconto'];
								$ipi  = $getTot['ipi'];
								$ipi_desc = $row['ipi_desc'];

								$precovenda  = $getTot['price_offer'];
								$ipi = str_replace('0.', '1.', $ipi);
								$precocomipi = $precovenda + ($precovenda / 100 * $ipi);
								$registro  = $getTot['registro'];

								if ($unidade == "S") {
									$unidade = "Sacos";
								} else if ($unidade == "G") {
									$unidade = "Grosas";
								} else if ($unidade == "R") {
									$unidade = "Rolos";
								} else if ($unidade == "U") {
									$unidade = "Unidades";
								} else if ($unidade == "P") {
									$unidade = "Pacotes";
								} else if ($unidade == "K") {
									$unidade = "Kilos";
								}
								//VALOR TOTAL DE CADA LINHA
								$totline  = $total * $precovenda;
							?>
								<tr>
									<td id="tdfinped"><?php echo $x; ?></td>
									<td id="tdfinped">
										<li class="ui-state-default ui-corner-all" title=".ui-icon-pencil" onclick="window.open('http://192.168.0.234:89/sppedido/sppedido.php?cmd=1&key=<?php echo $key; ?>&r=<?php echo $registro; ?>','_self')">
											<span class="ui-icon ui-icon-pencil"></span>
										</li>
									</td>
									<td id="tdfinped"><?php echo $modelo; ?></td>
									<td id="tdfinped"><?php echo $tamanho; ?></td>
									<td id="tdfinped"><?php echo $cor; ?></td>
									<td id="tdfinped"><?php echo $unidade; ?></td>
									<td id="tdfinped"><?php echo str_replace('.', ',', $precovenda); ?></td>
									<td id="tdfinped"><?php echo $ipi; ?></td>
									<td id="tdfinped"><?php echo $precocomipi; ?></td>
									<td id="tdfinped"><?php echo $total; ?></td>
									<td id="tdfinped"><?php echo $totline; ?></td>
									<td id="tdfinped"><?php echo $desconto; ?></td>
									<td id="tdfinped">
										<li class="ui-state-default ui-corner-all" title=".ui-icon-trash" onclick="window.open('http://192.168.0.234:89/sppedido/sppedido.php?cmd=2&key=<?php echo $key; ?>&r=<?php echo $registro; ?>','_self')">
											<span class="ui-icon ui-icon-trash">
											</span>
										</li>
									</td>
								</tr>
							<?php
								$somatotal = +$totline;
								$x++;
							} ?>
							<?php
							echo "</table>";

							break;
							//TRECHO EDITAR PRODUTO VALOR 1  

						case "1":
							if ($_POST[1] == "Corrigir Item") {
								$ultimaqtdpedido = $_POST['ultimaqtdpedido'];
								$currqty   = $_POST['currqty'];
								$changeqty = $_POST['changeqty'];

								if ($changeqty < $currqty) {
									if ($ultimaqtdpedido > $changeqty) {
										$operacaoestoque =  $ultimaqtdpedido  -   $changeqty;
										$signal = "+";
										$totalnovoestoque = $currqty + $operacaoestoque;
									} elseif ($ultimaqtdpedido < $changeqty) {
										$operacaoestoque =    $changeqty - $ultimaqtdpedido;
										$signal = "-";
										$totalnovoestoque = $currqty - $operacaoestoque;
									}
									include $conecta_ny;
									//pg_query=(BEGIN);
							?>
									<div class="ui-widget">
										<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
											<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
												<strong>Oi!</strong> Item editado com sucesso #BA-OP-001
											</p>
										</div>
									</div>

									<?php
									// Verificar redução de updates, possíveis redundancias.		
									$sqlU = "UPDATE pedidos 
									SET quantidade='$_POST[changeqty]', price_offer='$_POST[changeprice]'
							   		WHERE prevenda = '$prevenda' and registro='$_GET[r]'";
									$execU = pg_query($sqlU);

									$totpriceupdate = $changeqty * $_POST['changeprice'];

									$sqlU3 = "UPDATE pedidos 
									SET price_offer='$_POST[changeprice]', totprice='$totpriceupdate'
									WHERE prevenda = '$prevenda' and registro='$_GET[r]'";
									$execU = pg_query($sqlU3);

									if ($tabela == 'VAREJO') {
										$estoquefisico = "armazem3";
										$estoquepreco = "estoque";
										$logtable = "logarmazem3";
										include $conecta_spo;
									} elseif ($tabela == "IMPORTACAO") {
										$estoquefisico = "armazem3";
										$estoquepreco = "estoque";
										$logtable = "logarmazem3";
										include $conecta_spo;
									} elseif ($tabela == "LOJA") {
										$estoquefisico = "a3varejo";
										$estoquepreco = "estvarejo";
										$logtable = "logestvarejo";
										include $conecta_var;
									} elseif ($tabela == "SITE") {
										$estoquefisico = "estsite";
										$estoquepreco = "estsite";
										$logtable = "logestsite";
										include $conecta_var;
									}

									$procura77 = array(",");
									$acha77 = array(".");
									$operacaoestoque = str_replace($procura66, $acha66, "$operacaoestoque");

									$sqlU2 = "UPDATE $estoquefisico 
							   SET qtde=qtde $signal $operacaoestoque
							   WHERE registro='$_GET[r]'";
									$execU2 = pg_query($sqlU2);
									$sqlIog = "INSERT INTO $logtable (
							   data, hora, usuario, modelo, tamanho, embalagem, cor, velhaqtde, 
            				   novaqtde, totnovo, registro,  acao,  motivo, chave)
    						   VALUES ('$datalog', '$horalog', '$usuario','$_POST[modelo]', '$_POST[tamanho]', '$_POST[embalagem]', '$_POST[cor]', '$currqty', '$operacaoestoque','$totalnovoestoque', '$_GET[r]', '$signal', 'correcao','$prevenda');";
									$execlog = pg_query($sqlIog);
								} elseif ($changeqty > $currqty) {

									if ($ultimaqtdpedido > $changeqty) {
										$operacaoestoque =  $ultimaqtdpedido  -   $changeqty;
										$signal = "+";
										$totalnovoestoque = $currqty + $operacaoestoque;
									} elseif ($ultimaqtdpedido < $changeqty) {
										$operacaoestoque =    $changeqty - $ultimaqtdpedido;
										$signal = "-";
										$totalnovoestoque = $currqty - $operacaoestoque;
									}
									include $conecta_ny;

									if ($signal == "-" && $operacaoestoque > $currqty) {
										echo "A quantidade no estoque não é suficuente para esta operação";
									} else {
										//pg_query=(BEGIN);
									?>

										<div class="ui-widget">
											<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
												<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
													<strong>Oi!</strong> Item editado com sucesso #BA-OP-002
												</p>
											</div>
										</div>

									<?php


										$sqlU = "UPDATE pedidos 
							   	SET quantidade='$_POST[changeqty]', price_offer='$_POST[changeprice]'
							   	WHERE prevenda = '$prevenda' and registro='$_GET[r]'";
										$execU = pg_query($sqlU);

										$totpriceupdate = $changeqty * $_POST['changeprice'];

										$sqlU3 = "UPDATE pedidos 
							   SET price_offer='$_POST[changeprice]', totprice='$totpriceupdate'
							   WHERE prevenda = '$prevenda' and registro='$_GET[r]'";
										$execU = pg_query($sqlU3);

										if ($tabela == 'VAREJO') {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "IMPORTACAO") {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "LOJA") {
											$estoquefisico = "a3varejo";
											$estoquepreco = "estvarejo";
											$logtable = "logestvarejo";
											include $conecta_var;
										} elseif ($tabela == "SITE") {
											$estoquefisico = "estsite";
											$estoquepreco = "estsite";
											$logtable = "logestsite";
											include $conecta_var;
										}

										$procura66 = array(",");
										$acha66 = array(".");
										$operacaoestoque = str_replace($procura66, $acha66, "$operacaoestoque");

										$sqlU2 = "UPDATE $estoquefisico 
							   SET qtde=qtde $signal $operacaoestoque
							   WHERE registro='$_GET[r]'";
										$execU2 = pg_query($sqlU2);
										$sqlIog = "INSERT INTO $logtable (
							   data, hora, usuario, modelo, tamanho, embalagem, cor, velhaqtde, 
            				   novaqtde, totnovo, registro,  acao,  motivo, chave)
    						   VALUES ('$datalog', '$horalog', '$usuario','$_POST[modelo]', '$_POST[tamanho]', '$_POST[embalagem]', '$_POST[cor]', '$currqty', '$operacaoestoque','$totalnovoestoque', '$_GET[r]', '$signal', 'correcao','$prevenda');";
										$execlog = pg_query($sqlIog);
									}
								} elseif ($changeqty == $currqty) {
									$retirardoestoque =    0;
									$totpriceupdate = $changeqty * $_POST['changeprice'];
									include $conecta_ny;

									$sqlU3 = "UPDATE pedidos 
							   SET price_offer='$_POST[changeprice]', totprice='$totpriceupdate'
							   WHERE prevenda = '$prevenda' and registro='$_GET[r]'";
									$execU = pg_query($sqlU3);
									?>
									<div class="ui-widget">
										<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
											<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
												<strong>Oi!</strong>Item editado com sucesso #BA-OP-003
											</p>
										</div>
									</div>
								<?php
								}
							} else {
								?>
								<table id="finped" align="center">
									<tr id="trfinped">
										<th id="thfinped">Modelo</th>
										<th id="thfinped">Tamanho</th>
										<th id="thfinped">Cor</th>
										<th id="thfinped">Unidades</th>
										<th id="thfinped">Preço Unitário</th>
										<th id="thfinped">Desconto</th>
										<th id="thfinped">IPI</th>
										<th id="thfinped">Preço Pedido</th>
										<th id="thfinped">Qtd Disponivel</th>
										<th id="thfinped">Nova Qtd</th>
										<th id="thfinped">Valor Total</th>
									</tr>
									<?php
									include $conecta_ny;
									$sqlS = "SELECT modelo, tamanho, sum(quantidade::numeric) as total,cor, unidade, priceunit, desconto, ipi, price_offer 
	  						 FROM pedidos 
							 WHERE prevenda = '$prevenda' and registro='$_GET[r]' 
							 GROUP BY modelo, tamanho, cor, unidade, priceunit, desconto, ipi, price_offer ;";
									$exec = pg_query($sqlS);
									while ($getTot = pg_fetch_array($exec)) {
										$modelo   = $getTot['modelo'];
										$tamanho  = $getTot['tamanho'];
										$cor  = $getTot['cor'];
										$total    = $getTot['total'];
										$unidade  = $getTot['unidade'];
										$priceunit  = $getTot['priceunit'];
										$desconto  = $getTot['desconto'];
										$ipi  = $getTot['ipi'];
										$ipi_desc = $row['ipi_desc'];

										$ipi = str_replace('0.', '1.', $ipi);
										$precovenda  = $getTot['price_offer'];

										$totline  = $total * $precovenda;
									?>

										<tr>
											<td id="tdfinped"><input type="text" name="modelo" size="10" value="<?php echo $modelo; ?>" readonly />
											</td>
											<td id="tdfinped"><input type="text" name="tamanho" size="4" value="<?php echo $tamanho; ?>" readonly />
											</td>
											<td id="tdfinped"><input type="text" name="cor" size="10" value="<?php echo $cor; ?>" readonly /></td>
											<td id="tdfinped"><input type="text" name="embalagem" size="5" value="<?php echo $unidade; ?>" readonly />
											</td>

											<td id="tdfinped"><?php echo $priceunit; ?></td>
											<td id="tdfinped"><?php echo $desconto; ?></td>
											<td id="tdfinped"><?php echo $ipi; ?></td>
											<td id="tdfinped">
												<input type="text" name="changeprice" value="<?php echo $precovenda; ?>" <?php if ($desconto_linha == "NAO") {
																																echo "readonly";
																															} ?> />
											</td>

											<?php
											if ($tabela == 'VAREJO') {
												$estoquefisico = "armazem3";
												$estoquepreco = "estoque";
												$logtable = "logarmazem3";
												include $conecta_spo;
											} elseif ($tabela == "IMPORTACAO") {
												$estoquefisico = "armazem3";
												$estoquepreco = "estoque";
												$logtable = "logarmazem3";
												include $conecta_spo;
											} elseif ($tabela == "LOJA") {
												$estoquefisico = "a3varejo";
												$estoquepreco = "estvarejo";
												$logtable = "logestvarejo";
												include $conecta_var;
											} elseif ($tabela == "SITE") {
												$estoquefisico = "estsite";
												$estoquepreco = "estsite";
												$logtable = "logestsite";
												include $conecta_var;
											}

											// 09/11/2021 - Só verificava registro, acrescentei oldregistro. Gilmar
											$sqlEst = "SELECT qtde as qtdest FROM $estoquefisico WHERE (registro='$_GET[r]' OR oldregistro='$_GET[r]');";
											$execEst = pg_query($sqlEst);
											$qtdAtualEstoque = pg_fetch_array($execEst);
											$qtdEstoqueAtual = $qtdAtualEstoque['qtdest'];

											?>
											<input type="hidden" name="currqty" value="<?php echo $qtdEstoqueAtual; ?>" />


											<td id="tdfinped">
												<input type="text" name="ferres" value="<?php echo $qtdEstoqueAtual; ?>" size="8" readonly />
											</td>
											<td id="tdfinped">
												<input type="text" name="changeqty" id="changeqty" onChange="checkQty()" required value="<?php echo $total; ?>" size="8" id="changeqty" onkeypress="return alpha(event)" />
												<input type="hidden" name="ultimaqtdpedido" value="<?php echo $total; ?>" />

											<td id="tdfinped"><?php echo $totline; ?></td>
										</tr>
									<?php
										$somatotal = +$totline;
									} ?>
									<?php
									echo "</table>";
									?>
									<br><input type="submit" name="1" value="Corrigir Item" class="ui-button ui-widget ui-corner-all" style="margin-left:50; margin-top:3;" />
									<?php
								}
								break;
								//TRECHO DE EXCLUSÃO DE PRODUTOS
							case "2":
								include $conecta_ny;
								if ($_POST[2] == "Excluir Item") {
									$ultimaqtdpedido = $_POST['ultimaqtdpedido'];
									$currqty   = $_POST['currqty'];
									$changeqty = $_POST['changeqty'];
									$operacaoestoque =  $ultimaqtdpedido  -   $changeqty;
									$totalnovoestoque = $currqty + $ultimaqtdpedido;

									$sqlDel = "DELETE FROM pedidos WHERE prevenda = '$prevenda' and registro='$_GET[r]'";
									$sqlexec = pg_query($sqlDel);
									$cmdtuples = pg_affected_rows($sqlexec);
									if ($cmdtuples > 0) {
										if ($tabela == 'VAREJO') {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "IMPORTACAO") {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "LOJA") {
											$estoquefisico = "a3varejo";
											$estoquepreco = "estvarejo";
											$logtable = "logestvarejo";
											include $conecta_var;
										} elseif ($tabela == "SITE") {
											$estoquefisico = "estsite";
											$estoquepreco = "estsite";
											$logtable = "logestsite";
											include $conecta_var;
										}
										$sqlU2 = "UPDATE $estoquefisico 
							   SET qtde=qtde + $changeqty
							   WHERE registro='$_GET[r]'";
										$execU2 = pg_query($sqlU2);
										$sqlIog = "INSERT INTO $logtable (
							   data, hora, usuario, modelo, tamanho, embalagem, cor, velhaqtde, 
            				   novaqtde, totnovo, registro,  acao,  motivo, chave)
    						   VALUES ('$datalog', '$horalog', '$usuario','$_POST[modelo]', '$_POST[tamanho]', '$_POST[embalagem]', '$_POST[cor]','$currqty', '$ultimaqtdpedido','$totalnovoestoque', '$_GET[r]', '+', 'excluindo do pedido','$prevenda');";
										$execlog = pg_query($sqlIog);
									?>
										<div class="ui-widget">
											<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
												<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
													<strong>Oi!</strong> Item excluido com sucesso!
												</p>
											</div>
										</div>
									<?php } elseif ($cmdtuples == 0) { ?>
										<div class="ui-widget">
											<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
												<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
													<strong>Alerta:</strong>Item não foi excluido, se o problema persistir avise o programador!
												</p>
											</div>
										</div>
									<?php
									}
								} else {
									?>
									<table id="finped" align="center">
										<tr id="trfinped">
											<th id="thfinped">Modelo</th>
											<th id="thfinped">Tamanho</th>
											<th id="thfinped">Cor</th>
											<th id="thfinped">Unidades</th>
											<th id="thfinped">Preço Unitário</th>
											<th id="thfinped">Desconto</th>
											<th id="thfinped">IPI</th>
											<th id="thfinped">Preço Pedido</th>
											<th id="thfinped">Quantidade</th>
											<th id="thfinped">Valor Total</th>
										</tr>
										<?php

										$sqlS = "SELECT modelo, tamanho, sum(quantidade::numeric) as total,cor, unidade, priceunit, desconto, ipi, price_offer 
	  						FROM pedidos 
							WHERE prevenda = '$prevenda' and registro='$_GET[r]' 
							GROUP BY modelo, tamanho, cor, unidade, priceunit, desconto, ipi, price_offer ;";
										$exec = pg_query($sqlS);
										while ($getTot = pg_fetch_array($exec)) {
											$modelo   = $getTot['modelo'];
											$tamanho  = $getTot['tamanho'];
											$cor  = $getTot['cor'];
											$total    = $getTot['total'];
											$unidade  = $getTot['unidade'];
											$priceunit  = $getTot['priceunit'];
											$desconto  = $getTot['desconto'];
											$ipi  = $getTot['ipi'];
											$ipi_desc = $row['ipi_desc'];

											$ipi = str_replace('0.', '1.', $ipi);
											$precovenda  = $getTot['price_offer'];

											//VALOR TOTAL DE CADA LINHA
											$totline  = $total * $precovenda;
										?>
											<tr>
												<td id="tdfinped"><input type="text" name="modelo" size="10" value="<?php echo $modelo; ?>" readonly />
												</td>
												<td id="tdfinped"><input type="text" name="tamanho" size="4" value="<?php echo $tamanho; ?>" readonly />
												</td>
												<td id="tdfinped"><input type="text" name="cor" size="10" value="<?php echo $cor; ?>" readonly /></td>
												<td id="tdfinped"><input type="text" name="embalagem" size="5" value="<?php echo $unidade; ?>" readonly /></td>
												<td id="tdfinped"><?php echo $priceunit; ?></td>
												<td id="tdfinped"><?php echo $desconto; ?></td>
												<td id="tdfinped"><?php echo $ipi; ?></td>
												<td id="tdfinped"><?php echo $precovenda; ?></td>
												<td id="tdfinped"><input type="text" name="changeqty" value="<?php echo $total; ?>" readonly /></td>

												<td id="tdfinped"><?php echo $totline; ?></td>
											</tr>
										<?php
											$somatotal = +$totline;
										}
										echo "</table>";

										if ($tabela == 'VAREJO') {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "IMPORTACAO") {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "LOJA") {
											$estoquefisico = "a3varejo";
											$estoquepreco = "estvarejo";
											$logtable = "logestvarejo";
											include $conecta_var;
										} elseif ($tabela == "SITE") {
											$estoquefisico = "estsite";
											$estoquepreco = "estsite";
											$logtable = "logestsite";
											include $conecta_var;
										}

										$sqlEst = "SELECT qtde as qtdest FROM $estoquefisico WHERE registro='$_GET[r]';";
										$execEst = pg_query($sqlEst);
										$qtdAtualEstoque = pg_fetch_array($execEst);
										$qtdEstoqueAtual = $qtdAtualEstoque['qtdest'];


										?>
										<input type="hidden" name="currqty" value="<?php echo $qtdEstoqueAtual; ?>" />
										<input type="hidden" name="ultimaqtdpedido" value="<?php echo $total; ?>" />
										<br><br><input type="submit" name="2" value="Excluir Item" class="ui-button ui-widget ui-corner-all" style="margin-left:50; margin-top:3;" />
									<?php
								}
								break;






								//TRECHO FINALIZAR PEDIDO		  
							case "Finalizar Correcao":
								include $conecta_ny;
								$sqlI2 = "INSERT INTO controle(
            data, hora, acao, usuario, cliente, prevenda)
	        VALUES ('$datalog', '$horalog2','Corrigido', '$usuariolog', '$codigo_cliente', '$prevenda');";
								$getResulControl = pg_query($sqlI2);
								$key_to_lib = sha1($prevenda . $codigo_cliente);
								$prazo = $_POST['prazo'];
								$sql = "select sum(to_number(totprice, '999999.99')) as total_val_ped, sum(quantidade::numeric) as total_iten_ped from pedidos WHERE prevenda='$prevenda';";
								$exec = pg_query($sql);
								$getValor_total_pedido = pg_fetch_array($exec);
								$valor_total_do_pedido = strval($getValor_total_pedido['total_val_ped']);



								$sqlU = "UPDATE prevendas SET situacao='Corrigido',print='false', valorped='$valor_total_do_pedido', key_to_lib='$key_to_lib' WHERE ref='$prevenda' AND situacao='Erroped';";
								$upPre = pg_query($sqlU);
									?>

									<div class="ui-widget">
										<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
											<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
												<strong>Pedido Corrigido/Finalizado
											</p>
										</div>
									</div>
									<meta http-equiv="refresh" content="10;URL=http://192.168.0.234:89/spsisonbeta/spsison.php" />
								<?php

								break;
								//TRECHO FINALIZAR PEDIDO		  
							case "Finalizar Pedido":
								include $conecta_ny;
								$sqlI2 = "INSERT INTO controle(
            data, hora, acao, usuario, cliente, prevenda)
	    VALUES ('$datalog', '$horalog2','Finalizado', '$usuariolog', '$codigo_cliente', '$prevenda');";
								$getResulControl = pg_query($sqlI2);

								$key_to_lib = sha1($prevenda . $codigo_cliente);
								$prazo = $_POST['prazo'];
								$sql = "select sum(to_number(totprice, '999999.99')) as total_val_ped, sum(quantidade::numeric) as total_iten_ped from pedidos WHERE prevenda='$prevenda';";
								$exec = pg_query($sql);
								$getValor_total_pedido = pg_fetch_array($exec);
								$valor_total_do_pedido = strval($getValor_total_pedido['total_val_ped']);

								$sqlDel = "DELETE FROM pedidos WHERE prevenda='$prevenda' AND prevenda<>'' AND  quantidade='0';";
								$execDel = pg_query($sqlDel);

								$sql98 = "SELECT prevenda FROM pedidos WHERE prevenda='$prevenda' AND desconto > 33;";
								$exec98 = pg_query($sql98);
								$check33 = pg_fetch_array($exec98);
								$c33 = $check33['prevenda'];
								if ($c33) {
									$sqlU = "UPDATE prevendas SET prazo='$prazo', r_s_price='N',  r_price_supervisor='N', situacao='Financeiro', valorped='$valor_total_do_pedido', key_to_lib='$key_to_lib' WHERE ref='$prevenda' and situacao='Cadastrado';";
									$upPre = pg_query($sqlU);
								} else {
									$sqlU = "UPDATE prevendas SET   situacao='Financeiro',prazo='$prazo',   valorped='$valor_total_do_pedido', key_to_lib='$key_to_lib' WHERE ref='$prevenda'  and situacao='Cadastrado';";
									$upPre = pg_query($sqlU);
								}
								?>

									<table id="finped" align="center">

										<tr id="trfinped">
											<th id="thfinped" colspan="4">Agente: <?php echo $usuario; ?></th>
											<th id="thfinped" colspan="6">Prevenda: <?php echo $prevenda; ?> </th>
										</tr>

										<tr id="trfinped">
											<th id="thfinped">Modelo</th>
											<th id="thfinped">Tamanho</th>
											<th id="thfinped">Cor</th>
											<th id="thfinped">Unidades</th>
											<th id="thfinped">Preço Unitário</th>
											<th id="thfinped">Desconto</th>
											<th id="thfinped">IPI</th>
											<th id="thfinped">Preço Pedido</th>
											<th id="thfinped">Quantidade</th>
											<th id="thfinped">Valor Total</th>
										</tr>
										<?php
										$sqlS = "select modelo, tamanho, sum(quantidade::numeric) as total,cor, unidade, priceunit, desconto, ipi, price_offer from pedidos where prevenda = '$prevenda' group by modelo, tamanho,cor, unidade, priceunit, desconto, ipi, price_offer order by modelo, tamanho,cor, unidade, priceunit, desconto, ipi, price_offer;";
										$exec = pg_query($sqlS);


										while ($getTot = pg_fetch_array($exec)) {
											$modelo   = $getTot['modelo'];
											$tamanho  = $getTot['tamanho'];
											$cor  = $getTot['cor'];
											$total    = $getTot['total'];
											$unidade  = $getTot['unidade'];
											$priceunit  = $getTot['priceunit'];
											$desconto  = $getTot['desconto'];
											$ipi  = $getTot['ipi'];
											$ipi_desc = $row['ipi_desc'];

											$ipi = str_replace('0.', '1.', $ipi);
											$precovenda  = $getTot['price_offer'];
											if ($unidade == "S") {
												$unidade = "Sacos";
											} else if ($unidade == "G") {
												$unidade = "Grosas";
											} else if ($unidade == "R") {
												$unidade = "Rolos";
											} else if ($unidade == "U") {
												$unidade = "Unidades";
											} else if ($unidade == "P") {
												$unidade = "Pacotes";
											} else if ($unidade == "K") {
												$unidade = "Kilos";
											}

											//VALOR TOTAL DE CADA LINHA
											$totline  = $total * $precovenda;
										?>
											<tr>
												<td id="tdfinped"><?php echo $modelo; ?></td>
												<td id="tdfinped"><?php echo $tamanho; ?></td>
												<td id="tdfinped"><?php echo $cor; ?></td>
												<td id="tdfinped"><?php echo $unidade; ?></td>
												<td id="tdfinped"><?php echo $priceunit; ?></td>
												<td id="tdfinped"><?php echo $desconto; ?></td>
												<td id="tdfinped"><?php echo $ipi; ?></td>
												<td id="tdfinped"><?php echo $precovenda; ?></td>
												<td id="tdfinped"><?php echo $total; ?></td>
												<td id="tdfinped"><?php echo $totline; ?></td>
											</tr>
										<?php
											$somatotal += $totline;
										} ?>
										<tr>
											<td id="tdfinped" colspan="8">Soma Total</td>
											<td id="tdfinped" colspan="2"><?php echo $somatotal; ?></td>
										</tr>
										<?php
										include $conecta_spo;
										$sqlDelPicking = "DELETE FROM pickinglist WHERE prevenda='$prevenda' AND prevenda<>'' AND  quantidade='0';";
										$execDelPicking = pg_query($sqlDelPicking);

										echo "</table>"; ?>
										<meta http-equiv="refresh" content="5;URL=http://192.168.0.234:89/spsisonbeta/spsison.php" />O PROGRAMA
										VOLTARÁ PARA O MENU EM 5 SEGUNDOS
									<?php
									break;
									//ADICIONANDO ITENS AO PEDIDO
								case "Adicionar Itens":
									?>
										<input type="submit" name="cmd" value="Escolher cor ou tamanho" class="ui-button ui-widget ui-corner-all" />

										<?php


										// FUNÇÃO PARA PEGAR A PORCENTAGEM DE DESCONTO QUANDO O USUARIO ENTRA O VALOR
										function porcentagemDiferencaDePreco($preco_original, $diferenca_preco)
										{
											$x = $diferenca_preco * 100;
											return $r = $x / $preco_original;
										}
										// FUNÇÃO PARA PEGAR A DIFERENÇA DE PREÇO QUANDO O USUARIO ENTRA O VALOR
										function diferencaDePreco($preco_original, $preco_novo)
										{
											if ($preco_novo > $preco_original) {
												return $diferenca_preco = $preco_novo - $preco_original;
											} else {
												return $diferenca_preco = $preco_original - $preco_novo;
											}
										}


										foreach ($_POST['quantidade'] as $indice => $quantidade_adicionada) {
											// CHECK IF PRECO PROMO IS LESS THAT THE PRICE REAL


											$velhacategoria           = array_shift($_POST['velhacategoria']);
											$modeloAdd           = array_shift($_POST['modelo']);
											$tamanhoAdd          = array_shift($_POST['tamanho']);
											$corAdd              = array_shift($_POST['cor']);
											$embalagemAdd        = array_shift($_POST['embalagem']);
											$registroAdd         = array_shift($_POST['codigo_barra']);
											$quantidadeAtualAdd  = array_shift($_POST['quantidadeestoque']); // QUANTIDADE DO ESTOQUE ATUAL
											$precounitarioAdd    = array_shift($_POST['precounitario']);
											$descaumtAdd         = array_shift($_POST['desconto']);
											$ipiAdd              = array_shift($_POST['ipi']);
											$precopedAdd         = array_shift($_POST['precopedido']);
											$procura23 = array(",");
											$acha23 = array(".");
											$precopedAdd = str_replace($procura23, $acha23, "$precopedAdd");
										?>
											<input type="hidden" name="embalagemback" value="<?php echo $embalagemAdd; ?>" />
											<!--renato-->
											<input type="hidden" name="modeloback" class="modelo_back" value="<?php echo $modeloAdd; ?>">

											<?php
											$preco_promocional = $precopedAdd;
											$totaldesconto  = diferencaDePreco($precounitarioAdd, $precopedAdd); // preco digitado
											$porcn 		  = porcentagemDiferencaDePreco($precounitarioAdd, $totaldesconto);
											$porcent = round($porcn);
											$porcentagem = $porcent;
											$descaumtAdd = $porcentagem;



											$quantidadePedidoAdd = $quantidade_adicionada; // QUANTIDADE QUE O USUARIO ADICIONOU PARA O PEDIDO
											$precototalAdd = $quantidade_adicionada * $precopedAdd; // PREÇO TOTAL PARA ADICIONAR NA LINHA]
											$procura23 = array(",");
											$acha23 = array(".");
											$precototalAdd = str_replace($procura23, $acha23, "$precototalAdd");


											if ($quantidadePedidoAdd > 0) {

												if ($quantidade_adicionada > $quantidadeAtualAdd) {
											?>
													<div class="ui-widget">
														<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
															<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
																<strong>Alerta:</strong>Item Modelo: <?php echo $modeloAdd; ?>
																Tamanho: <?php echo $tamanhoAdd; ?>
																Cor: <?php echo $corAdd; ?> não adicionado, quantidade maior que o estoque!
															</p>
														</div>
													</div>
													<?php
												} else {
													//testando para ver se tem no pedido
													include $conecta_ny;
													$selec = "SELECT registro FROM pedidos WHERE registro='$registroAdd' AND prevenda='$prevenda';";
													$execc = pg_query($selec);
													$jatemNoPedido = pg_affected_rows($execc);


													if ($jatemNoPedido > 0) {
													?>
														<div class="ui-widget">
															<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
																<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
																	<strong>Alerta:</strong>Item Modelo: <?php echo $modeloAdd; ?>
																	Tamanho: <?php echo $tamanhoAdd; ?>
																	Cor: <?php echo $corAdd; ?> não adicionado, ja existe no pedido!
																</p>
															</div>
														</div>
													<?php
														$error = 1;
													} else {
													?>
														<div class="ui-widget">
															<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
																<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
																	Item Modelo: <?php echo $modeloAdd; ?>
																	Tamanho: <?php echo $tamanhoAdd; ?>
																	Cor: <?php echo $corAdd; ?> Adicionado com sucesso!</p>
															</div>
														</div>
										<?php
														$usuariolog2 = $usuario . " (Interno)";
														$sqlI = "INSERT INTO pedidos(
                    			refped, modelo, tamanho, cor, quantidade, linha, registro, unidade, 
                    			prevenda, embalagem, priceunit, totprice, refline, transformado, 
                    			obslinha, velhacategoria, desconto, aprov_price, 
                    			price_offer, ipi, picking_qty, data_reg, hora_reg, user_reg)
                    			VALUES ('', '$modeloAdd', '$tamanhoAdd', '$corAdd', '$quantidadePedidoAdd', '1', '$registroAdd', '$embalagemAdd', 
                    			'$prevenda', '$embalagemAdd', '$precounitarioAdd', '$precototalAdd', '1', 'N', 
                    			'obslinha', '$velhacategoria', '$descaumtAdd', 'N', 
                    			'$precopedAdd','$ipiAdd','0', '$datalog', '$horalog', '$usuariolog2');";
														$exec = pg_query($sqlI);
														if ($tabela == 'VAREJO') {
															$estoquefisico = "armazem3";
															$estoquepreco = "estoque";
															$logtable = "logarmazem3";
															include $conecta_spo;
														} elseif ($tabela == "IMPORTACAO") {
															$estoquefisico = "armazem3";
															$estoquepreco = "estoque";
															$logtable = "logarmazem3";
															include $conecta_spo;
														} elseif ($tabela == "LOJA") {
															$estoquefisico = "a3varejo";
															$estoquepreco = "estvarejo";
															$logtable = "logestvarejo";
															include $conecta_var;
														} elseif ($tabela == "SITE") {
															$estoquefisico = "estsite";
															$estoquepreco = "estsite";
															$logtable = "logestsite";
															include $conecta_var;
														}
														$sqlU2 = "UPDATE $estoquefisico SET qtde=qtde - $quantidade_adicionada
							   	WHERE registro='$registroAdd';";


														$execU2 = pg_query($sqlU2);
														$totnovoestoque = $quantidadeAtualAdd - $quantidadePedidoAdd;
														$sqlIog = "INSERT INTO $logtable (data, hora, usuario, modelo, tamanho, embalagem, cor, velhaqtde, 
            				   	novaqtde, totnovo, registro,  acao,  motivo, chave)
    						   	VALUES ('$datalog', '$horalog', '$usuario','$modeloAdd', '$tamanhoAdd', '$embalagemAdd', '$corAdd', '$quantidadeAtualAdd',	 '$quantidadePedidoAdd','$totnovoestoque', '$registroAdd','-', 'adicionando ao pedido','$prevenda');";
														$execlog = pg_query($sqlIog);
													}
												}
											}
										}
										break;


									case "Escolher Embalagem":
										?>
										<script>
											$("#chosemodel").click(function() {
												$("#target").submit();
											});
										</script>
										<button id="chosemodel" value="Escolher Modelo">Escolher outro modelo</button>

										<?php

										/*
                Case OK - Começamos o código apresentando as embalagem de acordo com o modelo digitado inicialmente
              */
										$modelo = strtoupper(trim($_POST['modelo']));
										// get pack
										if ($tabela == 'VAREJO') {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "IMPORTACAO") {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "LOJA") {
											$estoquefisico = "a3varejo";
											$estoquepreco = "estvarejo";
											$logtable = "logestvarejo";
											include $conecta_var;
										} elseif ($tabela == "SITE") {
											$estoquefisico = "estsite";
											$estoquepreco = "estsite";
											$logtable = "logestsite";
											include $conecta_var;
										}


										if ($modelo == "ELASTICO-CHATO" || $modelo == "ELASTICO-CHATO2") {
											$sql = "SELECT embalagem from $estoquefisico where modelo = '$modelo' and qtde >'0' AND (EMBALAGEM ='Z' OR EMBALAGEM='P')  GROUP BY EMBALAGEM ORDER BY EMBALAGEM";
										} else {
											$sql = "SELECT embalagem from $estoquefisico where modelo = '$modelo' and qtde >'0' AND EMBALAGEM <>'Z' and posicao not in('U', 'S', 'D') GROUP BY EMBALAGEM ORDER BY EMBALAGEM";
										}

										$exec = pg_query($sql);
										echo "<h3 class=\"demoHeaders\">Modelo escolhido*: $modelo </h3>";

										if (pg_num_rows($exec) <= 0) {
											echo "<h3 style='color:red'>Embalagens não encontradas ou produto sem saldo ou bloqueado.</h3>";
										}

										?>
										<h3 class="demoHeaders">Escolha uma embalagem:</h3>
										<div id="radioset">
											<?php
											while ($row = pg_fetch_array($exec)) {
												$embalagem = trim($row['embalagem']);
												if ($embalagem == "Z") {
													$embdesc = "Caixa";
												} elseif ($embalagem == "R") {
													$embdesc = "Rolo";
												} elseif ($embalagem == "C") {
													$embdesc = "Cartela";
												} elseif ($embalagem == "S") {
													$embdesc = "Saco";
												} elseif ($embalagem == "G") {
													$embdesc = "Grosa";
												} elseif ($embalagem == "P") {
													$embdesc = "Pacote";
												} elseif ($embalagem == "U") {
													$embdesc = "Unidade";
												} elseif ($embalagem == "K") {
													$embdesc = "Kilo";
												} elseif ($embalagem == "M") {
													$embdesc = "Metro";
												}

											?>



												<input type="radio" id="<?php echo $embalagem ?>" name="embalagem" size="2" value="<?php echo $embalagem ?>">
												<label for="<?php echo $embalagem ?>"><?php echo $embdesc ?></label>
											<?php
											}
											?>



											<input type="submit" name="cmd" value="Escolher cor ou tamanho" class="ui-button ui-widget ui-corner-all" />
										</div>

										<!-- VARIAVEIS-->
										<input type="hidden" name="modelo" value="<?php echo $modelo; ?>" />
									<?php
										break;



									case "Escolher cor ou tamanho":
									?>
										<script>
											$("#choseemb").click(function() {
												$("#target").submit();
											});
										</script>
										<input type="submit" name="cmd" value="Escolher Embalagem" class="ui-button ui-widget ui-corner-all" />

										<?php

										/*
                Case Escolhe descricao - Pegamos o modelo e as embalagens escolhidas e 
              */
										if ($_POST['modeloback']) {
											$modelo = strtoupper(trim($_POST['modeloback']));
											$embalagem = strtoupper(trim($_POST['embalagemback']));
										} else {
											$modelo = strtoupper(trim($_POST['modelo']));
											$embalagem = $_POST['embalagem'];
										}



										// get pack



										if ($tabela == 'VAREJO') {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "IMPORTACAO") {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "LOJA") {
											$estoquefisico = "a3varejo";
											$estoquepreco = "estvarejo";
											$logtable = "logestvarejo";
											include $conecta_var;
										} elseif ($tabela == "SITE") {
											$estoquefisico = "estsite";
											$estoquepreco = "estsite";
											$logtable = "logestsite";
											include $conecta_var;
										}




										$sql = "SELECT tamanho from $estoquefisico where modelo='$modelo' AND embalagem='$embalagem' AND QTDE >'0' and posicao not in('U', 'S', 'D') GROUP BY tamanho ORDER BY tamanho";
										$exec = pg_query($sql);

										$sqlcores = "SELECT cor from $estoquefisico where modelo='$modelo' AND embalagem='$embalagem' AND QTDE >'0' and posicao not in('U', 'S', 'D') GROUP BY cor ORDER BY cor";


										$execcores = pg_query($sqlcores);
										if ($embalagem == "Z") {
											$embdesc = "Caixa";
										} elseif ($embalagem == "R") {
											$embdesc = "Rolo";
										} elseif ($embalagem == "C") {
											$embdesc = "Cartela";
										} elseif ($embalagem == "S") {
											$embdesc = "Saco";
										} elseif ($embalagem == "G") {
											$embdesc = "Grosa";
										} elseif ($embalagem == "P") {
											$embdesc = "Pacote";
										} elseif ($embalagem == "U") {
											$embdesc = "Unidade";
										} elseif ($embalagem == "K") {
											$embdesc = "Kilo";
										}

										echo "<h3 class=\"demoHeaders\">Modelo escolhido**: $modelo | Embalagem escolhida:  $embdesc </h3>";
										?>

										<?php

										?>
										<input type="hidden" name="embalagem" value="<?php echo $embalagem; ?>" />
										<?php
										?>

										<h3 class="demoHeaders">Tamanhos disponíveis:</h3>

										<div id="tamanhosdisponiveis">
											<?php
											if (pg_num_rows($exec) <= 0) {
												echo "<h3 style='color:red'>Cores não encontradas ou produto sem saldo ou bloqueado.</h3>";
											} else {
												while ($row = pg_fetch_array($exec)) {
													$tamanho = trim($row['tamanho']);

											?>

													<input type="radio" id="<?php echo "t" . $tamanho; ?>" name="tamanho" value="<?php echo $tamanho; ?>"><label for="<?php echo "t" . $tamanho; ?>"><?php echo $tamanho; ?></label>
											<?php
												}
											}
											?>





											<input type="submit" name="cmd" value="Escolher Cores" />
										</div>


										<h3 class="demoHeaders">Cores disponíveis:</h3>


										<div id="coresdisponiveis">
											<?php
											if (pg_num_rows($exec) <= 0) {
												echo "<h3 style='color:red'>Cores não encontradas ou produto sem saldo ou bloqueado.</h3>";
											} else {
												while ($rowcores = pg_fetch_array($execcores)) {
													$cores = trim($rowcores['cor']);
											?>

													<input type="radio" id="<?php echo $cores; ?>" name="cor" value="<?php echo $cores; ?>"><label for="<?php echo $cores; ?>"><?php echo $cores; ?></label>
											<?php
												}
											}
											?>
											<input type="submit" name="cmd" value="Escolher Tamanhos" />
										</div>

										<!--<input type="submit" name="cmd" value="Escolher Cores"/>-->
										<!-- VARIAVEIS-->
										<input type="hidden" name="modelo" value="<?php echo $modelo; ?>" />

									<?php
										break;

									case "Escolher Cores":
									?>
										<input type="submit" name="cmd" value="Escolher cor ou tamanho" class="ui-button ui-widget ui-corner-all" />
										<?php

										/*
                Case Escolhe descricao - Pegamos o modelo e as embalagens escolhidas e 
              */

										if ($tabela == 'VAREJO') {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "IMPORTACAO") {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "LOJA") {
											$estoquefisico = "a3varejo";
											$estoquepreco = "estvarejo";
											$logtable = "logestvarejo";
											include $conecta_var;
										} elseif ($tabela == "SITE") {
											$estoquefisico = "estsite";
											$estoquepreco = "estsite";
											$logtable = "logestsite";
											include $conecta_var;
										}

										$modelo = strtoupper(trim($_POST['modelo']));

										$sql = "SELECT cor from $estoquefisico where modelo='$modelo' AND embalagem='$_POST[embalagem]' AND tamanho='$_POST[tamanho]' and QTDE <>'0' and posicao not in('U', 'S', 'D') GROUP BY cor ORDER BY cor";
										$exec = pg_query($sql);


										if ($_POST['embalagem'] == "Z") {
											$embdesc = "Caixa";
										} elseif ($_POST['embalagem'] == "R") {
											$embdesc = "Rolo";
										} elseif ($_POST['embalagem'] == "C") {
											$embdesc = "Cartela";
										} elseif ($_POST['embalagem'] == "S") {
											$embdesc = "Saco";
										} elseif ($_POST['embalagem'] == "G") {
											$embdesc = "Grosa";
										} elseif ($_POST['embalagem'] == "P") {
											$embdesc = "Pacote";
										} elseif ($_POST['embalagem'] == "U") {
											$embdesc = "Unidade";
										} elseif ($_POST['embalagem'] == "K") {
											$embdesc = "Kilo";
										}


										echo "<h3 class=\"demoHeaders\"></h3>";
										echo "<h3 class=\"demoHeaders\">Modelo escolhido***: $modelo | Embalagem escolhida: $embdesc | Tamanho escolhido: $_POST[tamanho]</h3>";

										?>
										<input type="hidden" name="embalagem" value="<?php echo $_POST['embalagem']; ?>" />


										<input type="hidden" name="tamanho" value="<?php echo $_POST['tamanho']; ?>" />
										<?php
										foreach ($_POST['tamanho'] as $tamanhos) {
											$result2 = count($_POST['tamanho']);
											$sql .= $or2;
											$sql .= " tamanho='$tamanhos'";
											if ($result2 > 0) {
												$or2 = " OR ";
											}
										?>

											<input type="hidden" name="modelo" value="<?php echo $modelo; ?>" />
											<!--renato-->
										<?php
										}
										$sql .= " )";
										?>


										<h3 class="demoHeaders">Cores</h3>
										<div id="radioset">
											<?php
											if (pg_num_rows($exec) <= 0) {
												echo "<h3 style='color:red'>Cores não encontradas ou produto sem saldo ou bloqueado.</h3>";
											} else {
												while ($row = pg_fetch_array($exec)) {
													$cor = trim($row['cor']);
											?>
													<!--<input type="checkbox" name="cor[]" value="<?php echo $cor; ?>"><?php echo $cor; ?>-->

													<input type="checkbox" id="<?php echo $cor; ?>" name="cor[]" value="<?php echo $cor; ?>"><label for="<?php echo $cor; ?>"><?php echo $cor; ?></label>

											<?php
												}
											}
											?>
											<input type="submit" name="cmd" value="Gerar Formulario Cores" />
										</div>


										<!-- VARIAVEIS-->
										<input type="hidden" name="modelo" value="<?php echo $modelo; ?>" />
									<?php
										break;

										// ESCOLHER TAMANHOS
									case "Escolher Tamanhos":
									?>
										<input type="submit" name="cmd" value="Escolher cor ou tamanho" class="ui-button ui-widget ui-corner-all" />
										<?php

										/*
                Case Escolhe descricao - Pegamos o modelo e as embalagens escolhidas e 
              */
										if ($tabela == 'VAREJO') {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "IMPORTACAO") {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											$logtable = "logarmazem3";
											include $conecta_spo;
										} elseif ($tabela == "LOJA") {
											$estoquefisico = "a3varejo";
											$estoquepreco = "estvarejo";
											$logtable = "logestvarejo";
											include $conecta_var;
										} elseif ($tabela == "SITE") {
											$estoquefisico = "estsite";
											$estoquepreco = "estsite";
											$logtable = "logestsite";
											include $conecta_var;
										}

										$modelo = strtoupper(trim($_POST['modelo']));
										$sql = "SELECT tamanho from $estoquefisico where modelo='$modelo' AND embalagem='$_POST[embalagem]'   AND cor='$_POST[cor]' and QTDE <>'0' and posicao not in('U', 'S', 'D') GROUP BY tamanho ORDER BY tamanho";
										$exec = pg_query($sql);

										if ($_POST['embalagem'] == "Z") {
											$embdesc = "Caixa";
										} elseif ($_POST['embalagem'] == "R") {
											$embdesc = "Rolo";
										} elseif ($_POST['embalagem'] == "C") {
											$embdesc = "Cartela";
										} elseif ($_POST['embalagem'] == "S") {
											$embdesc = "Saco";
										} elseif ($_POST['embalagem'] == "G") {
											$embdesc = "Grosa";
										} elseif ($_POST['embalagem'] == "P") {
											$embdesc = "Pacote";
										} elseif ($_POST['embalagem'] == "U") {
											$embdesc = "Unidade";
										} elseif ($_POST['embalagem'] == "K") {
											$embdesc = "Kilo";
										}
										echo "<h3 class=\"demoHeaders\">Modelo escolhido****: $modelo | Embalagem escolhida: $embdesc | Cor escolhida: $_POST[cor]  </h3>";


										?>
										<input type="hidden" name="embalagem" value="<?php echo $_POST['embalagem']; ?>" />

										<input type="hidden" name="cor" value="<?php echo $_POST['cor']; ?>" />
										<?php
										foreach ($_POST['cor'] as $cores) {
											$result2 = count($_POST['cor']);
											$sql .= $or2;
											$sql .= " cor='$cores'";
											if ($result2 > 0) {
												$or2 = " OR ";
											}
										?>

											<input type="hidden" name="modelo" value="<?php echo $modelo; ?>" />
											<!--renato-->
										<?php
										}
										$sql .= " )";
										?>

										<h3 class="demoHeaders">Tamanhos</h3>
										<div id="radioset">
											<?php
											if (pg_num_rows($exec) <= 0) {
												echo "<h3 style='color:red'>Cores não encontradas ou produto sem saldo ou bloqueado.</h3>";
											} else {
												while ($row = pg_fetch_array($exec)) {
													$tamanho = trim($row['tamanho']);
											?>
													<input type="checkbox" id="<?php echo $tamanho; ?>" name="tamanho[]" value="<?php echo $tamanho; ?>"><label for="<?php echo $tamanho; ?>"><?php echo $tamanho; ?></label>

											<?php
												}
											}
											?>
											<input type="submit" name="cmd" value="Gerar Formulario Tamanhos" class="ui-button ui-widget ui-corner-all" />
										</div>
										<!-- VARIAVEIS-->
										<input type="hidden" name="modelo" value="<?php echo $modelo; ?>" />
									<?php
										break;
										// FIM ESCOLHER TAMANHOS		  
										//FORMULARIO POR CORES         
									case "Gerar Formulario Cores":



									?>
										<input type="submit" name="cmd" value="Escolher cor ou tamanho" class="ui-button ui-widget ui-corner-all" />
										<input type="hidden" name="modelo" value="<?php echo $modelo; ?>" />
										<!--renato-->
										<input type="hidden" name="embalagemback" value="<?php echo $_POST['embalagem']; ?>" />
										<!--renato-->
										<input type="hidden" name="modeloback" class="modelo_back" value="<?php echo $_POST['modeloback']; ?>">

										<?php
										$modelo = strtoupper(trim($_POST['modelo']));
										?>
										<br>


										<?php

										if ($tabela == 'VAREJO') {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											include $conecta_spo;
										} elseif ($tabela == "IMPORTACAO") {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											include $conecta_spo;
										} elseif ($tabela == "LOJA") {
											$estoquefisico = "a3varejo";
											$estoquepreco = "estvarejo";
											include $conecta_var;
										} elseif ($tabela == "SITE") {
											$estoquefisico = "estsite";
											$estoquepreco = "estsite";
											$logtable = "logestsite";
											include $conecta_var;
										}


										$sql = "SELECT $estoquepreco.multiplo_observacao,$estoquepreco.avaria,$estoquefisico.velhacategoria,$estoquefisico.embint,$estoquefisico.qtdeembint, $estoquefisico.embfinal, $estoquefisico.qtdeembfinal,$estoquefisico.qualembusar, $estoquefisico.modelo,$estoquefisico.registro, $estoquefisico.tamanho, $estoquefisico.cor, $estoquefisico.embalagem, $estoquefisico.qtde, $estoquepreco.precovarejo, $estoquepreco.ipi,$estoquepreco.ipi_desc 
                    FROM $estoquefisico, $estoquepreco 
					WHERE $estoquefisico.posicao <>'S' and $estoquefisico.posicao <>'U' and $estoquefisico.posicao <>'D' AND $estoquefisico.registro=$estoquepreco.registro AND $estoquepreco.tamanho='$_POST[tamanho]' AND $estoquepreco.embalagem='$_POST[embalagem]' AND  $estoquefisico.qtde <>'0' and  $estoquepreco.modelo='$modelo' AND ( ";
										?>

										<?php

										foreach ($_POST['cor'] as $cores) {
											$result1 = count($_POST['cor']);
											$sql .= $or1;
											$sql .= " $estoquepreco.cor='$cores'";
											if ($result1 > 0) {
												$or1 = " OR ";
											}
										?>
											<!-- <input type="hidden" name="cor[]" value="<?php echo $cores; ?>"/> -->
										<?php
										}

										$sql .= " ) ORDER BY  $estoquepreco.modelo, $estoquepreco.tamanho, $estoquepreco.cor, $estoquepreco.embalagem";
										//print $sql;
										?>
										<table>
											<tr>
												<td>Modelo</td>
												<td>Tamanho</td>
												<td>Cor</td>
												<td>Embalagem</td>
												<td>Quantidade</td>
												<td>Preco Unit</td>
												<td>Desc/Aumt</td>
												<td>Preço Ped<br><a href="#" id="igualar" class="copyprecopedido"><small>Igualar</small></a></td>
												<td>IPI</td>
												<td>Preço c/ IPI</td>
												<td>Adicionar<br><a href="#" id="igualar" class="copyqtde"><small>Igualar</small></a></td>
												<td>Obs #</td>
											</tr>

											<?php
											// adicionar o valor já calculado com desconto global
											function precoPlusDesc($precounitario, $descontoglob)
											{

												$j = $precounitario * $descontoglob;
												$k = $j / 100;

												return  $precounitario - $k;
											}


											function arredondar_dois_decimal($valor)
											{
												$float_arredondar = round($valor * 100) / 100;
												return $float_arredondado;
											}


											$exec = pg_query($sql);

											if (pg_num_rows($exec) <= 0) {
												echo "<h3 style='color:red'>Produto não encontrado ou produto sem saldo ou bloqueado.</h3>";
											}

											while ($row = pg_fetch_array($exec)) {
												$modelo = $row['modelo'];
												$tamanho = $row['tamanho'];
												$cor = $row['cor'];
												$embalagem = $row['embalagem'];
												$quantidade = $row['qtde'];
												$precoatacado = $row['precoatacado'];
												$precounitario = $row['precovarejo'];
												$registro = $row['registro'];
												$avaria = $row['avaria'];
												$velhacategoria = $row['velhacategoria'];
												$embint = $row['embint'];
												$qtdeembint = $row['qtdeembint'];
												$embfinal = $row['embfinal'];
												$qtdeembfinal = $row['qtdeembfinal'];
												$qualembusar = trim($row['qualembusar']);
												$multiplo_observacao = trim($row['multiplo_observacao']);




												if ($aumentoglob == "5") {
													$preco_plus_desconto = $precounitario * 1.05;
												} else if ($aumentoglob == "10") {
													$preco_plus_desconto = $precounitario * 1.10;
												} else if ($aumentoglob == "12") {
													$preco_plus_desconto = $precounitario * 1.12;
												} else if ($aumentoglob == "15") {
													$preco_plus_desconto = $precounitario * 1.15;
												} else if ($aumentoglob == "20") {
													$preco_plus_desconto = $precounitario * 1.20;
												} else if ($aumentoglob == "25") {
													$preco_plus_desconto = $precounitario * 1.25;
												} else if ($aumentoglob == "30") {
													$preco_plus_desconto = $precounitario * 1.30;
												} else if ($aumentoglob == "35") {
													$preco_plus_desconto = $precounitario * 1.35;
												} else if ($aumentoglob == "40") {
													$preco_plus_desconto = $precounitario * 1.40;
												} else if ($aumentoglob == "45") {
													$preco_plus_desconto = $precounitario * 1.45;
												} else if ($aumentoglob == "50") {
													$preco_plus_desconto = $precounitario * 1.50;
												} else if ($aumentoglob == "55") {
													$preco_plus_desconto = $precounitario * 1.55;
												} else if ($aumentoglob == "60") {
													$preco_plus_desconto = $precounitario * 1.60;
												} else if ($aumentoglob == "65") {
													$preco_plus_desconto = $precounitario * 1.65;
												} else if ($aumentoglob == "70") {
													$preco_plus_desconto = $precounitario * 1.70;
												} else if ($aumentoglob == "75") {
													$preco_plus_desconto = $precounitario * 1.75;
												} else if ($aumentoglob == "80") {
													$preco_plus_desconto = $precounitario * 1.80;
												} else if ($aumentoglob == "85") {
													$preco_plus_desconto = $precounitario * 1.85;
												} else if ($aumentoglob == "90") {
													$preco_plus_desconto = $precounitario * 1.90;
												} else if ($aumentoglob == "95") {
													$preco_plus_desconto = $precounitario * 1.95;
												} else if ($aumentoglob == "100") {
													$preco_plus_desconto = $precounitario * 2.00;
												} else if ($aumentoglob == "105") {
													$preco_plus_desconto = $precounitario * 2.05;
												} else if ($aumentoglob == "110") {
													$preco_plus_desconto = $precounitario * 2.10;
												} else if ($aumentoglob == "115") {
													$preco_plus_desconto = $precounitario * 2.15;
												} else if ($aumentoglob == "120") {
													$preco_plus_desconto = $precounitario * 2.20;
												} else if ($aumentoglob == "125") {
													$preco_plus_desconto = $precounitario * 2.25;
												} else if ($aumentoglob == "130") {
													$preco_plus_desconto = $precounitario * 2.30;
												} else if ($aumentoglob == "135") {
													$preco_plus_desconto = $precounitario * 2.35;
												} else if ($aumentoglob == "140") {
													$preco_plus_desconto = $precounitario * 2.40;
												} else if ($aumentoglob == "145") {
													$preco_plus_desconto = $precounitario * 2.45;
												} else if ($aumentoglob == "150") {
													$preco_plus_desconto = $precounitario * 2.50;
												} else {
													$preco_plus_desconto = precoPlusDesc($precounitario, $descontoglob);
												}

												if ($precounitario) {
													$precounitario = $precounitario;
												} else {
													$precounitario = $row['precovarejo'];
												}
												$ipi = $row['ipi'];
												$ipi_desc = $row['ipi_desc'];

											?>
												<tr id="formulario">
													<td>
														<input type="hidden" class="modelo_back" name="modeloback" value="<?php echo $modelo; ?>" />
														<!--renato-->
														<input type="hidden" name="embalagemback" value="<?php echo $_POST['embalagem']; ?>" />
														<!--renato-->

														<input type="text" name="modelo[]" id="modelo" value="<?php echo $modelo; ?>" tabindex="0" size="10" readonly />
													</td>
													<td>
														<input type="text" name="tamanho[]" size="5" id="tamanho" value="<?php echo $tamanho; ?>" tabindex="0" size="8" readonly />
													</td>
													<td><input type="text" name="cor[]" id="cor" value="<?php echo $cor; ?>" size="8" tabindex="0" readonly />
													</td>
													<td>
														<?php
														if ($qualembusar == "embalagem") {
															$unidadesdesc = $qtdeembint;
														} elseif ($qualembusar == "embint") {
															$unidadesdesc = $qtdeembint;
														} elseif ($qualembusar == "embfinal") {
															$unidadesdesc = $qtdeembint * $qtdeembfinal;
														}

														if ($embalagem == "Z") {
															$embdesc = "Caixa";
														} elseif ($embalagem == "R") {
															$embdesc = "Rolo";
														} elseif ($embalagem == "C") {
															$embdesc = "Cartela";
														} elseif ($embalagem == "S") {
															$embdesc = "Saco";
														} elseif ($embalagem == "G") {
															$embdesc = "Grosa";
														} elseif ($embalagem == "P") {
															$embdesc = "Pacote";
														} elseif ($embalagem == "U") {
															$embdesc = "Unidade";
														} elseif ($embalagem == "K") {
															$embdesc = "Kilo";
														}

														if ($embint == "Z") {
															$embintdesc = "Caixas";
														} elseif ($embint == "R") {
															$embintdesc = "Rolos";
														} elseif ($embint == "C") {
															$embintdesc = "Cartelas";
														} elseif ($embint == "S") {
															$embintdesc = "Sacos";
														} elseif ($embint == "G") {
															$embintdesc = "Grosas";
														} elseif ($embint == "P") {
															$embintdesc = "Pacotes";
														} elseif ($embint == "U") {
															$embintdesc = "Unidades";
														} elseif ($embint == "K") {
															$embintdesc = "Kilos";
														} elseif ($embint == "M") {
															$embintdesc = "Metros";
														}
														?>

														<input type="text" name="embalagem[]" id="embalagem" size="2" value="<?php echo $embalagem; ?>" size="8" />
														(<small><?php echo $embdesc . " com " . $unidadesdesc . " " . $embintdesc ?></small>)

													</td>
													<td><input type="text" name="quantidadeestoque[]" id="quantidadeestoque" value="<?php echo $quantidade; ?>" tabindex="0" size="8" readonly />
													</td>
													<td><input type="text" name="precounitario[]" id="precounitario" value="<?php echo $precounitario; ?>" tabindex="0" size="12" readonly />
													</td>
													<td>


														<?php
														if ($descontoglob != 0) {
															$changeRealPrice = $descontoglob;
														} elseif ($aumentoglob != 0) {
															$changeRealPrice = $aumentoglob;
														} elseif ($descontoglob == "" && $aumentoglob == "") {
															$changeRealPrice      = 0;
														} elseif ($descontoglob == 0 && $aumentoglob == 0) {
															$changeRealPrice      = 0;
														}


														$aumentoipi = 1;
														$ipi = str_replace('0.', '1.', $ipi);
														$precocomipi = $preco_plus_desconto * $ipi;


														?>
														<input type="text" name="desconto[]" id="desconto" value="<?php echo $changeRealPrice; ?>" size="3" tabindex="0" readonly />

													<td>
														<input type="text" name="precopedido[]" id="precopedido" value="<?php echo $preco_plus_desconto; ?>" class="copyprecopedido1" tabindex="0" size="12" <?php if ($desconto_linha == "NAO") {
																																																					echo "readonly";
																																																				} ?> />
													</td>
													<td>
														<?php
														$ipi = str_replace('1.', '0.', $ipi);
														?>
														<input type="text" name="ipi[]" id="ipi" value="<?php echo $ipi_desc; ?>" size="6" tabindex="0" />
													</td>
													<td>
														<input type="text" name="precopedidoipi[]" id="precopedidoipi" value="<?php echo $precocomipi; ?>" tabindex="0" size="12" readonly />
													</td>

													<td>

														<input type="text" name="quantidade[]" autocomplete="off" id="qtdetoadd" size="8" class="copyqty input-qtde" tabindex="1" onchange="getTotValue(this)" max="<?php echo $quantidade ?>" <?php if (($precounitario == "" || $precounitario == 0) && $codigo_cliente <> "NYMO") {
																																																													echo "readonly";
																																																												} ?> onkeypress="return alpha(event)" />
														<input type="hidden" name="codigo_barra[]" id="codigo_barra" value="<?php echo $registro; ?>" />
														<input type="hidden" name="velhacategoria[]" id="velhacategoria" value="<?php echo $velhacategoria; ?>" />
													</td>
													<td>

														<?php
														if ($avaria == "S") {
															$sqlAV = "SELECT acaocomercial	FROM defeitos WHERE registro = '$registro' AND situacao = 'ativo';";
															$execAV = pg_query($sqlAV);
															$rowAV = pg_fetch_array($execAV);
															echo "<small style=\"color:red\">" . $acao_comercial = utf8_encode($rowAV['acaocomercial']) . "</small>";
														}

														if (empty($precounitario)) {
															echo "<br><br><b style='color:red;'>Sem preço, falar com Mary</b>";
														}

														echo "<br><font color=\"red\" ><B><small>" . $multiplo_observacao . "</small><B></font>";
														?>
													</td>
												</tr>

											<?php

											}
											?>
										</table><br>

										<?php

										if ($situacao == "Cadastrado") {
										?>
											<input type="submit" name="cmd" value="Adicionar Itens" class="ui-button ui-widget ui-corner-all add-item-btn" />
										<?php
										}
										break;
										//FORMULARIO POR TAMANHOS         
									case "Gerar Formulario Tamanhos":
										?>
										<input type="hidden" name="embalagemback" value="<?php echo $_POST['embalagem']; ?>" />
										<!--renato-->
										<input type="hidden" name="modeloback" class="modelo_back" value="<?php echo $_POST['modeloback']; ?>">
										<input type="submit" name="cmd" value="Escolher cor ou tamanho" class="ui-button ui-widget ui-corner-all" />

										<?php
										$modelo = strtoupper(trim($_POST['modelo']));
										?>
										Modelo: <?php echo $modelo; ?> <br>


										<?php

										if ($tabela == 'VAREJO') {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											include $conecta_spo;
										} elseif ($tabela == "IMPORTACAO") {
											$estoquefisico = "armazem3";
											$estoquepreco = "estoque";
											include $conecta_spo;
										} elseif ($tabela == "LOJA") {
											$estoquefisico = "a3varejo";
											$estoquepreco = "estvarejo";
											include $conecta_var;
										} elseif ($tabela == "SITE") {
											$estoquefisico = "estsite";
											$estoquepreco = "estsite";
											$logtable = "logestsite";
											include $conecta_var;
										}


										$sql = "SELECT $estoquepreco.avaria,$estoquepreco.multiplo_observacao, $estoquefisico.velhacategoria,$estoquefisico.embint,$estoquefisico.qtdeembint, $estoquefisico.embfinal, $estoquefisico.qtdeembfinal,$estoquefisico.qualembusar,$estoquefisico.modelo,$estoquefisico.registro, $estoquefisico.tamanho, $estoquefisico.cor, $estoquefisico.embalagem, $estoquefisico.qtde, $estoquepreco.precovarejo, $estoquepreco.ipi,$estoquepreco.ipi_desc 
                                        FROM $estoquefisico, $estoquepreco WHERE $estoquefisico.posicao <>'S' and $estoquefisico.posicao <>'U'  and $estoquefisico.posicao <>'D'  AND  $estoquefisico.registro=$estoquepreco.registro AND $estoquepreco.cor='$_POST[cor]' AND $estoquepreco.embalagem='$_POST[embalagem]' AND  $estoquefisico.qtde <>'0' and  $estoquepreco.modelo='$modelo' AND ( ";


										foreach ($_POST['tamanho'] as $tamanhos) {
											$result1 = count($_POST['tamanho']);
											$sql .= $or1;
											$sql .= " $estoquepreco.tamanho='$tamanhos'";
											if ($result1 > 0) {
												$or1 = " OR ";
											}
										?>
											<!--<input type="hidden" name="cor[]" value="<?php echo $cores; ?>"/>-->
										<?php
										}

										$sql .= " ) ORDER BY  $estoquepreco.modelo, $estoquepreco.tamanho, $estoquepreco.cor, $estoquepreco.embalagem";
										//print $sql;
										?>
										<table>
											<tr>
												<td>Modelo</td>
												<td>Tamanho</td>
												<td>Cor</td>
												<td>Embalagem</td>
												<td>Quantidade</td>
												<td>Preco Unit</td>
												<td>Desc/Aumt</td>
												<td>Preço Ped<br><a href="#" id="igualar" class="copyprecopedido"><small>Igualar</small></a></td>
												<td>IPI</td>
												<td>Preço c/ IPI</td>
												<td>Adicionar<br><a href="#" id="igualar" class="copyqtde"><small>Igualar</small></a></td>
												<td>Obs *</td>
											</tr>

											<?php
											// adicionar o valor já calculado com desconto global
											function precoPlusDesc($precounitario, $descontoglob)
											{

												$j = $precounitario * $descontoglob;
												$k = $j / 100;

												return  $precounitario - $k;
											}


											function arredondar_dois_decimal($valor)
											{
												$float_arredondar = round($valor * 100) / 100;
												return $float_arredondado;
											}

											$exec = pg_query($sql);
											if (pg_num_rows($exec) <= 0) {
												echo "<h3 style='color:red'>Produto não encontrado ou produto sem saldo ou bloqueado.</h3>";
											}

											while ($row = pg_fetch_array($exec)) {
												$modelo = $row['modelo'];
												$tamanho = $row['tamanho'];
												$cor = $row['cor'];
												$embalagem = $row['embalagem'];
												$quantidade = $row['qtde'];
												$precoatacado = $row['precoatacado'];
												$precounitario = $row['precovarejo'];
												$registro = $row['registro'];
												$avaria = $row['avaria'];

												$velhacategoria = $row['velhacategoria'];
												$embint = $row['embint'];
												$qtdeembint = $row['qtdeembint'];
												$embfinal = $row['embfinal'];
												$qtdeembfinal = $row['qtdeembfinal'];
												$qualembusar = trim($row['qualembusar']);
												$multiplo_observacao = trim($row['multiplo_observacao']);


												if ($aumentoglob == "5") {
													$preco_plus_desconto = $precounitario * 1.05;
												} else if ($aumentoglob == "10") {
													$preco_plus_desconto = $precounitario * 1.10;
												} else if ($aumentoglob == "15") {
													$preco_plus_desconto = $precounitario * 1.15;
												} else if ($aumentoglob == "20") {
													$preco_plus_desconto = $precounitario * 1.20;
												} else if ($aumentoglob == "25") {
													$preco_plus_desconto = $precounitario * 1.25;
												} else if ($aumentoglob == "30") {
													$preco_plus_desconto = $precounitario * 1.30;
												} else if ($aumentoglob == "35") {
													$preco_plus_desconto = $precounitario * 1.35;
												} else if ($aumentoglob == "40") {
													$preco_plus_desconto = $precounitario * 1.40;
												} else if ($aumentoglob == "45") {
													$preco_plus_desconto = $precounitario * 1.45;
												} else if ($aumentoglob == "50") {
													$preco_plus_desconto = $precounitario * 1.50;
												} else if ($aumentoglob == "55") {
													$preco_plus_desconto = $precounitario * 1.55;
												} else if ($aumentoglob == "60") {
													$preco_plus_desconto = $precounitario * 1.60;
												} else if ($aumentoglob == "65") {
													$preco_plus_desconto = $precounitario * 1.65;
												} else if ($aumentoglob == "70") {
													$preco_plus_desconto = $precounitario * 1.70;
												} else if ($aumentoglob == "75") {
													$preco_plus_desconto = $precounitario * 1.75;
												} else if ($aumentoglob == "80") {
													$preco_plus_desconto = $precounitario * 1.80;
												} else if ($aumentoglob == "85") {
													$preco_plus_desconto = $precounitario * 1.85;
												} else if ($aumentoglob == "90") {
													$preco_plus_desconto = $precounitario * 1.90;
												} else if ($aumentoglob == "95") {
													$preco_plus_desconto = $precounitario * 1.95;
												} else if ($aumentoglob == "100") {
													$preco_plus_desconto = $precounitario * 2.00;
												} else if ($aumentoglob == "105") {
													$preco_plus_desconto = $precounitario * 2.05;
												} else if ($aumentoglob == "110") {
													$preco_plus_desconto = $precounitario * 2.10;
												} else if ($aumentoglob == "115") {
													$preco_plus_desconto = $precounitario * 2.15;
												} else if ($aumentoglob == "120") {
													$preco_plus_desconto = $precounitario * 2.20;
												} else if ($aumentoglob == "125") {
													$preco_plus_desconto = $precounitario * 2.25;
												} else if ($aumentoglob == "130") {
													$preco_plus_desconto = $precounitario * 2.30;
												} else if ($aumentoglob == "135") {
													$preco_plus_desconto = $precounitario * 2.35;
												} else if ($aumentoglob == "140") {
													$preco_plus_desconto = $precounitario * 2.40;
												} else if ($aumentoglob == "145") {
													$preco_plus_desconto = $precounitario * 2.45;
												} else if ($aumentoglob == "150") {
													$preco_plus_desconto = $precounitario * 2.50;
												} else {
													$preco_plus_desconto = precoPlusDesc($precounitario, $descontoglob);
												}

												if ($precounitario) {
													$precounitario = $precounitario;
												} else {
													$precounitario = $row['precovarejo'];
												}
												$ipi = $row['ipi'];
												$ipi_desc = $row['ipi_desc'];
											?>

												<tr>
													<td>
														<input type="hidden" class="modelo_back" name="modeloback" value="<?php echo $modelo; ?>" />
														<!--renato-->
														<input type="hidden" name="embalagemback" value="<?php echo $_POST['embalagem']; ?>" />
														<!--renato-->

														<input type="text" name="modelo[]" size="5" id="modelo" value="<?php echo $modelo; ?>" tabindex="0" size="8" readonly />
													</td>
													<td>
														<input type="text" name="tamanho[]" id="tamanho" value="<?php echo $tamanho; ?>" tabindex="0" size="8" readonly />
													</td>
													<td><input type="text" name="cor[]" id="cor" value="<?php echo $cor; ?>" size="8" tabindex="0" readonly />
													</td>
													<td>
														<?php

														if ($qualembusar == "embalagem") {
															$unidadesdesc = $qtdeembint;
														} elseif ($qualembusar == "embint") {
															$unidadesdesc = $qtdeembint;
														} elseif ($qualembusar == "embfinal") {
															$unidadesdesc = $qtdeembint * $qtdeembfinal;
														}

														if ($embalagem == "Z") {
															$embdesc = "Caixa";
														} elseif ($embalagem == "R") {
															$embdesc = "Rolo";
														} elseif ($embalagem == "C") {
															$embdesc = "Cartela";
														} elseif ($embalagem == "S") {
															$embdesc = "Saco";
														} elseif ($embalagem == "G") {
															$embdesc = "Grosa";
														} elseif ($embalagem == "P") {
															$embdesc = "Pacote";
														} elseif ($embalagem == "U") {
															$embdesc = "Unidade";
														} elseif ($embalagem == "K") {
															$embdesc = "Kilo";
														}
														if ($embint == "Z") {
															$embintdesc = "Caixas";
														} elseif ($embint == "R") {
															$embintdesc = "Rolos";
														} elseif ($embint == "C") {
															$embintdesc = "Cartelas";
														} elseif ($embint == "S") {
															$embintdesc = "Sacos";
														} elseif ($embint == "G") {
															$embintdesc = "Grosas";
														} elseif ($embint == "P") {
															$embintdesc = "Pacotes";
														} elseif ($embint == "U") {
															$embintdesc = "Unidades";
														} elseif ($embint == "K") {
															$embintdesc = "Kilos";
														} elseif ($embint == "M") {
															$embintdesc = "Metros";
														}

														?>


														<input type="text" name="embalagem[]" id="embalagem" size="2" value="<?php echo $embalagem; ?>" size="8" />
														(<small><?php echo $embdesc . " com " . $unidadesdesc . " " . $embintdesc  ?></small>)

													</td>
													<td><input type="text" name="quantidadeestoque[]" id="quantidadeestoque" value="<?php echo $quantidade; ?>" tabindex="0" size="8" readonly />
													</td>
													<td><input type="text" name="precounitario[]" id="precounitario" value="<?php echo $precounitario; ?>" tabindex="0" size="12" readonly />
													</td>
													<td>
														<?php
														if ($descontoglob != 0) {
															$changeRealPrice = $descontoglob;
														} elseif ($aumentoglob != 0) {
															$changeRealPrice = $aumentoglob;
														} elseif ($descontoglob == "" && $aumentoglob == "") {
															$changeRealPrice      = 0;
														} elseif ($descontoglob == 0 && $aumentoglob == 0) {
															$changeRealPrice      = 0;
														}


														$aumentoipi = 1;
														$ipi = str_replace('0.', '1.', $ipi);
														$precocomipi = $preco_plus_desconto  * $ipi;
														?>
														<input type="text" name="desconto[]" id="desconto" value="<?php echo $changeRealPrice; ?>" size="3" tabindex="0" readonly />
														<?php
														?>
													</td>
													<td>
														<input type="text" name="precopedido[]" id="precopedido" class="copyprecopedido1" value="<?php echo $preco_plus_desconto; ?>" tabindex="0" size="12" <?php if ($desconto_linha == "NAO") {
																																																					echo "readonly";
																																																				} ?> />

													</td>
													<td>
														<?php
														$ipi = str_replace('1.', '0.', $ipi);
														?>

														<input type="text" name="ipi[]" id="ipi" value="<?php echo $ipi_desc; ?>" size="6" tabindex="0" />
													</td>
													<td>
														<input type="text" name="precopedidoipi[]" id="precopedidoipi" value="<?php echo $precocomipi; ?>" tabindex="0" size="12" readonly />
													</td>
													<td>
														<input type="text" name="quantidade[]" autocomplete="off" id="qtdetoadd" size="8" tabindex="1" class="copyqty input-qtde" onchange="getTotValue(this)" max="<?php echo $quantidade ?>" <?php
																																																												if ($precounitario == "") {
																																																													echo "readonly";
																																																												}
																																																												?> onkeypress="return alpha(event)" />
														<input type="hidden" name="codigo_barra[]" id="codigo_barra" value="<?php echo $registro; ?>" />
														<input type="hidden" name="velhacategoria[]" id="velhacategoria" value="<?php echo $velhacategoria; ?>" />
													</td>
													<td>

														<?php
														if ($avaria == "S") {
															$sqlAV = "SELECT acaocomercial 
						FROM defeitos 
						WHERE registro = '$registro' AND situacao = 'ativo';";
															$execAV = pg_query($sqlAV);
															$rowAV = pg_fetch_array($execAV);
															echo "<small style=\"color:red\">" . $acao_comercial = utf8_encode($rowAV['acaocomercial']) . "</small>";
														}
														echo "<br><font color=\"red\" ><B><small>" . $multiplo_observacao . "</small><B></font>";

														?>
													</td>

												</tr>
											<?php

											}
											?>
										</table><br>

										<?php
										if ($situacao == "Cadastrado") {
										?>
											<input type="submit" name="cmd" value="Adicionar Itens" class="ui-button ui-widget ui-corner-all add-item-btn" />
										<?php
										}
										break;

									default:
										?>
										Modelo: <img src="./images/refresh.png" width="20px" height="20px" style="cursor:pointer;" onclick="atualizaLIsta();">&nbsp;&nbsp;<span><input type="text" name="modelo" id="modelo" size="25" autofocus="autofocus"> </span>
										<input type="hidden" id="tabelaParaJquery" value="<?php echo $tabela; ?>">

										<input type="submit" name="cmd" value="Escolher Embalagem" class="ui-button ui-widget ui-corner-all" /><br>
										<span id="desc-atualiza"></span>
								<?php
								}
								?>
			</div>


			<h3><input type="button" name="cmd" value="Voltar Menu" class="ui-button ui-widget ui-corner-all" onclick="menuPrincipal();" />
				<span id="valor-total-do-pedido"><?php //echo $valor_total_do_pedido; 
													?></span> | Tabela: <?php echo $tabela ?> | Prevenda:
				<?php echo $prevenda; ?>
			</h3>

			<div>
			</div>
		</div>
	</form>
	<script src="external/jquery/jquery.js"></script>
	<script src="jquery-ui.js"></script>
	<script src="nybc.js"></script>
	<script src="./jquery.blockUI.js"></script>
	<script>
		//Essa função LIMITA ao campo que chama a função com onkeypress somente os caracteres que atendem o return com keyCode.
		function alpha(e) {
			var k;
			document.all ? k = e.keyCode : k = e.which;
			return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57) || k == 46);
		}

		function checkQty() {
			var qty = Number(document.getElementById('changeqty').value);
			if (qty == "0") {
				alert('Quantidade zero nao permitido.');
				document.getElementById('changeqty').value = 1;
				document.getElementById('changeqty').focus();
			}
		}
	</script>

	<script>
		function menuPrincipal() {
			window.open("http://192.168.0.234:89/spsisonbeta/spsison.php", "_self");
		}

		$("#accordion").accordion({
			heightStyle: "content"
		});

		$(function() {
			$(".widget input[type=submit], .widget a, .widget button").button();
			$("button, input, a").click(function(event) {

			});
		});




		$("#button").button();
		$("#chosemodel").button();
		$("#choseemb").button();
		$("#button-icon").button({
			icon: "ui-icon-gear",
			showLabel: false
		});

		$("#radioset").buttonset();
		$("#coresdisponiveis").buttonset();
		$("#tamanhosdisponiveis").buttonset();
		$("#controlgroup").controlgroup();
		$("#tabs").tabs();
		$("#dialog").dialog({
			autoOpen: false,
			width: 400,
			buttons: [{
					text: "Ok",
					click: function() {
						$(this).dialog("close");
					}
				},
				{
					text: "Cancel",
					click: function() {
						$(this).dialog("close");
					}
				}
			]
		});

		document.addEventListener('DOMContentLoaded', () => {
			let prevenda = document.getElementById('numero-prevenda').textContent
			get_valor_prevenda(prevenda)
		})


		// Link to open the dialog
		$("#dialog-link").click(function(event) {
			$("#dialog").dialog("open");
			event.preventDefault();
		});


		$("tr").not(':first').hover(
			function() {
				$(this).css("background", "yellow");
			},
			function() {
				$(this).css("background", "");
			}
		);


		$("#datepicker").datepicker({
			inline: true
		});



		$("#slider").slider({
			range: true,
			values: [17, 67]
		});

		$("#progressbar").progressbar({
			value: 20
		});

		$("#spinner").spinner();
		$("#menu").menu();
		$("#tooltip").tooltip();
		$("#selectmenu").selectmenu();
		// Hover states on the static widgets
		$("#dialog-link, #icons li").hover(
			function() {
				$(this).addClass("ui-state-hover");
			},
			function() {
				$(this).removeClass("ui-state-hover");
			}
		);

		$(function() {
			var projects = [
				<?php if ($tabela == "LOJA") {
					include 'inc/modelosLoja.json.php';
				} else if ($tabela == "SITE") {
					include 'inc/modelosSite.json.php';
				} else {
					include 'inc/modelosMatriz.json.php';
				} ?>
			];


			$("#modelo").autocomplete({
					minLength: 0,
					source: projects,
					focus: function(event, ui) {
						$("#modelo").val(ui.item.label);
						return false;
					},
					select: function(event, ui) {
						$("#modelo").val(ui.item.label);
						$("#modelo-id").val(ui.item.value);
						$("#modelo-description").html(ui.item.desc);
						return false;
					}
				})
				.data("ui-autocomplete")._renderItem = function(ul, item) {
					return $("<li>")
						.append("<a>" + item.label + " -  " + item.desc + "</a>")
						.appendTo(ul);
				};
		});


		function get_valor_prevenda(prevenda) {
			console.log(prevenda)
			$.ajax({
				url: 'api/api.php',
				type: 'GET',
				data: {
					prevenda: prevenda,
					action: 'get_valor_prevenda'
				},
				success: function(response) {
					response = JSON.parse(response)
					console.log('bait', response); // exibe a resposta do servidor no console do navegador
					document.getElementById('valor-total-do-pedido').textContent = `R$ ${response.valorped}`
				},
				error: function(xhr, status, error) {
					console.log('nilo', xhr.responseText); // exibe a mensagem de erro no console do navegador
				}
			});

		}

		function atualizaLIsta() {
			let tabela1 = $('#tabelaParaJquery').val();
			if (tabela1 === "VAREJO") {
				var url_url = 'sppedidoMakeModelJsonMatriz.php';
			} else if (tabela1 === "SITE") {
				var url_url = 'sppedidoMakeModelJsonSite.php';
			} else {
				var url_url = 'sppedidoMakeModelJsonLoja.php';
			}

			$.ajax({
					url: url_url,
					type: 'post',
					data: {}
				})
				.done(function(data) {
					if (data == "1") {
						$('#desc-atualiza').html(
							"<b style='color:green;'>Lista para <?php echo strtolower($tabela) ?> atualizada, aguarde recarregar.</b>"
						);
						console.log(data);
						setTimeout(
							function() {
								$('#desc-atualiza').html("");
							}, 3500);
					} else {
						$('#desc-atualiza').html("<b style='color:red;'>Erro ao atualizar a lista.</b>");
						console.log(data);
						setTimeout(
							function() {
								$('#desc-atualiza').html("");
							}, 1500);
					}
				}).fail(function(jqXHR, textStatus, msg) {
					$('#desc-atualiza').html("<b style='color:red;'>Erro na requisição.</b>");
					setTimeout(
						function() {
							$('#desc-atualiza').html("");
						}, 1500);
				});
			$('#modelo').attr('readonly', 'readonly');

			location.reload();
		}

		document.querySelector('.add-item-btn').addEventListener("click", (e) => {
			// 	// e.preventDefault()
			// 	// console.log('Botão clicado')
			document.querySelectorAll('.input-qtde').forEach(element => {
				// element.addEventListener("change", () => {
				const multiplos = {
					'CTB': 10,
					'CTL': 10,
					'CAL': 10
				}


				const modelo_selecionado = String(document.querySelector("#modelo").value).split("-")[0]

				const multiplo = multiplos[`${modelo_selecionado}`]


				if (Number(element.value) % Number(multiplo) != 0) {
					console.log(`esse produto contém multiplo de ${multiplo}`)
				}


				console.log(modelo_selecionado, Number(multiplos[`${modelo_selecionado}`]), Number(element.value), Number(element.value) % Number(multiplo))



				// })
			});
		})



		function getTotValue() {}


		// $('#sppedido').on('submit', function() {
		// 	console.log('Formulário enviado');
		// 	$('input[type="submit"]').removeClass("ui-controlgroup-item");		
		// 	$.blockUI({
		// 		theme: true,
		// 		title: 'Alerta',
		// 		message: '<p>Validando operação...</p>',
		// 		timeout: 30000,
		// 		fadeIn: 200,
		// 		fadeOut: 200
		// 	});
		// });
	</script>
</body>

</html>