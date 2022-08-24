<?php

namespace App;

use App\Config;
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
						//$mail->CharSet = "UTF-8";
						
						$mail->SMTPOptions = [
									'ssl' => [
										'verify_peer' => false,
										'verify_peer_name' => false,
										'allow_self_signed' => true,
									]
								];

						$mail->IsSMTP();
						$mail->SMTPAutoTLS = false;
						//$mail->Host = 'smtp.mailtrap.io';
						$mail->Host = 'budget.karol-jeczmionka.pl'; # Gmail SMTP host
						$mail->Port = 587; # Gmail SMTP port
						//$mail->Port = 2525; 
						$mail->SMTPAuth = true; # Enable SMTP authentication / Autoryzacja SMTP
						//$mail->SMTPDebug = 4;
						
						$mail->SMTPSecure = 'tls';
						$mail->Username = "budget@karol-jeczmionka.pl"; # Gmail username (e-mail) / Nazwa użytkownika
						$mail->Password = "..."; # Gmail password / Hasło użytkownika
						
						
						$mail->From = 'budget@karol-jeczmionka.pl'; # REM: Gmail put Your e-mail here
						//$mail->setFrom ('info@mailtrap.io', 'Mailtrap'); # REM: Gmail put Your e-mail here
						$mail->FromName = 'karol'; # Sender name
						$mail->AddAddress($to, 'Karol Jeczmionka'); # # Recipient (e-mail address + name) / Odbiorca (adres e-mail i nazwa)

						$mail->IsHTML(true); # Email @ HTML

						$mail->Subject =$subject ;
						$mail->Body = $html;
						$mail->AltBody = $text;

						if(!$mail->Send()) {
						echo 'Some error... ';
						//echo 'Mailer Error: ' . $mail->ErrorInfo;
						exit;
						}

						echo 'Message has been sent (OK) / Wiadomość wysłana (OK)';		
	}		
}
