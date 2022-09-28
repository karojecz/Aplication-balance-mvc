<?php

namespace App;

use App\Config;
use \App\Flash;
//use Mailgun\Mailgun;
use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';


/**
 * Mail
 *
 * PHP version 7.0
 */
class Mail
{


	
	
	public static function send($to, $subject, $text, $html)
	{


							

						$mail = new PHPMailer;
						
						
						$mail->SMTPOptions = [
									'ssl' => [
										'verify_peer' => false,
										'verify_peer_name' => false,
										'allow_self_signed' => true,
									]
								];

						$mail->IsSMTP();
						$mail->SMTPAutoTLS = false;
						
						$mail->Host = Config::MAIL_HOST; # Gmail SMTP host
						$mail->Port =  Config::MAIL_PORT; # Gmail SMTP port
						
						$mail->SMTPAuth = true; # Enable SMTP authentication / Autoryzacja SMTP
						
						
						$mail->SMTPSecure = 'tls';
						$mail->Username = Config::MAIL_USERNAME; # Gmail username (e-mail) / Nazwa użytkownika
						$mail->Password = Config::MAIL_PASSWORD; # Gmail password / Hasło użytkownika
						
						
						$mail->From = Config::MAIL_ADRESS; # REM: Gmail put Your e-mail here
						//$mail->setFrom ('info@mailtrap.io', 'Mailtrap'); # REM: Gmail put Your e-mail here
						$mail->FromName = 'karol'; # Sender name
						$mail->AddAddress($to, 'Karol Jeczmionka'); # # Recipient (e-mail address + name) / Odbiorca (adres e-mail i nazwa)

						$mail->IsHTML(true); # Email @ HTML

						$mail->Subject =$subject ;
						$mail->Body = $html;
						$mail->AltBody = $text;

						if(!$mail->Send()) {
						echo 'Some error... ';
						echo 'Mailer Error: ' . $mail->ErrorInfo;
						exit;
						}
							
							
							
	}		
}
