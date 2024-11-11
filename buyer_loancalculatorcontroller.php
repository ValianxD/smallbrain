<?php
include_once 'Class/buyer.class.php';

class LoanCalculatorController {
    private $buyer;

    public function __construct() {
        $this->buyer = new Buyer();
    }

    // Retrieve interest rate based on the loan term
    public function getInterestRate($loanTermYears) {
        return $this->buyer->getInterestRate($loanTermYears);
    }

    // Calculate the monthly payment or return error if down payment exceeds price
    public function calculateMonthlyPayment($carPrice, $downPayment, $loanTermYears) {
        if ($downPayment > $carPrice) {
            return "error"; // Return "error" if down payment exceeds car price
        }
        
        $loanAmount = $carPrice - $downPayment;
        $interestRate = $this->getInterestRate($loanTermYears);
        return $this->buyer->calculateMonthlyPayment($loanAmount, $loanTermYears, $interestRate);
    }
}
?>
