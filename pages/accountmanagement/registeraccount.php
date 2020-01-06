<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:16
 */

if (empty($account_reckey)) {
	$main_content .= '
	<div class="community-up-section">
					<div class="community-up-text">
						Register Account
					</div>
				</div>
				<div id="ProgressBar">';
  
    if (!isset($_REQUEST['step'])) {
		$main_content .= '
				
				</br>
				Account registration offers many important advantages:
				<ul>
					<li>Registered users get a recovery key, which can be used to recover their accounts if they have lost access to the assigned email address.</li>
					<li>Registered users can request a new recovery key for a small fee.</li>
					<li>Extra Services can only be bought for registered accounts.</li>
					<li>Finally, only registered users can become tutor.</li>
				</ul>
				<b>NOTE:</b> The data given in the registration will be used exclusively for compiling internal statistical surveys. It will be treated in a strictly confidential manner.<br/>
				<br/>
				Please enter correct and complete data to make sure we can provide you with the best possible support. Above all, give your full address to make sure that our postal recovery letters will reach you. Note that all data entered in the registration can be re-edited later on.<br/>

				<br/>
				<form action="?subtopic=accountmanagement&action=registeraccount&step=2" method=post>
					<div class="TableContainer" >
						<table class="Table1" cellpadding="0" cellspacing="0" >
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" >
									<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-edge.gif);" /></span>
									<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/assets/img/content/table-headline-border.gif);" ></span>
									<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-vertical.gif);" /></span>
									<div class="Text">Enter Registration Data</div>
									<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-vertical.gif);" /></span>
									<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/assets/img/content/table-headline-border.gif);" ></span>
									<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-edge.gif);" /></span>
								</div>
							</div>
							<tr>
								<td><div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td class="LabelV" width="120px" ><span >First Name:</span></td>
												<td><input name="firstname" value=""size="30" maxlength="30" required></td>
											</tr>
											<tr>
												<td class="LabelV" ><span >Last Name:</span></td>
												<td><input name="lastname" value="" size="30" maxlength="30" required></td>
											</tr>
											<tr>
												<td class="LabelV" ><span >City:</span></td>
												<td><input name="city" value="" size="40" maxlength="50" required></td>
											</tr>
												<td class="LabelV" ><span >Date of Birth:</span></td>
												<td>
													<select size="1" name="dateofbirthday" required>
														<option value="0">---</option>';
        for ($s = 1; $s < 31; $s++)
            $main_content .= '<option value="' . $s . '">' . $s . '</option>';
        $main_content .= '
													</select>
													<select size="1" name="dateofbirthmonth" required>
														<option value="0">---</option>';
        $months = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
        $months_number = 0;
        foreach ($months as $m) {
            $months_number++;
            $main_content .= '<option value="' . $months_number . '">' . $m . '</option>';
        }
        $main_content .= '
													</select>';
        $main_content .= '
													<select size="1" name="dateofbirthyear" required>
														<option value="0">---</option>';
        for ($i = 2009; $i > 1901; $i--) {
            $main_content .= '<option value="' . $i . '">' . $i . '</option>';
        }
        $main_content .= '
													</select>
												</td>
											</tr>
											<tr>
												<td class="LabelV" ><span >Gender:</span></td>
												<td>
													<select size="1" name="gender">
														<option value="">---</option>
														<option value="female">female</option>
														<option value="male">male</option>
													</select>
												</td>
											</tr>
										</table>
									</div>
								</table>
								
							</div>
						</td>
					</tr>
					<br/>
					<table style="width:100%;" >
					<tr align="center">
						<td><table border="0" cellspacing="0" cellpadding="0" >
							<tr>
								<td style="border:0px;" >
									<input type="hidden" name=function value=confirmdata >
									<input type="hidden" name=source value=start >
									<center><button style="font-size:20px;">Continue</button></center>

								</td>
							<tr>
						</form>
					</table>
				</td>
				<td><table border="0" cellspacing="0" cellpadding="0" >
						<form action="?subtopic=accountmanagement&action=manage" method="post" >
							<tr>
								<td style="border:0px;" >
								<center><button style="font-size:20px;">Back</button></center>
								</td>
							</tr>
						</form>
					</table>
				</td>
			</tr>
		</table>
		</div>';
    } elseif ($_REQUEST['step'] == 2) {
        if ($_POST['function'] == "confirmdata") {
            //Get values from form, and prepare to get RK
            $firstName = ucfirst(trim(stripslashes($_POST['firstname'])));
            $lastname = ucfirst(trim(stripslashes($_POST['lastname'])));
            $city = ucfirst(trim(stripslashes($_POST['city'])));
            $dateofbirth = (int)$_POST['dateofbirthday'] . '/' . (int)$_POST['dateofbirthmonth'] . '/' . (int)$_POST['dateofbirthyear'];
            $gender = $_POST['gender'];
            $fullname = $firstName . ' ' . $lastname;
            
            $main_content .= '
						Please review the data you have entered. If you would like to correct data, click on "Back".<br/>
						<br/>
						<div class="TableContainer" >
							<table class="Table1" cellpadding="0" cellspacing="0" >
								<div class="CaptionContainer" >
									<div class="CaptionInnerContainer" >
										<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-edge.gif);" /></span>
										<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/assets/img/content/table-headline-border.gif);" ></span>
										<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-vertical.gif);" /></span>
										<div class="Text" >Verify Registration Data</div>
										<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-vertical.gif);" /></span>
										<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/assets/img/content/table-headline-border.gif);" ></span>
										<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-edge.gif);" /></span>

										<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-edge.gif);" /></span>
									</div>
								</div>
								<tr>
									<td><div class="InnerTableContainer" >
											<table style="width:100%;" >
												<tr>
													<td class="LabelV" >First Name:</td>
													<td style="width:90%;" >' . $firstName . '</td>
												</tr>
												<tr>
													<td class="LabelV" >Last Name:</td>
													<td>' . $lastname . '</td>
												</tr>
												<tr>
													<td class="LabelV" >City:</td>
													<td>' . $city . '</td>
												</tr>
												<tr>
													<td class="LabelV" >Date of Birth:</td>
													<td>' . $dateofbirth . '</td>
												</tr>
												<tr>
													<td class="LabelV" >Gender:</td>
													<td>' . $gender . '</td>
												</tr>
												<form action="?subtopic=accountmanagement&action=registeraccount&step=3" method="post" >
											</table>
										</div>
									</table>
								</div>
							</td>
						</tr>
						<br/>
						<table style="width:100%;" >
							<tr align="center">
								<td><table border="0" cellspacing="0" cellpadding="0" >
										<tr>
											<td style="border:0px;" >
												<input type="hidden" name=function value=getrecoverykey >
												<input type="hidden" name=firstname value="' . $firstName . '" >
												<input type="hidden" name=lastname value="' . $lastname . '">
												<input type="hidden" name=city value="' . $city . '">
												<input type="hidden" name=dateofbirthday value=' . (int)$_POST['dateofbirthday'] . '>
												<input type="hidden" name=dateofbirthmonth value=' . (int)$_POST['dateofbirthmonth'] . '>
												<input type="hidden" name=dateofbirthyear value=' . (int)$_POST['dateofbirthyear'] . '>
												<input type="hidden" name=gender value="' . $gender . '">
												<input type="hidden" name=source value=main>
												<center><button style="font-size:20px;">Continue</button></center>
												</td>
										<tr></form>
									</table></td>
								<td>
									<table border="0" cellspacing="0" cellpadding="0" >
										<form action="?subtopic=accountmanagement&action=registeraccount" method="post" >
											<tr>
												<td style="border:0px;" >
													<input type="hidden" name=firstname value="' . $firstName . '" >
													<input type="hidden" name=lastname value="' . $lastname . '">
													<input type="hidden" name=city value="' . $city . '">
													<input type="hidden" name=dateofbirthday value=' . (int)$_POST['dateofbirthday'] . '>
													<input type="hidden" name=dateofbirthmonth value=' . (int)$_POST['dateofbirthmonth'] . '>
													<input type="hidden" name=dateofbirthyear value=' . (int)$_POST['dateofbirthyear'] . '>
													<input type="hidden" name=gender value="' . $gender . '">
													<input type="hidden" name=source value=main>
														<center><button style="font-size:20px;">Back</button></center>
												</td>
											</tr>
										</form>
									</table>
								</td>
							</tr>
						</table>
						</div>';
        
        } else {
            header("Location: ?subtopic=accountmanagement&action=manage");
        }
    } elseif ($_REQUEST['step'] == 3) {
        if ($_POST['function'] == "getrecoverykey") {
            //Get values from form, and prepare to get RK
            $firstName = ucfirst(trim(stripslashes($_POST['firstname'])));
            $lastname = ucfirst(trim(stripslashes($_POST['lastname'])));
            $city = ucfirst(trim(stripslashes($_POST['city'])));
            $dateofbirth = (int)$_POST['dateofbirthday'] . '/' . (int)$_POST['dateofbirthmonth'] . '/' . (int)$_POST['dateofbirthyear'];
            $gender = $_POST['gender'];
            $fullname = $firstName . ' ' . $lastname;
            
            //Function to generate NUMBERS
            function generateRK ($length)
            {
                $vowels = "AEIOUY";
                $consonants = "BDGHJLMNPQRSTVWXZ0123456789";
                $password = "";
                $alt = time() % 2;
                for ($i = 0; $i < $length; $i++) {
                    if ($alt == 1) {
                        $password .= $consonants[(rand() % strlen($consonants))];
                        $alt = 0;
                    } else {
                        $password .= $vowels[(rand() % strlen($vowels))];
                        $alt = 1;
                    }
                }
                return $password;
            }
            
            $recoveryKey = generateRk(4) . '-' . generateRk(4) . '-' . generateRk(4) . '-' . generateRk(4);
            
            $reg = $account_logged;
            $reg->setRLName($fullname);
            $reg->setLocation($city);
            $reg->setBirthDate($dateofbirth);
            $reg->setGender($gender);
            $reg->setKey($recoveryKey);
            $reg->save();
            $mailDescription = "Olá {$reg->getName()}, obrigado por finalizar seu registro.";
            $mailBodyDescription = "Aqui estão os dados da sua recovery key do server {$config['server']['serverName']}.";
            $mailBody = $recoveryKey;
            $mail = new SendMail();
//            $mail->send($reg->getEMail(), (!empty($reg->getRLName())?$reg->getRLName():$reg->getName()), utf8_encode('Obrigado pelo cadastro. Essa é sua recovery key.'), $mailDescription, $mailBodyDescription, $mailBody);
            $mail->send($reg->getEMail(), (!empty($reg->getRLName())?$reg->getRLName():$reg->getName()), utf8_decode('Obrigado pelo cadastro. Essa é sua recovery key.'), $mailDescription, $mailBodyDescription, $mailBody);
            
            if ($reg)
                $main_content .= '
						<div class="TableContainer" >
							<table class="Table1" cellpadding="0" cellspacing="0" >
								<div class="CaptionContainer" >
									<div class="CaptionInnerContainer" >
										<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-edge.gif);" /></span>
										<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/assets/img/content/table-headline-border.gif);" ></span>
										<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-vertical.gif);" /></span>
										<div class="Text" >Account Registered</div>
										<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-vertical.gif);" /></span>
										<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/assets/img/content/table-headline-border.gif);" ></span>
										<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/assets/img/content/box-frame-edge.gif);" /></span>
									</div>
								</div>
								<tr>
									<td>
										<div class="InnerTableContainer" >
											<table style="width:100%;" >
												Thank you for registering your account! You can now recover your account if you have lost access to the assigned email address by using the following<br/>
												<br/>
												<font size="5">&nbsp;&nbsp;&nbsp;<b>Recovery Key: ' . $account_logged->getKey() . '</b></font><br/>
												<br/>
												<br/>
												<b>Important:</b>
												<ul>
													<li>Write down this recovery key carefully.</li>
													<li>Store it at a safe place! Do not save it on your computer!</li>
													<li>You will not receive an email containing this recovery key.</li>
													<li>If you lose your recovery key, you can request a new one for a small fee at the Lost Account Interface.</li>
												</ul>
											</table>
										</div>
									</table>
								</div>
							</td>
						</tr>
						<br/>
						<center>
							<table border="0" cellspacing="0" cellpadding="0" >
								<form action="?subtopic=accountmanagement" method="post" >
									<tr>
										<td style="border:0px;" ><input type="hidden" name=action value=manage >
										<center><button style="font-size:20px;">Continue</button></center>
										</td>
									</tr>
								</form>
							</table>
						</center>
						</div>';
            else die();
            
        } else {
            header("Location: ?subtopic=accountmanagement&action=manage");
        }
    }
}