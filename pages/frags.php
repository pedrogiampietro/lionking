<?php

$main_content .= '
<div class="TableContainer">
    <div class="CaptionContainer">
        <div class="CaptionInnerContainer">
            <span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/custom/img/content/box-frame-edge.gif);"></span>
            <span class="CaptionEdgeRightTop" style="background-image:url(./layouts/custom/img/content/box-frame-edge.gif);"></span>
            <span class="CaptionBorderTop" style="background-image:url(./layouts/custom/img/content/table-headline-border.gif);"></span>
            <span class="CaptionVerticalLeft" style="background-image:url(./layouts/custom/img/content/box-frame-vertical.gif);"></span>
            <div class="Text">The 3 best killers on '.htmlspecialchars($config['server_name']).'</div>
            <span class="CaptionVerticalRight" style="background-image:url(./layouts/custom/img/content/box-frame-vertical.gif);"></span>
            <span class="CaptionBorderBottom" style="background-image:url(./layouts/custom/img/content/table-headline-border.gif);"></span>
            <span class="CaptionEdgeLeftBottom" style="background-image:url(./layouts/custom/img/content/box-frame-edge.gif);"></span>
            <span class="CaptionEdgeRightBottom" style="background-image:url(./layouts/custom/img/content/box-frame-edge.gif);"></span>
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
                                                            <div class="TableShadowRightTop" style="background-image:url(./layouts/custom/img/content/table-shadow-rt.gif);"></div>
                                                        </div>
                                                    <div class="TableContentAndRightShadow" style="background-image:url(./layouts/custom/img/content/table-shadow-rm.gif);">
                                                    <div class="TableContentContainer">
                                                        <table bgcolor="#D4C0A1" border="0" cellpadding="3" cellspacing="1" width="100%"> 
                                                        <tr bgcolor="#505050"></tr>                                    
                                                        <tr>
                                                            <td>
                                                                <table border="0" cellpadding="4" cellspacing="1" width="100%">
                                                                    <tr bgcolor="#505050">
                                                                        <td align="center" class="white" colspan="3"><b>Ranking</b>
                                                                        </td>
                                                                    </tr>
                                                                <tbody>
                                                                    <tr bgcolor="#F1E0C6">
';


$rankingFrags = $SQL->query('SELECT '.$SQL->fieldName('killed_by').' as `name`, COUNT(`killed_by`) AS `frags` FROM '.$SQL->tableName('player_deaths').' 
		WHERE '.$SQL->fieldName('is_player').' = 1 GROUP BY '.$SQL->fieldName('killed_by').' ORDER BY COUNT(`killed_by`) DESC LIMIT 0, 3;');

$rm = 1;

foreach ($rankingFrags as $member) {


    $main_content .= '
        <td align="center">
            <img style="margin-top: -40px; margin-left: -50px; position: relative;" src="images/trofeus/'.$rm.'.png" width="50" height="50" />
            <img  style="margin-top: -45px; margin-left: -40px;" src="http://158.69.62.73/outfits/animoutfit.php?id='.$member['looktype'].'&addons='.$member['lookaddons'].'&head='.$member['lookhead'].'&body='.$member['lookbody'].'&legs='.$member['looklegs'].'&feet='.$member['lookfeet'].'" width="80" height="80" />
            <br>
            <a href="?subtopic=jogador&nome='.$member['name'].'"> '.$member['name'].'</a>
            <br>
            <b>'.$member['frags_all'].'</b>
        </td>
    ';

    $rm++;
}

$main_content .= '
        </td>
            </tr>
                </table></tr></tbody>
                        </table>
                            <br/>
                                </div>
                                    </div>
                                        <div class="TableShadowContainer">
                                            <div class="TableBottomShadow" style="background-image:url(./layouts/custom/img/content/table-shadow-bm.gif);">
                                            <div class="TableBottomLeftShadow" style="background-image:url(./layouts/custom/img/content/table-shadow-bl.gif);"></div>
                                            <div class="TableBottomRightShadow" style="background-image:url(./layouts/custom/img/content/table-shadow-br.gif);"></div>
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
<br />
';

$main_content .= '

<div class="TableContainer">
    <div class="CaptionContainer">
        <div class="CaptionInnerContainer">
            <span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/custom/img/content/box-frame-edge.gif);"></span>
            <span class="CaptionEdgeRightTop" style="background-image:url(./layouts/custom/img/content/box-frame-edge.gif);"></span>
            <span class="CaptionBorderTop" style="background-image:url(./layouts/custom/img/content/table-headline-border.gif);"></span>
            <span class="CaptionVerticalLeft" style="background-image:url(./layouts/custom/img/content/box-frame-vertical.gif);"></span>
            <div class="Text">TOP Frags on '.htmlspecialchars($config['server_name']).'</div>
            <span class="CaptionVerticalRight" style="background-image:url(./layouts/custom/img/content/box-frame-vertical.gif);"></span>
            <span class="CaptionBorderBottom" style="background-image:url(./layouts/custom/img/content/table-headline-border.gif);"></span>
            <span class="CaptionEdgeLeftBottom" style="background-image:url(./layouts/custom/img/content/box-frame-edge.gif);"></span>
            <span class="CaptionEdgeRightBottom" style="background-image:url(./layouts/custom/img/content/box-frame-edge.gif);"></span>
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
                                                            <div class="TableShadowRightTop" style="background-image:url(./layouts/custom/img/content/table-shadow-rt.gif);"></div>
                                                        </div>
                                                    <div class="TableContentAndRightShadow" style="background-image:url(./layouts/custom/img/content/table-shadow-rm.gif);">
                                                    <div class="TableContentContainer">
<table border="0" cellspacing="1" cellpadding="4" width="100%">
    <tr bgcolor="#505050">
        <td class="white" style="text-align: center; font-weight: bold;">Name</td>
        <td class="white" style="text-align: center; font-weight: bold;">Frags</td>
    </tr>';

$topFrags = $SQL->query('SELECT '.$SQL->fieldName('killed_by').' as `name`, COUNT(`killed_by`) AS `frags` FROM '.$SQL->tableName('player_deaths').' 
		WHERE '.$SQL->fieldName('is_player').' = 1 GROUP BY '.$SQL->fieldName('killed_by').' ORDER BY COUNT(`killed_by`) DESC LIMIT 0, 30;');

$bgcount = 0;

foreach ($topFrags as $member) {   
    $bgcount++;

    if(is_int($bgcount / 2)):
        $bgcolor = $config['site']['darkborder'];
    else:
        $bgcolor = $config['site']['lightborder'];
    endif;

    $main_content .= '<tr bgcolor="'.$bgcolor.'">
        <td><a href="?subtopic=characters&name='.$member['name'].'">'.$member['name'].'</a></td>
        <td style="text-align: center;">'.$member['frags_all'].'</td>
    </tr>';
};


$main_content .= '          </table>
                                </div>
                                    </div>
                                        <div class="TableShadowContainer">
                                            <div class="TableBottomShadow" style="background-image:url(./layouts/custom/img/content/table-shadow-bm.gif);">
                                            <div class="TableBottomLeftShadow" style="background-image:url(./layouts/custom/img/content/table-shadow-bl.gif);"></div>
                                            <div class="TableBottomRightShadow" style="background-image:url(./layouts/custom/img/content/table-shadow-br.gif);"></div>
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

';


?>