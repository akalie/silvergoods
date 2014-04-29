<?php
/* Sites-Stroy.ru by iProger */

function SendMail($em_to,$subject,$mess)
{
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'To: '.$em_to . "\r\n";
	$headers .= 'From: StarMaster <noreply@starsmaster.net>' . "\r\n";
	
	mail($em_to, $subject, $mess, $headers);
}

$fio = $_POST['fio'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$adress = $_POST['adress'];
$kolvo = $_POST['kolvo'];
$num = $_POST['num'];

$adminEmail = 'a.krylov@topface.com';

$mess = "Новый заказ Серебряной ложки.<br/>Ложка №".$num." <br/>ФИО: ".$fio."<br/>"."E-mail: ".$email."<br/>"."<br/>Телефон: ".$tel."<br/>Адрес: ".$adress;

SendMail($adminEmail, 'Новый заказ', $mess);

$mess = <<<HDO
Уважаемый $fio <br/>
Вы заказали у нас серебряную ложку ($kolvo шт.), указали адрес $adress, в течение рабочего дня с Вами свяжется наш менеджер для подтверждения заказа.<br/>
Возникшие вопросы вы можете задать по такому-то номеру телефона.<br/>
Спасибо, что воспользовались нашими услугами!
HDO;

SendMail($email, 'Ваш заказ', $mess);

?>