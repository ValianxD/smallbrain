<?php
include_once 'Class/agent.class.php';

class ViewCarController {
    private $agent;

    public function __construct() {
        $this->agent = new Agent();
    }

    public function getCarsByAgent($agent_name) {
        return $this->agent->getCarsByAgentName($agent_name);
    }
}
?>
