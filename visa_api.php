<!-- Visa apis -->
<?php
// Visa API
class VisaPaymentRequest {
    private $amount;
    private $currency;
    private $cardDetails;
    
    public function setAmount($amount) {
        $this->amount = $amount;
    }
    
    public function setCurrency($currency) {
        $this->currency = $currency;
    }
    
    public function setCardDetails($cardDetails) {
        $this->cardDetails = $cardDetails;
    }
    
    public function send() {
        // Send the payment request to Visa API
        // For demonstration purposes, we will just return a random response
        $response = new VisaPaymentResponse();
        $response->setTransactionId(rand(1000, 9999));
        $response->setSuccessful(rand(0, 1) == 1);
        $response->setErrorMessage('Payment failed: Insufficient funds');
        return $response;
    }
}

class VisaPaymentResponse {
    private $transactionId;
    private $successful;
    private $errorMessage;
    
    public function setTransactionId($transactionId) {
        $this->transactionId = $transactionId;
    }
    
    public function getTransactionId() {
        return $this->transactionId;
    }
    
    public function setSuccessful($successful) {
        $this->successful = $successful;
    }
    
    public function isSuccessful() {
        return $this->successful;
    }
    
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
    }
    
    public function getErrorMessage() {
        return $this->errorMessage;
    }
}
?>
<!-- End of Visa apis -->

