<?php
include_once 'Class/buyer.class.php';

class FeedbackController {
    private $buyer;

    public function __construct() {
        $this->buyer = new Buyer();
    }

    public function getAgentNames() {
        return $this->buyer->getAllAgentNames();
    }

    public function submitFeedback($usertype, $rating, $review, $agent_name) {
        return $this->buyer->saveFeedback($usertype, $rating, $review, $agent_name);
    }
}
?>
