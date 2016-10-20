

<?php

//require_once '../braintree-php-2.34.0/lib/Braintree.php';
require_once './ajax/addToCartAJAX.php';
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('ywg2cdpqbzfmpfh2');
Braintree_Configuration::publicKey('d8tpfvtkgd4fjn3t');
Braintree_Configuration::privateKey('ae68a1b7bee6a725d3e7fdcc4ea00f37');

$clientToken = Braintree_ClientToken::generate();
echo $clientToken;
//$nonce = $_POST["payment_method_nonce"];
/*

$result = Braintree_Transaction::sale(array(
    'amount' => '1000.00',
    'creditCard' => array(
        'number' => '5105105105105100',
        'expirationDate' => '05/12'
    )
));

if ($result->success) {
    print_r("success!: " . $result->transaction->id);
} else if ($result->transaction) {
    print_r("Error processing transaction:");
    print_r("\n  code: " . $result->transaction->processorResponseCode);
    print_r("\n  text: " . $result->transaction->processorResponseText);
} else {
    print_r("Validation errors: \n");
    print_r($result->errors->deepAll());
}
*/
?>