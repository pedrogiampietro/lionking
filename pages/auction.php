<?php if (!defined('INITIALIZED')) exit;

$page = 0;
if (isset($_REQUEST['page'])) {
    $page = (int)$_REQUEST['page'];
}
$rows = 20;
$rowsPerPage = 20;
$found_item = false;
$submit = trim($_POST['submit']);
$pesquisar = (string)$_POST['pesquisar'];
$query = $SQL->prepare('SELECT * FROM `auction_system` WHERE item_name = :item_name LIKE "%' . $pesquisar . '%" ORDER BY `item_name` DESC');
$query->execute(['item_name' => $item_name]);

$valida_item = $query->rowCount();
{
    $player = new Player();
    $player->load($info['player_id']);
    $cost = round($info['value'] / 1000, 2);
    if ($action == "items") {
        if ($pesquisar) {
            $found_item = true;
            $info_item .= '
				<tr>
					<td><center>' . $info['id'] . '</center></td>
					<td><center><img src="/images/all/' . $info['item_id'] . '.gif"/></center></td>
					<td><center>' . $info['item_name'] . '</center></td>
					<td><center><a href="?subtopic=characters&name=' . urlencode($info['name']) . '">' . $info['name'] . '</a></center></td>
					<td><center>' . $info['count'] . '</center></td>
					<td><center>' . $cost . 'k<br><small>' . $info['value'] . 'gp</small></center></td>
					<td><center>!offer buy, ' . $info['id'] . '</center>
				</tr>';
        }
    }

    if ($action == "") {
        $info_item .= '
			<tr>
				<td><center>' . $info['id'] . '</center></td>
				<td><center><img src="/images/all/' . $info['item_id'] . '.gif"/></center></td>
				<td><center>' . $info['item_name'] . '</center></td>
				<td><center><a href="?subtopic=characters&name=' . urlencode($info['name']) . '">' . $info['name'] . '</a></center></td>
				<td><center>' . $info['count'] . '</center></td>
				<td><center>' . $cost . 'k<br><small>' . $info['value'] . 'gp</small></center></td>
				<td><center>!offer buy, ' . $info['id'] . '</center>
			</tr>';
    }
}

$main_content .= '
	<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(layouts/custom/img/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url(layouts/custom/img/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url(layouts/custom/img/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url(layouts/custom/img/content/box-frame-vertical.gif);"></span>
				<div class="Text">Commands</div>
				<span class="CaptionVerticalRight" style="background-image:url(layouts/custom/img/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url(layouts/custom/img/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url(layouts/custom/img/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url(layouts/custom/img/content/box-frame-edge.gif);"></span>
			</div>
		</div>
		<table class="Table5" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div class="InnerTableContainer">
							<table style="width:100%;">
								<tbody>
									<tr>
										<td>
											<div class="TableShadowContainerRightTop">
												<div class="TableShadowRightTop" style="background-image:url(layouts/custom/img/content/table-shadow-rt.gif);"></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url(layouts/custom/img/content/table-shadow-rm.gif);">
												<div class="TableContentContainer">
													<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
														<tbody>
															<tr>
																<td style="float: center;">
																	<center><small><font color="green"> Exemplo para adicionar uma venda.</font></small>
																		<br><b>!offer add, itemName, itemCount, itemPrice </b>
																		<br><small>example: !offer add, plate armor, 1, 500</small>
																		<br><font color="red"><font size="1"></font></font>
																	</center>
																	<br>
																	<br>
																</td>
																</center>
																<!-- <td width="25%"><img src="" style="float: right;"></td>-->
															</tr>
														</tbody>
													</table>
												</div>
											</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="TableShadowContainerRightTop">
                                                <div class="TableShadowRightTop" style="background-image:url(layouts/custom/img/content/table-shadow-rt.gif);"></div>
                                            </div>
                                            <div class="TableContentAndRightShadow" style="background-image:url(layouts/custom/img/content/table-shadow-rm.gif);">
                                                <div class="TableContentContainer">
                                                    <table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
                                                        <tbody>
                                                            <tr>
                                                                <td width="40%" style="background: #1a7b1a;color: white;">
                                                                    <center><i class="fas fa-cart-plus" style="font-size: 36px;float: left;"></i><b>!offer buy, AuctionID</b>
                                                                    <br><small>example: !offer buy, 1943<br>Esse comando compra uma oferta.</small></center>
                                                                </td>
                                                                <td width="40%" style="background: #b52525;color: white;">
                                                                    <center><i style="font-size: 36px;float: left;" class="fas fa-trash-alt"></i><b>!offer remove, AuctionID </b>
                                                                    <br><small>example: !offer remove, 1943<br>Esse comando remove uma oferta.</small></center>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="TableShadowContainer">
                                                <div class="TableBottomShadow" style="background-image:url(layouts/custom/img/content/table-shadow-bm.gif);">
                                                    <div class="TableBottomLeftShadow" style="background-image:url(layouts/custom/img/content/table-shadow-bl.gif);"></div>
                                                    <div class="TableBottomRightShadow" style="background-image:url(layouts/custom/img/content/table-shadow-br.gif);"></div>
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
			</div>
		<br>
		<div style="float: right;">
			<form action="?subtopic=auction&action=items" method="post">
				<input class="inputclass" type="text" name="pesquisar" value="" placeholder="Item Name" required="">
				<input class="inputbotton" type="submit" name="searching" value="Search" onclick="checkSearch();">
			</form>
		</div>
		<br>
	<br>';

$main_content .= '
    <div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(layouts/custom/img/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url(layouts/custom/img/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url(layouts/custom/img/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url(layouts/custom/img/content/box-frame-vertical.gif);"></span>
				<div class="Text"><a href="?subtopic=auction"><font color="white">Trade OFF</font></a>
					<p style="display: inline; float: right; margin: 0 10px 0px 0px;">Filters: <a class="branquim" href="?subtopic=auction">[ ALL Items ]</a></p>
				</div>
				<span class="CaptionVerticalRight" style="background-image:url(layouts/custom/img/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url(layouts/custom/img/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url(layouts/custom/img/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url(layouts/custom/img/content/box-frame-edge.gif);"></span>
			</div>
		</div>
		<table class="Table5" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div class="InnerTableContainer">
							<table style="width:100%;">
								<tbody>
									<tr>
										<td>
											<div class="TableShadowContainerRightTop">
												<div class="TableShadowRightTop" style="background-image:url(layouts/custom/img/content/table-shadow-rt.gif);"></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url(layouts/custom/img/content/table-shadow-rm.gif);">
												<div class="TableContentContainer">';
if (!$info) {
    $main_content .= '
														<table border=0 cellspacing=1 cellpadding=4 width=100%>
															<tr bgcolor="' . $config['site']['vdarkborder'] . '">
																<td class="white"><b>Auctions</b></td>
															</tr>
															<tr bgcolor="' . $config['site']['darkborder'] . '">
																<td>Currently is no one active Auction.</td>
															</tr>
														</table>';
} else {
    $main_content .= '
														<table border=0 cellspacing=1 cellpadding=4 width=100%>								
															<tr bgcolor="' . $config['site']['vdarkborder'] . '">
																<td CLASS=white><b><center>ID</center></b></td>
																<td class="white"><b><center>#</center></b></td>
																<td class="white"><b><center>Item Name</center></b></td>
																<td class="white"><b><center>Player</center></b></td>
																<td class="white"><b><center>Count</center></b></td>
																<td class="white"><b><center>Cost</center></b></td>
																<td class="white"><b><center>Buy</center></b></td>
															</tr>';
    $main_content .= $info_item . '</table>';
}
$main_content .= '
											<br>
									</div>
								</div>
							</tbody>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>';

$main_content .= '<center><div class="text-center"><ul class="pagin">';
$pages = (int)($rows / $rowsPerPage);
for ($i = 0; $i < $pages; $i++) {
    $x = $i + 1;
    $main_content .= '<li' . (($x - 1) == $page ? 'class="active"' : '') . '><a href="?subtopic=auction&list=' . urlencode($list) . '&page=' . ($x - 1) . '" data-original-title="" title="">' . ($x) . '</a></li>';
}
$main_content .= '</ul></div></center></div>';
?>