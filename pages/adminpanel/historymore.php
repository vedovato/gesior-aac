<?php

/**
 *
 * @package        uam.skeleton
 * @subpackage     controllers
 * @author         Codenome Developpers - Main Developer: Ricardo <http://codenome.com>
 * @copyright      Copyright (c) 2018, Codenome. (http://myara.net/)
 * @license        GPL v3
 * @link           http://uam.codenome.com
 * @since          Version 0.0.1
 * @filesource
 */

$serviceGo = trim($_REQUEST['service']);

if ($serviceGo == "items") {
	$main_content .= '
					<table class="Table5" cellpadding="0" cellspacing="0" width="100%">
						<tbody>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;">
											<tbody>
												<tr>
													<td>
														<div class="TableShadowContainerRightTop">
															<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
															<div class="TableContentContainer">
																<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																	<tbody>
																		<tr>
																			<td><img class="AccountStatusImage" src="' . $layout_name . '/images/account/account-status_green.gif" alt="free account"></td>
																			<td width="100%" valign="middle">';
	$getItemsMonth = $SQL->query("SELECT COUNT(*) FROM `z_shop_payment` WHERE YEAR(FROM_UNIXTIME(date)) = YEAR(CURDATE()) AND MONTH(FROM_UNIXTIME(date)) = MONTH(CURDATE()) AND `status` = 'received'")->fetchColumn();
	$getItemsTotal = $SQL->query("SELECT COUNT(*) FROM `z_shop_payment` WHERE `status` = 'received'")->fetchColumn();

	$main_content .= '
																				<span class="green">
																					<span class="BigBoldText">' . $getItemsMonth . ' purchased items</span>
																				</span>
																				<small>
																					<br>Items purchased in the month of ' . date('F') . '.<br>
																					(Since the last reset they have already been purchased  <span class="green">' . $getItemsTotal . ' items</span>)
																				</small>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<div class="TableShadowContainer">
															<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
															<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
															<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
														</div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<br>';
} elseif ($serviceGo == "pagseguro") {
	$main_content .= '
					<table class="Table5" cellpadding="0" cellspacing="0" width="100%">
						<tbody>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;">
											<tbody>
												<tr>
													<td>
														<div class="TableShadowContainerRightTop">
															<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
															<div class="TableContentContainer">
																<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																	<tbody>
																		<tr>
																			<td><img class="AccountStatusImage" src="' . $layout_name . '/images/account/account-status_green.gif" alt="free account"></td>
																			<td width="100%" valign="middle">';
	function porcentagem_xn($porcentagem, $total)
	{
		return ($porcentagem / 100) * $total;
	}

	$getPag = $SQL->query("SELECT * FROM `pagseguro` WHERE `status` = '3'")->fetchAll();
	foreach ($getPag as $pag) {
		$getPagRef = explode("-", $pag['reference']);
		$getPagBalanceMonth = $SQL->query("SELECT `price` FROM `z_shop_donates` WHERE YEAR(FROM_UNIXTIME(date)) = YEAR(CURDATE()) AND MONTH(FROM_UNIXTIME(date)) = MONTH(CURDATE()) AND `reference` = '" . $getPagRef[0] . "' AND `status` = 'received'")->fetch();
		$getPagBalanceTotal = $SQL->query("SELECT `price` FROM `z_shop_donates` WHERE `reference` = '" . $getPagRef[0] . "' AND `status` = 'received'")->fetch();
		$pagMonth += $getPagBalanceMonth['price'];
		$pagTotal += $getPagBalanceTotal['price'];
	}
	$main_content .= '
																				<span class="green">
																					<span class="BigBoldText">R$ ' . number_format($pagMonth, 2, ',', '.') . '</span>
																				</span>
																				<small>
																					<br>The balance above refers to the total of all donations made in the month of ' . date('F') . '.<br>
																					Donations made since the last reset represent a total of <span class="green">' . number_format($pagTotal, 2, ',', '.') . '</span><br>
																					(' . $config['server']['serverName'] . ' owns 40% of the profits, a total of <span class="green">R$ ' . number_format(porcentagem_xn(40, $pagMonth), 2, ',', '.') . '</span> in the month of ' . date('F') . ' e <span class="green">R$ ' . number_format(porcentagem_xn(40, $pagTotal), 2, ',', '.') . '</span> since the last reset).
																				</small>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<div class="TableShadowContainer">
															<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
															<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
															<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
														</div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<p>The list below shows the last 40 donations made by ' . $serviceGo . '.</p>';
	$main_content .= '
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer"> 
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">Last donations made by ' . $serviceGo . '</div>
							<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
						</div>
					</div>
					<table class="Table3" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td>
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%">
																<tr bgcolor="#D4C0A1">
																	<td class="LabelV">Date</td>
																	<td class="LabelV">Transaction Code</td>
																	<td class="LabelV">Reference/Account Name</td>
																	<td class="LabelV">Value</td>
																	<td class="LabelV">Status</td>
																	
																</tr>';
	$status_pagamento = array(
		1 => "Waiting payment",
		2 => "Under review",
		3 => "Paid",
		4 => "Available",
		5 => "In dispute",
		6 => "Returned",
		7 => "Canceled",
		8 => "Chargeback debited",
		9 => "In contestation"
	);
	$get_Pagseguro = $SQL->query("SELECT * FROM `pagseguro` ORDER BY `date` DESC LIMIT 40")->fetchAll();
	$getCountPagseguro = $SQL->query("SELECT COUNT(*) FROM `pagseguro`")->fetchColumn();
	$n = 0;
	if ($getCountPagseguro > 0)
		foreach ($get_Pagseguro as $pagseguro) {
			$bgcolor = (($n++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
			$refPagseguro = explode("-", $pagseguro['reference']);
			$refPag = $refPagseguro[0];
			$getPriceService = $SQL->query("SELECT `price` FROM ``");
			$main_content .= '
																	<tr bgcolor="' . $bgcolor . '">
																		<td>' . $pagseguro['date'] . '</td>';
			$main_content .= '
																		<td>' . $pagseguro['code'] . '</td>
																		<td>' . $pagseguro['reference'] . '</td>';
			$getReference = explode("-", $pagseguro['reference']);
			$pagseguroReference = $getReference[0];
			$getValor = $SQL->query("SELECT `price` FROM `z_shop_donates` WHERE `reference` = '$pagseguroReference'")->fetch();
			$main_content .= '
																		<td>' . number_format($getValor['price'], 2, ',', '.') . '</td>
																		<td>' . $status_pagamento[$pagseguro['status']] . '</td>';
			$main_content .= '
																	</tr>';
		} else
		$main_content .= '
																<tr bgcolor="' . $config['site']['lightborder'] . '">
																	<td colspan="5">No donations made yet.</td>
																</tr>';
	$main_content .= '
															</table>
														</div>
													</div>
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);" ></div>
														</div>
													</div>
												</td>
											</tr>';
	$main_content .= '
										</table>
									</div>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div><br>';
} else {
	$getMonthBalance = "";
	$getTotalBalance = "";
	if ($serviceGo == "paypal") {
		$getMonthBalance = "SELECT `price` FROM `z_shop_donates` WHERE YEAR(FROM_UNIXTIME(date)) = YEAR(CURDATE()) AND MONTH(FROM_UNIXTIME(date)) = MONTH(CURDATE()) AND `status` = 'received' AND `method` = 'paypal'";
		$getTotalBalance = "SELECT `price` FROM `z_shop_donates` WHERE `status` = 'received' AND `method` = 'paypal'";
		$method = "paypal";
	} elseif ($serviceGo == "transfer") {
		$getMonthBalance = "SELECT `price` FROM `z_shop_donates` WHERE YEAR(FROM_UNIXTIME(date)) = YEAR(CURDATE()) AND MONTH(FROM_UNIXTIME(date)) = MONTH(CURDATE()) AND `status` = 'received' AND `method` = 'banktransfer'";
		$getTotalBalance = "SELECT `price` FROM `z_shop_donates` WHERE `status` = 'received' AND `method` = 'banktransfer'";
		$method = "banktransfer";
	}
	$main_content .= '
					<table class="Table5" cellpadding="0" cellspacing="0" width="100%">
						<tbody>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;">
											<tbody>
												<tr>
													<td>
														<div class="TableShadowContainerRightTop">
															<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
															<div class="TableContentContainer">
																<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																	<tbody>
																		<tr>
																			<td><img class="AccountStatusImage" src="' . $layout_name . '/images/account/account-status_green.gif" alt="free account"></td>
																			<td width="100%" valign="middle">';
	function porcentagem_xn($porcentagem, $total)
	{
		return ($porcentagem / 100) * $total;
	}

	/*
	$getM = $SQL->query($getMonthBalance)->fetchAll();
	$getT = $SQL->query($getTotalBalance)->fetchAll();
	foreach ($getM as $monthBalance) {
		$balancoMensal += $monthBalance['price'];
	}
	foreach ($getT as $totalBalance) {
		$balancoTotal += $totalBalance['price'];
	}
	*/

	if ($serviceGo == "picpay") {
		$getMonthBalance = "SELECT `price` FROM `z_shop_donates` WHERE YEAR(FROM_UNIXTIME(date)) = YEAR(CURDATE()) AND MONTH(FROM_UNIXTIME(date)) = MONTH(CURDATE()) AND `status` = 'received' AND `method` = 'picpay'";
		$getTotalBalance = "SELECT `price` FROM `z_shop_donates` WHERE `status` = 'received' AND `method` = 'picpay'";
		$method = "picpay";
	} elseif ($serviceGo == "mercadopago") {
		$getMonthBalance = "SELECT `price` FROM `z_shop_donates` WHERE YEAR(FROM_UNIXTIME(date)) = YEAR(CURDATE()) AND MONTH(FROM_UNIXTIME(date)) = MONTH(CURDATE()) AND `status` = 'received' AND `method` = 'mercadopago'";
		$getTotalBalance = "SELECT `price` FROM `z_shop_donates` WHERE `status` = 'received' AND `method` = 'mercadopago'";
		$method = "mercadopago";
	}
	$main_content .= '
																				<span class="green">
																					<span class="BigBoldText">R$ ' . number_format($balancoMensal, 2, ',', '.') . '</span>
																				</span>
																				<small>
																					<br>The balance above refers to the total of all donations made in the month of ' . date('F') . '.<br>
																					Donations made since the last reset represent a total of <span class="green">' . number_format($balancoTotal, 2, ',', '.') . '</span><br>
																					(' . $config['server']['serverName'] . ' owns 40% of the profits, a total of <span class="green">R$ ' . number_format(porcentagem_xn(40, $balancoMensal), 2, ',', '.') . '</span> in the month of ' . date('F') . ' e <span class="green">R$ ' . number_format(porcentagem_xn(40, $balancoTotal), 2, ',', '.') . '</span> since the last reset).
																				</small>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<div class="TableShadowContainer">
															<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
															<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
															<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
														</div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<br>';
	$main_content .= '
				<a name="Paypal" ></a>
				<div class="TopButtonContainer" >
					<div class="TopButton" >
						<a href="#top" >
							<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
						</a>
					</div>
				</div>
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer"> 
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">Last donations made by ' . $serviceGo . '</div>
							<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
						</div>
					</div>
					<table class="Table3" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td>
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%">
																<tr bgcolor="#D4C0A1">
																	<td class="LabelV">Date</td>
																	<td class="LabelV">Reference</td>
																	<td class="LabelV">Account Name</td>
																	<td class="LabelV">Value</td>
																	<td class="LabelV">Status</td>
																</tr>';
	$get_Mov = $SQL->query("SELECT * FROM `z_shop_donates` WHERE `method` = '$method' ORDER BY `date` DESC LIMIT 40")->fetchAll();
	$get_MovCount = $SQL->query("SELECT COUNT(*) FROM `z_shop_donates` WHERE `method` = '$method'")->fetchColumn();
	$n = 0;
	if ($get_MovCount > 0)
		foreach ($get_Mov as $mov) {
			$bgcolor = (($n++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
			$main_content .= '
																	<tr bgcolor="' . $bgcolor . '">
																		<td>' . date("M d Y, G:i:s", $mov['date']) . '</td>';
			$main_content .= '
																		<td>' . $mov['reference'] . '</td>
																		<td>' . $mov['account_name'] . '</td>
																		<td>' . number_format($mov['price'], 2, ',', '.') . '</td>
																		<td>' . $mov['status'] . '</td>';
			$main_content .= '
																	</tr>';
		} else
		$main_content .= '
																<tr bgcolor="' . $config['site']['lightborder'] . '">
																	<td colspan="5">No donations made yet.</td>
																</tr>';
	$main_content .= '
															</table>
														</div>
													</div>
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);" ></div>
														</div>
													</div>
												</td>
											</tr>';
	$main_content .= '
										</table>
									</div>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div><br>';
}

$main_content .= '
				<center>
					<form method="post" action="?subtopic=adminpanel&action=history">
						<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
							<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
								<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
							</div>
						</div>
					</form>
				</center>';
