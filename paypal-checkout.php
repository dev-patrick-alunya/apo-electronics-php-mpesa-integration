<?php

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

require 'vendor/autoload.php';


session_start();

$paypal = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AYH6UECMvxqShf9rIjEchnKQX0yag_YJnAHMxdRiiB7iQco63mmZNatA7Ayvm6AWkMW3DVgqPtp7epwX',     // ClientID
        'EF74UjA33lYB5O79iEPWy1iEU0hifkKccPYS9gmBoBVa5moxCM7ng84bY4ny_hQoU9ebBc7tSMVlJYwH'  // ClientSecret
    )
);

if (isset($_POST['pay'])) {
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');

    $amount = new Amount();
    $amount->setTotal('10.00'); // Set the total amount
    $amount->setCurrency('USD');

    $transaction = new Transaction();
    $transaction->setAmount($amount);
    $transaction->setDescription('Payment description');

    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl('http://localhost/apo-electronics-php-mpesa-integration/paypal-success.php')
                 ->setCancelUrl('http://localhost/apo-electronics-php-mpesa-integration/paypal-cancel.php');

    $payment = new Payment();
    $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

    try {
        $payment->create($paypal);
    } catch (Exception $ex) {
        die($ex);
    }

    $approvalUrl = $payment->getApprovalLink();
    header("Location: {$approvalUrl}");
    exit;
}

if (isset($_GET['paymentId']) && isset($_GET['PayerID'])) {
    $paymentId = $_GET['paymentId'];
    $payerId = $_GET['PayerID'];

    $payment = Payment::get($paymentId, $paypal);

    $execution = new PaymentExecution();
    $execution->setPayerId($payerId);

    try {
        $result = $payment->execute($execution, $paypal);
        echo "Payment successful!";
    } catch (Exception $ex) {
        die($ex);
    }
}
?>
<form method="post" action="paypal-checkout.php">
    <button type="submit" name="pay">Pay with PayPal</button>
</form>
