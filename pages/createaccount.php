<?php

if (!defined('INITIALIZED'))
    exit;
require 'config/namesblocked.php';
//Website::getDBHandle()->setPrintQueries(TRUE);

/**
 * Function Encrontrou numeros by Ricardo Souza
 * Serve para saber se foi encontrado algum numero na string
 *
 * @param $string
 * @return bool
 */
function encontrouNumeros ($string)
{
    return strpbrk($string, '0123456789') !== FALSE;
}

if (!$logged) {
    $voc = array(); // Rookgard Active !
    
    if (isset($_POST['step']) && $_POST['step'] == 'docreate') {
        $erro = array();
        
        # Nome da conta
        $accountname = isset($_POST['accountname']) ? $_POST['accountname'] : '';
        
        if ($accountname == '')
            $erro['acc'] = 'Please enter an account name!';
        elseif (strlen($accountname) < 3)
            $erro['acc'] = 'This account name is too short!';
        elseif (strlen($accountname) > 30)
            $erro['acc'] = 'This account name is too long!';
        else {
            $accountname = strtoupper($accountname);
            
            if (!ctype_alnum($accountname))
                $erro['acc'] = 'This account name has an invalid format. Your account name may only consist of numbers 0-9 and letters A-Z!';
            elseif (!preg_match('/[A-Z0-9]/', $accountname))
                $erro['acc'] = 'Your account name must include at least one letter A-Z!';
            else {
//                $acc = new Account($accountname, Account::LOADTYPE_NAME);
//                if ($acc->isLoaded()){
//                    $erro['acc'] = 'This account name is already used. Please select another one!';
//                }
            }
        }
        
        
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        
        if ($email == '') {
            $erro['email'] = 'Please enter your email address!';
        } elseif (strlen($email) > 49) {
            $erro['email'] = 'Your email address is too long!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro['email'] = 'This email address has an invalid format. Please enter a correct email address!';
        } else {
//            $accMailCheck = new Account($email, Account::LOADTYPE_MAIL);
//            if ($accMailCheck->isLoaded()){
//                $erro['email'] = 'This email address is already used. Please enter another email address!';
//            }
        }
        
        $valida = $SQL->prepare("SELECT * FROM accounts where name = :accname or email = :email");
        $valida->execute(['accname' => $accountname, 'email' => $email]);
        
        if ($valida->rowCount() > 0) {
            $erro['valida'] = 'Email or account exists on database.';
        }
        
        $password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
        $password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
        
        if (empty($password2))
            $erro['pass'] = 'Please enter the password again!';
        elseif ($password1 != $password2)
            $erro['pass'] = 'The two passwords do not match!';
        else {
            $err = [];
            if (strlen($password1) < 8 || strlen($password1) > 29) {
                $err[] = 'The password must have at least 8 and less than 30 letters!';
            }
            
            if (!ctype_alnum($password1) || !encontrouNumeros($password1)) {
                $err[] = 'The password must contain at least one number!';
            }
            if (is_numeric($password1)) {
                $err[] = 'The password must contain at least one letter A-Z or a-z!!';
            }

//            if (ctype_alnum($password1))
//                $err[] = 'The password contains invalid letters!';
            
            
            if (count($err) != 0) {
                $erro['pass'] = '';
                for ($i = 0; $i < count($err); $i++)
                    $erro['pass'] .= ($i == 0 ? '' : '<br/>') . $err[$i];
            }
        }
        
        if (!isset($_POST['agreeagreements']) || empty($_POST['agreeagreements'])) {
            $erro['rules'] = 'You have to agree to the ' . $config['server']['serverName'] . ' Rules in order to create an account!';
        }
        
        if (count($erro) != 0) {
            
            $main_content = '
                <div class="SmallBox">
                <div class="MessageContainer">
                <div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif)"/></div>
                <div class="BoxFrameEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif)"/></div>
                <div class="BoxFrameEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif)"/></div>
                <div class="ErrorMessage"><div class="BoxFrameVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif)"/></div>
                <div class="BoxFrameVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif)"/></div>
                <div class="AttentionSign" style="background-image:url(' . $layout_name . '/images/global/content/attentionsign.gif)"/></div>
                <b>The Following Errors Have Occurred:</b>
                <br/>';
            foreach ($erro as $error) $main_content .= $error . '<br/>';
            $main_content .= '</div>
                <div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif)"/></div>
                <div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif)"/></div>
                <div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/content/global/box-frame-edge.gif)"/>
                </div>
                </div>
                </div>
                <br/>';
            
            $main_content .= '
			<script src="' . $layout_name . '/assets/js/create_character.js"></script>
			<div style="position:relative;top:0px;left:0px;" >
				<form action="?subtopic=createaccount" method=post name="CreateAccountAndCharacter" >
					<div class="TableContainer" >
						<table class="Table5" cellpadding="0" cellspacing="0" >
						<div class="community-up-section">
						<div class="community-up-text">
							Register Account
						</div>
					</div>';
            //Account
            $main_content .= '
			<div class="register-account-form">
				
				<label for="i-username">Account Number:</label>
				<input id="accountname" 
																		name="accountname" 
																		class="CipAjaxInput" 
																		style="width:206px;float:left;" 
																		value="' . (isset($_POST['accountname']) ? htmlspecialchars(substr($_POST['accountname'], 0, 30)) : '') . '" 
																		size="30" 
																		maxlength="30" 
																		onBlur="SendAjaxCip({DataType: \'Container\'}, {Href: \'./ajax_account.php\',PostData: \'a_AccountName=\'+getElementById(\'accountname\').value,Method: \'POST\'});" />
				
				<label for="i-password">Password:</label>
				<input id="password1" type="password" name="password1" style="width:206px;float:left;" value="' . (isset($_POST['password1']) ? htmlspecialchars(substr($_POST['password1'], 0, 30)) : '') . '" size="30" maxlength="30" onBlur="SendAjaxCip({DataType: \'Container\'}, {Href: \'./account/ajax_password.php\',PostData: \'a_Password1=\'+getElementById(\'password1\').value+\'&a_Password2=\'+getElementById(\'password2\').value,Method: \'POST\'});" />
				
				<label for="i-password_again"> Confirm password:</label>
				<input id="password2" type="password" name="password2" style="width:206px;float:left;" value="' . (isset($_POST['password2']) ? htmlspecialchars(substr($_POST['password2'], 0, 30)) : '') . '" size="30" maxlength="30" onBlur="SendAjaxCip({DataType: \'Container\'}, {Href: \'./account/ajax_password.php\',PostData: \'a_Password1=\'+getElementById(\'password1\').value+\'&a_Password2=\'+getElementById(\'password2\').value,Method: \'POST\'});" />
				
				<label for="i-email">E-mail:</label>
				<input id="email" name="email" class="CipAjaxInput" style="width:206px;float:left;" value="' . (isset($_POST['email']) ? htmlspecialchars(substr($_POST['email'], 0, 50)) : '') . '" size="30" maxlength="50" onBlur="SendAjaxCip({DataType: \'Container\'}, {Href: \'./ajax_email.php\',PostData: \'a_EMail=\'+encodeURIComponent(getElementById(\'email\').value),Method: \'POST\'});" />
		
				<label for="i-selected"><b>Please select the following check box:</b></label>
				<input type="checkbox" name="agreeagreements" value="true"  onClick="if(this.checked == true) {  document.getElementById(\'agreeagreements_errormessage\').innerHTML = \'\';} else {  document.getElementById(\'agreeagreements_errormessage\').innerHTML = \'You have to agree to the ' . $config['server']['serverName'] . ' Rules in order to create an account!\';}"' . ($_POST['step'] == 'docreate' && !isset($e['rules']) ? ' checked="checked"' : '') . '/>
				I agree to the <a href="?subtopic=tibiarules" target="_blank" >' . $config['server']['serverName'] . ' Rules</a>.
				<span id="agreeagreements_errormessage" class="FormFieldError">' . (isset($e['rules']) ? $e['rules'] : '') . '</span>
				 
				       <div style="clear:both;"></div>
					<div style="clear:both;"></div>
				
					<input type="hidden" name=step value=docreate >
					<input type="hidden" name=noframe value= >
					<button style="font-size:20px;margin-left:40px;">Register</button>
			</div>';

        
            
            $main_content .= '
						</table>
					</div>
					<br />
					<center>
					</form>
			</center>
		</form>		
	</div>';
        
        } else {
            $reg_account = new Account();
            $reg_account->setName(strtoupper($_POST['accountname']));
            $reg_account->setPassword($_POST['password1']);
            $reg_account->setEMail($_POST['email']);
            $reg_account->setPremDays(Website::getWebsiteConfig()->getValue('newaccount_premdays'));
            $reg_account->setCreateDate(time());
            if (Visitor::getIP() != FALSE) {
                $reg_account->setCreateIP(Visitor::getIP());
                $reg_account->setFlag(Website::getCountryCode(long2ip(Visitor::getIP())));
            }
            $reg_account->save();
            if ($config['site']['send_emails']) {
                $mail = new SendMail();
                $reg_name = $reg_account->getName();
                $reg_email = $reg_account->getEMail();
                $mailBody = '
			<p>Você ou outra pessoa se registrou no <a href="' . $config['server']['url'] . '"><b>' . htmlspecialchars($config['server']['serverName']) . '</b></a> com esse e-mail, caso não, favor desconsiderar este.</p>
			<p>Account name: <b>' . htmlspecialchars($reg_name) . '</b></p>			
			<br />
			<p>Após fazer login você pode:</p>
			Criar novos personagens<br>
			Alterar sua senha<br>
			Alterar seu e-mail atual<br>';
                $subject = "Conta criada no website {$config['server']['serverName']}";
                $mailDescription = "Olá {$reg_name}, seja bem vindo ao {$config['server']['serverName']}.";
                $mailBodyDescription = "Aqui estão os dados de criação de sua nova conta no {$config['server']['serverName']}";
                if ($mail->send($reg_email, $reg_name, $subject, $mailDescription, $mailBodyDescription, $mailBody)) {
                    $_SESSION['account'] = $_POST['accountname'];
                    $_SESSION['password'] = $_POST['password1'];
                    $_SESSION['recaptcha'] = TRUE;
                    Visitor::login();
                    //header("Location: ./?subtopic=accountmanagement");
                } else {
                    $_SESSION['account'] = $_POST['accountname'];
                    $_SESSION['password'] = $_POST['password1'];
                    $_SESSION['recaptcha'] = TRUE;
                    Visitor::login();
                    //header("Location: ./?subtopic=accountmanagement");
                }
            } else {
                $_SESSION['account'] = $_POST['accountname'];
                $_SESSION['password'] = $_POST['password1'];
                $_SESSION['recaptcha'] = TRUE;
                Visitor::login();
                //header("Location: ./?subtopic=accountmanagement");
            }
        }
        
    } else {
        
		$main_content .= '
		<script src="' . $layout_name . '/assets/js/create_character.js"></script>
		<div style="position:relative;top:0px;left:0px;" >
			<form action="?subtopic=createaccount" method=post name="CreateAccountAndCharacter" >
				<div class="TableContainer" >
					<table class="Table5" cellpadding="0" cellspacing="0" >
					<div class="community-up-section">
					<div class="community-up-text">
						Register Account
					</div>
				</div>';
		//Account
		$main_content .= '
		<div class="register-account-form">
			
			<label for="i-username">Account Number:</label>
			<input id="accountname" 
																	name="accountname" 
																	class="CipAjaxInput" 
																	style="width:206px;float:left;" 
																	value="' . (isset($_POST['accountname']) ? htmlspecialchars(substr($_POST['accountname'], 0, 30)) : '') . '" 
																	size="30" 
																	maxlength="30" 
																	onBlur="SendAjaxCip({DataType: \'Container\'}, {Href: \'./ajax_account.php\',PostData: \'a_AccountName=\'+getElementById(\'accountname\').value,Method: \'POST\'});" />
			
			<label for="i-password">Password:</label>
			<input id="password1" type="password" name="password1" style="width:206px;float:left;" value="' . (isset($_POST['password1']) ? htmlspecialchars(substr($_POST['password1'], 0, 30)) : '') . '" size="30" maxlength="30" onBlur="SendAjaxCip({DataType: \'Container\'}, {Href: \'./account/ajax_password.php\',PostData: \'a_Password1=\'+getElementById(\'password1\').value+\'&a_Password2=\'+getElementById(\'password2\').value,Method: \'POST\'});" />
			
			<label for="i-password_again"> Confirm password:</label>
			<input id="password2" type="password" name="password2" style="width:206px;float:left;" value="' . (isset($_POST['password2']) ? htmlspecialchars(substr($_POST['password2'], 0, 30)) : '') . '" size="30" maxlength="30" onBlur="SendAjaxCip({DataType: \'Container\'}, {Href: \'./account/ajax_password.php\',PostData: \'a_Password1=\'+getElementById(\'password1\').value+\'&a_Password2=\'+getElementById(\'password2\').value,Method: \'POST\'});" />
			
			<script>
			window.onload = function() {
			  SendAjaxCip({DataType: \'Container\'}, {Href: \'./ajax_account.php\',PostData: \'a_AccountName=\'+document.getElementById(\'accountname\').value,Method: \'POST\'});
			  SendAjaxCip({DataType: \'Container\'}, {Href: \'./ajax_email.php\',PostData: \'a_EMail=\'+encodeURIComponent(document.getElementById(\'email\').value),Method: \'POST\'});
			  SendAjaxCip({DataType: \'Container\'}, {Href: \'./ajax_email.php\',PostData: \'a_EMail=\'+encodeURIComponent(document.getElementById(\'email\').value),Method: \'POST\'});
			  SendAjaxCip({DataType: \'Container\'}, {Href: \'./account/ajax_password.php\',PostData: \'a_Password1=\'+document.getElementById(\'password1\').value+\'&a_Password2=\'+document.getElementById(\'password2\').value,Method: \'POST\'});
			  //SendAjaxCip({DataType: \'Container\'}, {Href: \'./account/ajax_password.php\',PostData: \'a_Password1=\'+document.getElementById(\'password1\').value+\'&a_Password2=\'+document.getElementById(\'password2\').value,Method: \'POST\'});
				
			
			};
		</script>

			<label for="i-email">E-mail:</label>
			<input id="email" name="email" class="CipAjaxInput" style="width:206px;float:left;" value="' . (isset($_POST['email']) ? htmlspecialchars(substr($_POST['email'], 0, 50)) : '') . '" size="30" maxlength="50" onBlur="SendAjaxCip({DataType: \'Container\'}, {Href: \'./ajax_email.php\',PostData: \'a_EMail=\'+encodeURIComponent(getElementById(\'email\').value),Method: \'POST\'});" />
	
			<label for="i-selected"><b>Please select the following check box:</b></label>
			<input type="checkbox" name="agreeagreements" value="true"  onClick="if(this.checked == true) {  document.getElementById(\'agreeagreements_errormessage\').innerHTML = \'\';} else {  document.getElementById(\'agreeagreements_errormessage\').innerHTML = \'You have to agree to the ' . $config['server']['serverName'] . ' Rules in order to create an account!\';}"' . ($_POST['step'] == 'docreate' && !isset($e['rules']) ? ' checked="checked"' : '') . '/>
			I agree to the <a href="?subtopic=tibiarules" target="_blank" >' . $config['server']['serverName'] . ' Rules</a>.
			<span id="agreeagreements_errormessage" class="FormFieldError">' . (isset($e['rules']) ? $e['rules'] : '') . '</span>
			 
				   <div style="clear:both;"></div>
				<div style="clear:both;"></div>
			
				<input type="hidden" name=step value=docreate >
				<input type="hidden" name=noframe value= >
				<button style="font-size:20px;margin-left:40px;">Register</button>
		</div>';

	
		
		$main_content .= '
					</table>
				</div>
				<br />
				<center>
				</form>
		</center>
	</form>		
</div>';
        
    }
    
    
} //else header("Location: ./?subtopic=accountmanagement");