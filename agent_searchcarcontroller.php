<?php
include_once 'Class/agent.class.php';

class AgentSearchCarController {
    private $agent;

    public function __construct() {
        $this->agent = new Agent();
    }

    // Method to search for cars based on agent's name and search criteria
    public function searchCars($agent_name, $make, $model, $minPrice, $maxPrice) {
        return $this->agent->searchAgentCars($agent_name, $make, $model, $minPrice, $maxPrice);
    }
}
?>
