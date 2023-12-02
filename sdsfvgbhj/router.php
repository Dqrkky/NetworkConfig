<?php
class Router {
    private $config = array();
    public function __construct($ip = null) {
        $this->config["ip"] = (isset($ip) && is_string($ip)) ? $ip : null;
    }
    public function getIp() {
        return json_encode(
            array(
                "ip" => isset($this->config["ip"]) ? $this->config["ip"] : null
            )
        );
    }
    public function devices() {
        $config = array();
        for ($i=0; $i<5; $i++) {
            $config[] = array(
                "id" => $i,
                "name"=> "",
                "mac"=> "",
                "ip_address"=> ""
            );
        };
        return json_encode(
            $config
        );
    }
}

?> 