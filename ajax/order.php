<?php
/* Sites-Stroy.ru by iProger */

include 'Tools.php';
include 'Api.php';

function SendMail($em_to,$subject,$mess)
{
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'To: '.$em_to . "\r\n";
    $headers .= 'From: SilverGoods <noreply@silvergoods.ru>' . "\r\n";

    mail($em_to, $subject, $mess, $headers);
}

$fio = $_POST['fio'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$adress = $_POST['adress'];
$kolvo = $_POST['kolvo'];
$num = $_POST['num'];
$phone = '+7(909)588-64-58';
$logFilePath = 'ordersLog.txt';
$logPhones= 'phonesLog.txt';

$testPhone = file_get_contents($logPhones);

if(strstr($testPhone, '|'.$tel.'|'))
{
    echo 'Нельзя заказывать несколько раз с одного номера телефона';
    exit;
}

$handle = fopen($logPhones, 'a');

fwrite($handle, '|'.$tel.'|');
fclose($handle);

$handle = fopen($logFilePath, 'a');

$adminEmail = 'starsmaster@allsocial.ru';

$mess = "Новый заказ Серебряной ложки.<br/>Ложка №".$num." в количестве $kolvo <br/>ФИО: ".$fio."<br/>"."E-mail: ".$email."<br/>"."<br/>Телефон: ".$tel."<br/>Адрес: ".$adress;

fwrite($handle, $mess . PHP_EOL);
fclose($handle);

SendMail($adminEmail, 'Новый заказ Серебряной ложки', $mess);

$data = Api::pack(2, 'Vndfc=vVijxN)NfZki70+2m#FFH=4l%oC7hS7J#+^7w8lvY2H(=P&PacQPmhM8#2', 1, 1, $email, $phone, '', 'покупаем ложки', $adress);
Api::doPostRequest($data);


$mess = <<<HDO
Уважаемый $fio <br/>
Вы заказали у нас серебряную ложку ($kolvo шт.), указали адрес $adress, в течение рабочего дня с Вами свяжется наш менеджер для подтверждения заказа.<br/>
Возникшие вопросы вы можете задать по телефону $phone .<br/>
Спасибо, что воспользовались нашими услугами!
HDO;

SendMail($email, 'Ваш заказ', $mess);
?>
<?php header ("Content-Type: text/html; charset=utf-8"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- Sites-Stroy.ru by iProger -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Серебрянные ложки</title>
    <LINK rel="icon" href="/images/favicon.png" type="image/x-icon">
    <link media="all" rel="stylesheet" type="text/css" href="/css/style.css" />
    <style>
        body {
            background-color: #D6D6D6 ;
            padding: 10px;
        }

        p {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        button {
            padding:7px 40px 7px 40px;
            font-weight: bold;
            font-size: 16px;
        }

        .content {
            padding-top: 50px;
        }

        .btn-w {
            padding-top: 20px;
            width: 100px;
            margin: auto;
        }
    </style>
</head>
<body>
<div class="content">
    <p>Мы отправили на ваш email письмо с данными заказа, если вы его там не нашли - посмотрите в спаме.</p>
    <div class="btn-w"><button onclick="window.close()">Ok</button></div>
</div>
<iframe src="http://track.adwad.ru/SL1sF?adv_sub=2" scrolling="no" frameborder="0" width="1" height="1"></iframe>
</body>