<?php
include_once 'Class/seller.class.php';

class FeedbackController {
    private $seller;

    public function __construct() {
        $this->seller = new Seller();
    }

    public function getAgentNames() {
        return $this->seller->getAllAgentNames();
    }

    public function submitFeedback($usertype, $rating, $review, $agent_name) {
        return $this->seller->saveFeedback($usertype, $rating, $review, $agent_name);
    }
}
?>
