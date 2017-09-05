<?php
class mailer {
	public static function Send($to, $subject, $message, $attachments = array(), $riders = array(), $replyTo = null, $replyToName = '', $from = EMAIL_DEFAULT_FROM, $fromName = EMAIL_DEFAULT_FROMNAME) {

		$phpMailer = new PHPMailer();
		
		//$phpMailer->SMTPAuth = false;
		
		$phpMailer->IsSMTP(true);            // use SMTP

		//$mail->SMTPDebug  = 2;        // enables SMTP debug information (for testing)
										// 1 = errors and messages
										// 2 = messages only
		$phpMailer->SMTPAuth   = true;                  // enable SMTP authentication
		$phpMailer->Host       = AMAZON_SES_SMTP_SERVER; // Amazon SES server, note "tls://" protocol
		$phpMailer->Port       = 465;                    // set the SMTP port
		$phpMailer->Username   = AMAZON_SES_SMTP_USER;  // SES SMTP  username
		$phpMailer->Password   = AMAZON_SES_SMTP_PASS;  // SES SMTP password
				
		$phpMailer->From = $from;
        $phpMailer->FromName = $fromName;
		$phpMailer->Subject = $subject;
		$phpMailer->MsgHTML($message);

		if ($replyTo) $phpMailer->AddReplyTo($replyTo, $replyToName);

		if (!is_array($to)) $to = array($to);
		foreach ($to as $address) {
			$phpMailer->AddAddress($address);
		}
		
		if (!empty($riders)) {
			foreach ($riders as $r) {
				$phpMailer->AddBCC($r);
			}
		}

		foreach ($attachments as $a) {
		   $phpMailer->AddAttachment($a);
		}

		$success = $phpMailer->Send();
		$phpMailer->ClearAddresses();
		$phpMailer->ClearAttachments();
		
		if($success) $r = $success;
		else $r = $phpMailer->ErrorInfo;
		
		return $r;
	}
	
	public static function GetTemplateMail($template, $replace_vars) {
		$template_content = file_get_contents(EMAIL_TEMPLATE_FOLDER.$template.".html");
		foreach ($replace_vars as $search => $replace) {
			$template_content = str_replace($search, $replace, $template_content);
		}
		return $template_content;
	}
	
	public static function SendUserRegisterMail($email, $name) {
		$subject = "New Rhovit User Account";
		$message = mailer::GetTemplateMail("user_register", array("%NAME%" => $name));
		return mailer::Send($email, $subject, $message);
	}
	
	public static function SendUserProviderRegisterMail($email, $name) {
		$subject = "New Rhovit User Provider Account";
		$message = mailer::GetTemplateMail("user_provider_register", array("%NAME%" => $name));
		return mailer::Send($email, $subject, $message);
	}
	
	public static function SendForgotPasswordMail($email, $name, $link) {
		$subject = "Recover your Rhovit Password";
		$message = mailer::GetTemplateMail("forgot_password", array("%NAME%" => $name, "%LINK%" => $link));
		return mailer::Send($email, $subject, $message);
	}
	
	public static function SendInvitationMail($email, $name, $invited_by) {
		$subject = $invited_by." is inviting you to Rhovit";
		$message = mailer::GetTemplateMail("invitation", array("%NAME%" => $name));
		return mailer::Send($email, $subject, $message);
	}
	
	public static function SendInvitationProviderMail($email, $name, $invited_by) {
		$subject = "Invitation to join Rhovit";
		$message = mailer::GetTemplateMail("invitation_provider", array("%NAME%" => $name));
		return mailer::Send($email, $subject, $message);
	}
}
?>