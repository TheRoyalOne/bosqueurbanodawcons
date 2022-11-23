<?php
set_time_limit ( 60);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '\PHPMailer\mailer\src/Exception.php';
require '\PHPMailer\mailer\src/SMTP.php';
require '\PHPMailer\mailer\src/PHPMailer.php';
$mail = new \PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 25; // TLS only
//$mail->SMTPSecure = 'tls'; // ssl is depracated
$mail->SMTPAuth = true;
$mail->Username = "vivero@extra.org.mx";
$mail->Password = "ichliebemeinekatze18";
//$mail->setFrom("vivero@extra.org.mx", "test serv");
$mail->setFrom("vivero@extra.org.mx", "Seguimiento Arboles");
$mail->addAddress("idamy@dwsoftware.mx", "ivan");
$mail->Subject = 'Seguimiento de arboles pendiente';

$cadena="Los siguientes arboles estan en la espera de seguimiento : <ul>";


 //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'HTML messaging not supported';



$databaseHost = '62.151.176.23';
$databaseName = 'ebu2';
$databaseUsername = 'BosqueUrbano';
$databasePassword = 'bosqu3urb4no@01'; 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
$result = mysqli_query($mysqli, 'SELECT VCH_CODIGOQR FROM 
			ebu2.traoper_021_registroadopcion adop
left join	catconf_020_arboles arb on adop.ID__ARBOL=arb.ID__ARBOL
WHERE adop.FEC_FECHA < ( DATE(NOW() - INTERVAL 6 MONTH)	)	 
and adop.ID__ARBOL not in
(
	select ID__ARBOL from
    (
		select max(ID__SEGUIMIENTO) ID__SEGUIMIENTO,ID__ARBOL from traoper_051_seguimientosresumida 
		group by ID__ARBOL  
    )b
)
order by adop.FEC_FECHA DESC
					');

$rows = $result->fetch_all(MYSQLI_ASSOC);
foreach($rows as $row)
{
	if($row["VCH_CODIGOQR"]!='')
	{
		$cadena.="<li>".$row["VCH_CODIGOQR"]."</li>";
	}
}
$cadena.="</ul>";
//$result->free();
$mysqli->close();


$mail->msgHTML($cadena);
if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}else{
    echo "Message sent!";
}

