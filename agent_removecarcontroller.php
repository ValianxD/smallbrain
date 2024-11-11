<?php
include_once 'Class/agent.class.php';

class RemoveCarController {
    private $agent;

    public function __construct() {
        $this->agent = new Agent();
    }

    // Fetch all cars listed by the agent for deletion
    public function getDeleteAgentCars($agent_name) {
        return $this->agent->getDeleteAgentCars($agent_name);
    }

    // Remove car from both databases
    public function removeCar($carId) {
        return $this->agent->deleteCarListing($carId);
    }
}
?>