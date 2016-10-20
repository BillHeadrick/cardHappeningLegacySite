

<?php

require_once 'lib/Braintree.php';
Braintree_Configuration::environment('production');
Braintree_Configuration::merchantId('n3hkbjcxdj8hw3vy');
Braintree_Configuration::publicKey('46668f4dqynptqp4');
Braintree_Configuration::privateKey('1ce8964476480a8d0ac9435ef78256b7');
$clientToken = Braintree_ClientToken::generate();
//echo $clientToken;
echo "<script type='text/javascript'>
		$(function(){
			braintree.setup('$clientToken', 'dropin', {
				container: 'dropin'
			});
		})
		</script>
";


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