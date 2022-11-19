<?php
session_start();
// Include configuration file  +
require_once 'config.php';
require 'conexao.php';

// Include Stripe PHP library 
require_once 'stripe-php/init.php';
// Set API key
\Stripe\Stripe::setApiKey('sk_test_51LICzTBPFZTTvEng2E4zJ4bWMCyeQxnEpFJrv5N40mXxvKs6QTTRFsRiUyRmsDyBPsf3ywe1DmQVsd76fXUyQlGX00psHjRN7C');
$response = array(
    'status' => 0,
    'error' => array(
        'message' => 'Requisição inválida!'   
    )
);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$input = file_get_contents('php://input');
	$request = json_decode($input);	
}
if (json_last_error() !== JSON_ERROR_NONE) {
	http_response_code(400);
	echo json_encode($response);
	exit;
}

$planos = $request->Planos;
$valor= $request->Price;
$produto= $request->Ingresso;

//O Id do cliente será lido da Sessão
$id_cliente=	$_SESSION['id'];
 
// Convert product price to cent 
$stripeAmount = round($valor*100, 2); 

foreach($planos as $plano_id => $quantidade) {
$quantidade2 = $quantidade;
}
    
//Fecha a conexão.
$conn->close();

if(!empty($request->checkoutSession)){
    // Create new Checkout Session for the order
    try {
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'product_data' => [
                        'name' => 'Ingresso(s) - Tix4tonight',
                        'metadata' => [
                            'pro_id' => 1
                        ]
                    ],
                    'unit_amount' => $stripeAmount,
                    'currency' => 'brl',
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => STRIPE_SUCCESS_URL.'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => STRIPE_CANCEL_URL,
            'metadata' => ['id_ingresso' => $produto, 'id_cliente' => $id_cliente, 'id_quant' => $quantidade2], 
        ]);
    }catch(Exception $e) { 
        $api_error = $e->getMessage(); 
    }
    
    if(empty($api_error) && $session){
        $response = array(
            'status' => 1,
            'message' => 'Criação da Sessão concluida!',
            'sessionId' => $session['id']
        );
    }else{
        $response = array(
            'status' => 0,
            'error' => array(
                'message' => 'Criação da Sessão falhou! '.$api_error   
            )
        );
    }
}

// Return response
echo json_encode($response);