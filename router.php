<?php
class Router {
    private $config = array();
    public function __construct($ip = null) {
        $this->config = array();
        $this->config["ip"] = (isset($ip) && is_string($ip)) ? $ip : null;
    }
    public function getIp() {
        return json_encode(
            array(
                "ip"=>$this->config["ip"]
            )
        );
    }
}
?>