<?php
if (!defined('INITIALIZED'))
    exit;

$name = '';
if (isset($_REQUEST['name']))
    $name = (string)$_REQUEST['name'];
$name = strip_tags($name);

if (!empty($name)) {
    $player = new Player();
    $player->find($name);
    if ($player->isLoaded()) {
        $rows_number = 0;
        $account = $player->getAccount();

        $main_content .= '<div class="TableContainer" >';
        $fb_link = '<div class="fb-share-button" data-href="' . Website::getWebsiteConfig()->getValue('base_url') . '/?subtopic=characters&name=' . urlencode($name) . '" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' . Website::getWebsiteConfig()->getValue('base_url') . '/?subtopic=characters&name=' . urlencode($name) . '&src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartilhar</a></div>';
        $main_content .= '<div class="community-up-section">
        <div class="community-up-text">
                Characters
            </div>
        </div>';
        $main_content .= $make_table_header('Table3', '', TRUE);
        $insell = $SQL->query("SELECT * FROM account_character_sale WHERE id_player = {$player->getID()}")->rowCount();
        $main_content .= '
        <tr>
            <td width=20%>Name:</td>
            <td>' . htmlspecialchars($player->getName()) . (($player->isDeleted()) ? ', will be deleted at ' . date("M j Y, H:i:s", $player->getDeletion()) : '') . '  ' . ($insell > 0 ? "<a href='./?subtopic=accountmanagement&action=buychar&id={$player->getID()}'>[Personagem à venda]</a>" : "") . ' </td>
        </tr>';
        $player_id = $player->getID();
        $former_sql = "SELECT * FROM `player_former_names` WHERE `player_id` = '$player_id' ORDER BY `date` DESC LIMIT " . $config['site']['formerNames_amount'];
        $get_names_count = $SQL->query($former_sql)->fetchAll();
        $get_names_count2 = $SQL->query($former_sql)->fetch();
        if ($SQL->query($former_sql)->fetchColumn() > 0 && $get_names_count2['date'] >= time()) {
            $main_content .= '
				<tr>
					<td width=20%>Former Names:</td>
					<td>';
            $f_names = "";
            foreach ($get_names_count as $fomer_name) {
                $f_names .= $fomer_name['former_name'] . ', ';
            }
            $f_names = substr($f_names, 0, -2);
            $main_content .= $f_names;
            $main_content .= '
					</td>
				<tr>';
        }
        if (in_array($player->getGroup(), $config['site']['groups_support'])) {
            $main_content .= '
				<tr>
					<td>Group:</td>
					<td>' . htmlspecialchars(Website::getGroupName($player->getGroup())) . '</td>
				</tr>';
        }
        $main_content .= '
				<tr>
					<td>Sex:</td>
					<td>' . htmlspecialchars((($player->getSex() == 0) ? 'Female' : 'Male')) . '</td>
				</tr>';

        $main_content .= '
				<tr >
					<td>Vocation:</td>
					<td>' . htmlspecialchars(Website::getVocationName($player->getVocation())) . '</td>
				</tr>';

        $main_content .= '
				<tr >
					<td>Level:</td>
					<td>' . htmlspecialchars($player->getLevel()) . '</td>
				</tr>';

        $main_content .= '
				<tr >
					<td>World:</td>
					<td>' . htmlspecialchars($config['server']['serverName']) . '</td>
				</tr>';

        $main_content .= '
				<tr >
					<td>Residence:</td>
					<td>' . htmlspecialchars($towns_list[$player->getTownID()]) . '</td>
				</tr>';
        if ($player->getMarriageStatus() > 0) {
            $player_married = new Player();
            $player_married->loadById($player->getMarriage());

            $main_content .= '
					<tr >
						<td>Married to:</td>
						<td><a href="?subtopic=characters&name=' . urlencode($player_married->getName()) . '">' . htmlspecialchars($player_married->getName()) . '</a></td>
					</tr>';
        }

        $house = $SQL->query("SELECT * FROM `houses` WHERE `owner` = '" . $player->getID() . "'")->fetch();
        if (!empty($house[0])) {

            $main_content .= '<TR ><TD>House:</TD><TD>';
            $main_content .= $house['name'] . ' (' . $towns_list[$house['town_id']] . ')' . '</TD></TR>';
        }

        $rank_of_player = $player->getRank();
        if (!empty($rank_of_player)) {
            $main_content .= '
					<tr >
						<td>Guild Membership:</td>
						<td>' . htmlspecialchars($rank_of_player->getName()) . ' of the <a href="?subtopic=guilds&action=view&GuildName=' . urlencode($rank_of_player->getGuild()->getName()) . '">' . htmlspecialchars($rank_of_player->getGuild()->getName()) . '</a>
						</td>
                    </tr>';
        }

        $main_content .= '
				<tr >
					<td>Last login:</td>
					<td>' . (($player->getLastLogin() > 0) ? date("j F Y, g:i a", $player->getLastLogin()) : 'Never logged in.') . '</td>
				</tr>';

        $comment = $player->getComment();
        $newlines = array("\r\n", "\n", "\r");
        $comment_with_lines = str_replace($newlines, '<br />', $comment, $count);
        if ($count < 50)
            $comment = $comment_with_lines;
        if (!empty($comment)) {
            $main_content .= '
					<tr >
						<td>Comment:</td>
						<td>' . $comment . '</td>
					</tr>';
        }

        if ($account->getPremDays() > 0) {
            $main_content .= '
					<tr >
						<td>Account Status:</td>
						<td>Premium Account</td>
					</tr>';
        } else if ($config['server']['freePremium'] == "yes") {
            $main_content .= '
					<tr >
						<td>Account Status:</td>
						<td>Premium Account</td>
					</tr>';
        } else {
            $main_content .= '
					<tr >
						<td>Account Status:</td>
						<td>Free Account</td>
					</tr>';
        }
        $main_content .= '</tr>';
        $main_content .= $make_table_footer();
        $main_content .= '</div></br>';

        //Plus Account Information
        include_once "system/load.newclasses.php";
        $verifica_item_id = function ($pid) use ($player) {
            $kalabok = (array_keys($player->getItems()->getItem($pid)) === [] ? '' : array_keys($player->getItems()->getItem($pid))[0]);


            $hidden = $player->isItemHidden();
            if($hidden){
                return '<td style="background-color: #291b1c; text-align: center;"><img src="./layouts/yinz/assets/img/items/hidden.png" class="CharItems"></td>';
            }
            if ($player->getItems()->getItem($pid)[$kalabok]->data['itemtype'] == NULL) {
                return '<td style="background-color: #291b1c; text-align: center;"><img src="/layouts/yinz/assets/img/items/' . $pid . '.gif" class="CharItems"></td>';
            } else {
                $item_id = $player->getItems()->getItem($pid)[$kalabok]->data['itemtype'];
                return '<td align="center" style="background-color: #291b1c;"><img src="/layouts/yinz/assets/img/items/' . $item_id . '.png" class="CharItems"></td>';
            }
        };
        $player_info = $player->data;
        $mount_id = $player->getStorage('10002011');
        $cur_outfit = "<img style='text-decoration:none;margin: 0 0 0 -13px;' class='outfitImgsell2' src='http://outfits.ferobraglobal.com/animoutfit.php?id={$player_info['looktype']}&addons={$player_info['lookaddons']}&head={$player_info['lookhead']}&body={$player_info['lookbody']}&legs={$player_info['looklegs']}&feet={$player_info['lookfeet']}&mount=" . ($mount_id == NULL ? 0 : $mount_id) . "' alt='' name=''>";

        $cur_exp = $player->getExperience();
        $cur_lvl_exp = $player->getExpForLevel($player->getLevel());
        $cur_real_exp = $cur_exp - $cur_lvl_exp;
        $next_lvl_exp = $player->getExpForLevel($player->getLevel() + 1);
        $next_lvl_exp_need = $next_lvl_exp - $cur_lvl_exp;

        $next_lvl_percent = (float)round(((($cur_real_exp / $next_lvl_exp_need) * 100)), 2, PHP_ROUND_HALF_DOWN);
        $next_lvl_percent = ($next_lvl_percent == 100 ? 99.99 : $next_lvl_percent);

        $plus_content = '<div class="account_plus_information">';
        $plus_content .= '

        <div class="container">
        <h2>Additional Information</h2>

        <ul class="nav nav-pills">
          <li class="active"><a data-toggle="pill" href="#home">Equipment/Skills</a></li>
          <li><a data-toggle="pill" href="#menu1">Quests</a></li>
          <li><a data-toggle="pill" href="#menu2">Achievements</a></li>
          <li><a data-toggle="pill" href="#menu3">Deaths</a></li>
        </ul>
        
        <div class="tab-content">
          <div id="home" class="tab-pane active">';
  $plus_content .= '
      <div id="TransferConditionsContainer">
          <br/>
          <table width="100%" style="padding: 5px 10px;">
              <tbody>
                  <tr style="background-image: url(./layouts/tibiacom/images/global/content/scroll.gif)!important;">
                      <td style="padding-right: 5px;">
                          <table width="100%" class="Table30">
                              <tbody>
                                  <tr bgcolor="#291b1c">
                                      <td align="center" width="100px"><b>Current<br>outfit:</b></td>
                                      <td>' . $cur_outfit . '</td>
                                  </tr>
                              </tbody>
                          </table>
                          <table class="Table30" width="100%" style="border-spacing: 2px; padding: 0px;">
                              <tbody>
                                  <tr>
                                      <td colspan="3" style="background-color: #291b1c; text-align: center;">
                                          <b>Inventory:</b>
                                      </td>
                                  </tr>
                                  <tr>';

  $plus_content .= $verifica_item_id(2);
  $plus_content .= $verifica_item_id(1);
  $plus_content .= $verifica_item_id(3);
  $plus_content .= '</tr><tr>';
  $plus_content .= $verifica_item_id(6);
  $plus_content .= $verifica_item_id(4);
  $plus_content .= $verifica_item_id(5);
  $plus_content .= '</tr><tr>';
  $plus_content .= $verifica_item_id(9);
  $plus_content .= $verifica_item_id(7);
  $plus_content .= $verifica_item_id(10);
  $plus_content .= '</tr><tr>';
  $plus_content .= '               <td style="background-color: #291b1c; text-align: center;">
                                          <b>Soul:</b><br>' . $player->getSoul() . '
                                      </td>';
  $plus_content .= $verifica_item_id(8);
  $plus_content .= '
                                      <td style="background-color: #291b1c; text-align: center;">
                                          <b>Cap:</b><br>' . $player->getCapacity() . '
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </td>
                      <td>
                          <table width="100%" class="Table30">
                              <tbody>
                                  <tr bgcolor="#291b1c" style="text-align: center">
                                      <td width="80px"><b>Health:</b></td>
                                      <td>
                                          ' . $player->getHealth() . '/' . $player->getHealthMax() . '(' . (round(($player->getHealth() / $player->getHealthMax()), 2, PHP_ROUND_HALF_UP) * 100) . '%)
                                          <div class="progress">
                                              <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="' . (round(($player->getHealth() / $player->getHealthMax()), 2, PHP_ROUND_HALF_UP) * 100) . '" aria-valuemin="0" aria-valuemax="100" style=" width:' . (($player->getHealth() / $player->getHealthMax()) * 100) . '%;" ></div>
                                          </div>
                                      </td>
                                  </tr>
                                  <tr bgcolor="#291b1c" style="text-align: center">
                                      <td><b>Mana:</b></td>
                                      <td>
                                          ' . $player->getMana() . '/' . $player->getManaMax() . ' (' . (round(($player->getMana() / $player->getManaMax()), 2, PHP_ROUND_HALF_UP) * 100) . '%)
                                          <div class="progress">
                                              <div class="progress-bar bg-default" role="progressbar" aria-valuenow="' . (round(($player->getMana() / $player->getManaMax()), 2, PHP_ROUND_HALF_UP) * 100) . '" aria-valuemin="0" aria-valuemax="100" style="width:' . (($player->getMana() / $player->getManaMax()) * 100) . '%"></div>
                                          </div>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                          <table width="100%" class="Table30">
                              <tbody>
                                  <tr bgcolor="#291b1c">
                                      <td width="80px"><b>Exp:</b></td>
                                      <td>Have <b>' . $player->getExperience() . '</b> and need <b>' . ($player->getExpForLevel($player->getLevel() + 1) - $player->getExperience()) . '</b> to Level <b>' . ($player->getLevel() + 1) . '</b>.</td>
                                  </tr>
                                  <tr bgcolor="#291b1c">
                                      <td><b>Percent:</b></td>
                                      <td style="text-align: center">
                                          ' . $next_lvl_percent . '%
                                          <div class="progress">
                                              <div class="progress-bar bg-success" role="progressbar" aria-valuenow="' . $next_lvl_percent . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $next_lvl_percent . '%"></div>
                                          </div>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                          <table width="100%" class="Table30">
                              <tbody>
                                  <tr>
                                      <td style="text-align: center;"><a href="?subtopic=highscores&list=5"><img class="SkillIcon" src="images/skills/level.gif" alt="" style="border-style: none"></a></td>
                                      <td style="text-align: center;"><a href="?subtopic=highscores&list=9"><img class="SkillIcon" src="images/skills/ml.gif" alt="" style="border-style: none"></a></td>
                                      <td style="text-align: center;"><a href="?subtopic=highscores&list=7"><img class="SkillIcon" src="images/skills/fist.gif" alt="" style="border-style: none"></a></td>
                                      <td style="text-align: center;"><a href="?subtopic=highscores&list=3"><img class="SkillIcon" src="images/skills/club.gif" alt="" style="border-style: none"></a></td>
                                      <td style="text-align: center;"><a href="?subtopic=highscores&list=11"><img class="SkillIcon" src="images/skills/sword.gif" alt="" style="border-style: none"></a></td>
                                      <td style="text-align: center;"><a href="?subtopic=highscores&list=2"><img class="SkillIcon" src="images/skills/axe.gif" alt="" style="border-style: none"></a></td>
                                      <td style="text-align: center;"><a href="?subtopic=highscores&list=4"><img class="SkillIcon" src="images/skills/dist.gif" alt="" style="border-style: none"></a></td>
                                      <td style="text-align: center;"><a href="?subtopic=highscores&list=10"><img class="SkillIcon" src="images/skills/def.gif" alt="" style="border-style: none"></a></td>
                                      <td style="text-align: center;"><a href="?subtopic=highscores&list=6"><img class="SkillIcon" src="images/skills/fish.gif" alt="" style="border-style: none"></a></td>
                                  </tr>
                                  <tr bgcolor="#291b1c">
                                      <td style="text-align: center;"><strong>Level</strong></td>
                                      <td style="text-align: center;"><strong>ML</strong></td>
                                      <td style="text-align: center;"><strong>Fist</strong></td>
                                      <td style="text-align: center;"><strong>Mace</strong></td>
                                      <td style="text-align: center;"><strong>Sword</strong></td>
                                      <td style="text-align: center;"><strong>Axe</strong></td>
                                      <td style="text-align: center;"><strong>Dist</strong></td>
                                      <td style="text-align: center;"><strong>Def</strong></td>
                                      <td style="text-align: center;"><strong>Fish</strong></td>
                                  </tr>
                                  <tr bgcolor="#291b1c">
                                      <td style="text-align: center;">' . $player->getLevel() . '</td>
                                      <td style="text-align: center;">' . $player->getMagLevel() . '</td>
                                      <td style="text-align: center;">' . $player->getSkill(0) . '</td>
                                      <td style="text-align: center;">' . $player->getSkill(1) . '</td>
                                      <td style="text-align: center;">' . $player->getSkill(2) . '</td>
                                      <td style="text-align: center;">' . $player->getSkill(3) . '</td>
                                      <td style="text-align: center;">' . $player->getSkill(4) . '</td>
                                      <td style="text-align: center;">' . $player->getSkill(5) . '</td>
                                      <td style="text-align: center;">' . $player->getSkill(6) . '</td>
                                  </tr>
                              </tbody>
                          </table>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
         </div>

          <div id="menu1" class="tab-pane fade">
            <h3>Menu 1</h3>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>

          <div id="menu2" class="tab-pane fade">
            <h3>Menu 2</h3>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
          </div>

          <div id="menu3" class="tab-pane fade">
            <h3>Menu 3</h3>
            <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
          </div>

        </div>
      </div>';


           
        $plus_content .= '</div><br/>';

        $main_content .= $plus_content;

        //quest list
        if (isset($config['site']['quests']) && is_array($config['site']['quests']) && count($config['site']['quests']) > 0) {
            $main_content .= '<div class="TableContainer" >';
            $main_content .= $make_content_header("Quests");
            $main_content .= $make_table_header('Table3', '', TRUE);
            $number_of_quests = 0;
            foreach ($config['site']['quests'] as $questName => $storageID) {
                $bgcolor = (($number_of_rows++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
                $number_of_quests++;
                $main_content .= '<TR ><TD WIDTH=95%>' . $questName . '</TD>';
                if ($player->getStorage($storageID) === NULL) {
                    $main_content .= '<TD><img src="images/false.png"/></TD></TR>';
                } else {
                    $main_content .= '<TD><img src="images/true.png"/></TD></TR>';
                }
            }
            //$main_content .= '</TABLE></td></tr></table><br/>';
            $main_content .= $make_table_footer();
            $main_content .= '</div><br>';
        }
        //#endquestlist

        //deaths list
        $player_deaths = new DatabaseList('PlayerDeath');
        $player_deaths->setFilter(new SQL_Filter(new SQL_Filter(new SQL_Field('player_id'), SQL_Filter::EQUAL, $player->getId()), SQL_Filter::CRITERIUM_AND, new SQL_Filter(new SQL_Field('id', 'players'), SQL_Filter::EQUAL, new SQL_Field('player_id', 'player_deaths'))));
        $player_deaths->addOrder(new SQL_Order(new SQL_Field('time'), SQL_Order::DESC));
        $player_deaths->setLimit(5);

        foreach ($player_deaths as $death) {
            $bgcolor = (($number_of_rows++ % 2 != 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
            $deads++;
            $dead_add_content .= '<tr ><td width="20%" align="center">' . date("j/m/Y H:i", $death->getTime()) . '</td><td>Died at level ' . $death->getLevel() . ' by ' . $death->getKillerString() . '.';
            if ($death->getMostDamageString() != '' && $death->getKillerString() != $death->getMostDamageString())
                $dead_add_content .= ' and ' . $death->getMostDamageString();
            $dead_add_content .= "</td></tr>";
        }
        if ($deads > 0) {
            $main_content .= "<div class='TableContainer'>";
            $main_content .= $make_content_header("Character Last Deaths");
            $main_content .= $make_table_header('Table3', '', TRUE);
            $main_content .= $dead_add_content;
            $main_content .= $make_table_footer();
            $main_content .= "</div><br/>";
            //$main_content .= '<table border="0" cellspacing="1" cellpadding="4" width="100%"><tr bgcolor="'.$config['site']['vdarkborder'].'"><td colspan="2" class="white" ><b>Character Deaths</b></td></tr>' . $dead_add_content . '</table><br />';
        }

        if ($insell == 0) {
            if (!$player->isHidden()) {

                $main_content .= "<div class='TableContainer'>";
                $main_content .= '
                <div class="community-up-section">
                     <div class="community-up-text">
                         Account Information
                     </div>
                </div>';
                $main_content .= $make_table_header('Table3', '', TRUE);
                //$main_content.='<TR><TD>No one died on '.htmlspecialchars($config['server']['serverName']).'.</TD></TR>';
                //$main_content .= '<table border="0" cellspacing="1" cellpadding="4" width="100%" ><tr bgcolor="#505050"><td colspan="2" class="white" ><b>Account Information</b></td></tr>';
                if ($account->getLoyalty() >= 50) {
                    $accountTitle = ''; // none
                    foreach ($loyalty_title as $loypoints => $loytitle) {
                        if ($account->getLoyalty() >= $loypoints) {
                            # player rank
                            $accountTitle = $loytitle;
                        }
                    }

                    $bgcolor = (($number_of_rows++ % 2 != 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
                    $main_content .= '<tr  ><td width="20%">Loyalty Title:</td><td>' . $accountTitle . ' of ' . $config['server']['serverName'] . '</td></tr>';
                }
                $bgcolor = (($number_of_rows++ % 2 != 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
                $main_content .= '<tr  ><td>Created:</td><td>' . date("j F Y, g:i a", $account->getCreateDate()) . '</td></tr>';
                if ($account->isBanned() > 0) {
                    $bgcolor = (($number_of_rows++ % 2 != 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
                    $main_content .= '<tr  ><td style="color:red;">Banished:</td><td style="color:red;">' . date("j F Y, g:i a", strtotime($account->getBanTime())) . '</td></tr>';
                }
                //$main_content .= '</table><br />';
                $main_content .= $make_table_footer();
                $main_content .= "</div><br/>";
            }
        }
        if ($insell == 0) {
            if (!$player->isHidden()) {

                $main_content .= "<div class='TableContainer'>";
                $main_content .= '
                <div class="community-up-section">
                     <div class="community-up-text">
                         Characters
                     </div>
                </div>';
                $main_content .= $make_table_header('Table3', '', TRUE);
                //$main_content .= '<table border="0" cellspacing="1" cellpadding="4" width="100%" ><tr bgcolor="#505050"><td colspan="5" class="white"><b>Characters</b></td></tr>';
                $main_content .= '<tr><td><strong>Name</strong></td><td><strong>World</strong></td><td><strong>Status</strong></td><td>Action</td></tr>';
                $account_players = $account->getPlayersList();
                $player_number = 0;
                foreach ($account_players as $player_list) {
                    if ($name == $player_list->getName() || !$player_list->isHidden()) {
                        $player_number++;
                        $bgcolor = (($number_of_rows++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
                        if (!$player_list->isOnline())
                            $player_list_status = '<font class="red"><strong>offline</strong></font>';
                        else
                            $player_list_status = '<font class="green"><strong>online</strong></font>';

                        $main_content .= '
								<tr >
									<td width="35%">' . $player_number . '. ' . htmlspecialchars($player_list->getName()) . '</td>
									<td width="35%">' . htmlspecialchars($config['server']['serverName']) . '</td>
									<td width="70%">' . (($player_list->isDeleted()) ? 'deleted' : $player_list_status) . '</td>
									<td>
										<table border="0" cellspacing="0" cellpadding="0">
											<form action="" method="post">
                                                <input type="hidden" name="name" value="' . htmlspecialchars($player_list->getName()) . '">
                                                <button style="font-size:20px;margin-left:30px;">View</button>											
                                                </form>
										</table>
									</td>
								</tr>';
                    }
                }
                $main_content .= $make_table_footer();
                $main_content .= "</div><br/>";
            }
        }
    } else
        $search_error = 'Character <b>' . htmlspecialchars($name) . '</b> does not exist.';
}
if (!empty($search_error)) {
    $main_content .= "<div class='TableContainer'>";
    $main_content .= $make_content_header("Could not find character");
    $main_content .= $make_table_header('Table3', '', TRUE);
    $main_content .= '
			<TR>
				<TD BGCOLOR="#291b1c" style="text-align: center">' . $search_error . '</TD>
			</TR>
		';
    $main_content .= $make_table_footer();
    $main_content .= "</div><br/><br/>";
}

$main_content .= "<div class='TableContainer'>";
$main_content .= '<div class="community-up-section">
<div class="community-up-text">
        Search Characters
    </div>
</div>';
$main_content .= $make_table_header('Table3', '', TRUE);
$main_content .= '
	<form action="" method="post">
			<tr>
                <td>Name:</td>
                <td><input name="name" value="" size="29" maxlenght="29"></td>
                <td><button style="font-size:20px;margin-left:40px;">Search</button></td>
			</tr>
	</form>';
$main_content .= $make_table_footer();
$main_content .= "</div>";