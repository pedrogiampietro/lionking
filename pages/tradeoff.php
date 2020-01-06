<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Souza
 * Date: 30/11/2019
 * Time: 02:13
 */


$main_content .= "<div class='TableContainer'>";
$main_content .= $make_content_header("Comandos Tradeoff");
$main_content .= $make_table_header("Table5", "center", false);


$main_content .= '

<tr>
    <td>
        <div class="TableShadowContainerRightTop">
            <div class="TableShadowRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rt.gif);"></div>
        </div>
        <div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);">
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
            <div class="TableShadowRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rt.gif);"></div>
        </div>
        <div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);">
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
            <div class="TableBottomShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bm.gif);">
                <div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bl.gif);"></div>
                <div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-br.gif);"></div>
            </div>
        </div>
    </td>
</tr>
';
$main_content .= $make_table_footer();
$main_content .= "</div>";


$t = '
<tr>
    <td>
        <div class="TableShadowContainerRightTop">
            <div class="TableShadowRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rt.gif);"></div>
        </div>
        <div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);">
            <div class="TableContentContainer">
                <table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
                    <tbody>
                        <tr bgcolor="#505050">
                            <td class="white">
                                <b>
                                    <center>ID</center>
                                </b>
                            </td>
                            <td class="white">
                                <b>
                                    <center>#</center>
                                </b>
                            </td>
                            <td class="white">
                                <b>
                                    <center>Item Name</center>
                                </b>
                            </td>
                            <td class="white">
                                <b>
                                    <center>Player</center>
                                </b>
                            </td>
                            <td class="white">
                                <b>
                                    <center>Cost</center>
                                </b>
                            </td>
                            <td class="white">
                                <b>
                                    <center>Buy</center>
                                </b>
                            </td>
                        </tr>       ';

$auction = $SQL->prepare("SELECT auct.item_id, auct.value, auct.id, auct.item_name, p.name FROM auction_system auct inner join players p on auct.player_id = p.id");
$auction->execute([]);
$resolve = $auction->fetchAll();
if(!empty($resolve) && $resolve[0] != ''){
    foreach ($resolve as $key => $itens) {


        $t .= '
                        <tr>
                            <td>
                                <center><span>'.$itens['item_id'].'</span></center>
                            </td>
                            <td>
                                <!--<center><img id="'.$itens['id'].'circle" class="plusMinor" src="./layouts/tibiacom/images/global/content/circle-symbol-plus.gif" alt="plusminor"><span class="itemStroke">4</span><span>--><img class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Stamped Parcel\', \'Click to view this container.\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();" style="cursor: pointer;" onclick="trocaSH(514969)" src="/images/items/'.$itens['item_id'].'.gif"></span></center>
                            </td>
                            <td>
                                <center><b>'.$itens['item_name'].'</b></center>
                                <center><font size="1">Added: Meio dia pras 4</font></center>
                            </td>
                            <td>
                                <center><a href="?subtopic=characters&amp;name='.$itens['name'].'">'.$itens['name'].'</a></center>
                            </td>
                            <td>
                                <center>
                                    <span class="itemStroke">
                                        <small>'.$itens['value'].'</small>
                                    </span>
                                    <a class="equipment">
                                    <span>
                                        <img class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'20 Golden Tokens\', \'<strong>Atributtes: </strong><br>This item ADD 20 Premium Points on Site<br><strong>Amount: </strong>1\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();" style="border:0px;" src="/images/items/2160.gif">
                                    </span>
                                    <br>
                                    </a>
                                </center>
                            </td>
                            <td>
                                <center>!tradeoff buy, '.$itens['id'].'</center>
                            </td>
                        </tr>
                        <!--<tr>
                            <td colspan="7" id="'.$itens['item_id'].'table" style="display: none;">
                                <div style="display: none;" id="514969">
                                    <div style="display:inline-block" class="boxmarket"><span class="itemStroke">100</span><span><img class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Special Coins\', \'<strong>Atributtes: </strong><br>special in-game currency worth 1kk.<br> <strong>Amount: </strong>100\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();" style="border:0px;" src="/images/items/'.$items['item_id'].'.gif"></span></div>
                                    <div style="display:inline-block" class="boxmarket"><span class="itemStroke">100</span><span><img class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Special Coins\', \'<strong>Atributtes: </strong><br>special in-game currency worth 1kk.<br> <strong>Amount: </strong>100\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();" style="border:0px;" src="/images/items/'.$items['item_id'].'.gif"></span></div>
                                    <div style="display:inline-block" class="boxmarket"><span class="itemStroke">100</span><span><img class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Special Coins\', \'<strong>Atributtes: </strong><br>special in-game currency worth 1kk.<br> <strong>Amount: </strong>100\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();" style="border:0px;" src="/images/items/'.$items['item_id'].'.gif"></span></div>
                                    <div style="display:inline-block" class="boxmarket"><span class="itemStroke">60</span><span><img class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Special Coins\', \'<strong>Atributtes: </strong><br>special in-game currency worth 1kk.<br> <strong>Amount: </strong>60\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();" style="border:0px;" src="/images/items/'.$items['item_id'].'.gif"></span></div>
                                </div>
                            </td>
                        </tr>-->';
    }
}else{
    $t .= "<tr><td colspan='6' style='text-align: center'>Opa, não encontramos nenhum item à venda no momento.</td></tr>";
}


$t .= '
                    </tbody>
                </table>
            </div>
        </div>
        <div class="TableShadowContainer">
            <div class="TableBottomShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bm.gif);">
                <div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bl.gif);"></div>
                <div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-br.gif);"></div>
            </div>
        </div>
    </td>
</tr>

';
$main_content .= '<br><br>';
$main_content .= "<div class='TableContainer'>";
$main_content .= $make_content_header("Auction List");
$main_content .= $make_table_header();

$main_content .= $t;

$main_content .= $make_table_footer();
$main_content .= "</div>";