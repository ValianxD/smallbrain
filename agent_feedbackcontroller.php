<?php
include_once 'Class/agent.class.php';

class AgentFeedbackController {
    private $agent;

    public function __construct() {
        $this->agent = new Agent();
    }

    // Fetch feedback for the agent
    public function getAgentFeedback($agent_name) {
        return $this->agent->getFeedbackByAgentName($agent_name);
    }
}
?>
