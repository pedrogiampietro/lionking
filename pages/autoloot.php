<?php
if (!defined('INITIALIZED'))
    exit;

//var_dump($list);
$main_content .= $make_double_archs('Autoloot');
$main_content .= '<br/><br/>';
$main_content .= "<div class='TableContainer'>";
$main_content .= $make_content_header("Autoloot Information");
$main_content .= $make_table_header();
$main_content .= '
<tr><td style="text-align: -webkit-center">Autoloot é um sistema que coleta items automaticamente, não sendo necessário abrir o corpo.
De acordo com cada hunt, você personaliza sua lista de loot e não perde mais tempo.
Jogadores FREE account podem colocar items no autoloot, jogadores Premium possuem o mesmo limite.
O sistema funciona em party mas não funciona em bosses.
</td></tr>';
$main_content .= $make_table_footer();
$main_content .= "</div>";
$main_content .= '<br/><br/>';

$main_content .= "<div class='TableContainer'>";
$main_content .= $make_content_header("Autoloot System, Como funciona?");
$main_content .= $make_table_header();
$main_content .= '
<tr><td style="text-align: -webkit-center">

Nosso servidor possui um sistema de autoloot, no qual todo loot que esteja na lista seja ele gold ou platinium que dropa dos Monstros mortos é coletado de forma automática e enviada para sua bp principal, após você clicar no body morto.
Autoloot, Como funciona?
</br>
</br>
Para ativar o sistema basta digitar os seguintes comandos:
</br>
!autoloot add, nome do item - Comando para adicionar o item (lembra que existe um espaço apos a virgula);
</br>
!autoloot remove, nome do item - Comando para remover o item (lembra que existe um espaço apos a virgula);
</br>
!autoloot clear - Comando para limpar sua lista de autoloot;
</br>
!autoloot show - Comando para mostrar sua lista atual de autoloot;
</br>

1. Existe limite para a lista de autoloot?
</br>
Não, tanto para Free e para Premiums, não há limites.
</br>

</td></tr>';
$main_content .= $make_table_footer();
$main_content .= "</div>";
$main_content .= '<br/><br/>';


