<?php
require __DIR__ . '/vendor/autoload.php'; // Asegúrate de tener el SDK de Mercado Pago instalado

// Configurar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Accede al SDK de Mercado Pago
MercadoPago\SDK::setAccessToken('APP_USR-3601757647699862-092906-c5fbbd5f0f53d938c497083982a1c41b-59159905'); // Usa tu Access Token

// Obtener los datos del POST
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['total'])) {
    $total = $data['total'];

    // Crear una preferencia de pago
    $preference = new MercadoPago\Preference();

    $item = new MercadoPago\Item();
    $item->title = 'Compra en Pizza Day';
    $item->quantity = 1;
    $item->unit_price = (float) $total;
    $preference->items = array($item);

    // Guardar preferencia
    $preference->save();

    // Devolver preferencia
    header('Content-Type: application/json');
    $response = ['id' => $preference->id];
    echo json_encode($response);
} else {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'El total es requerido']);
}

// Para verificar qué se está devolviendo
var_dump($response); // Verifica la respuesta
exit; // Termina la ejecución aquí
?>

