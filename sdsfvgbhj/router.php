<?php
class Router {
    private $config = array();
    public function __construct($host = null) {
        $this->config = array(
            "host" => (isset($host) && is_string($host)) ? $host : null
        );
    }
    public function getIp() {
        return array(
            "host" => isset($this->config["host"]) ? $this->config["host"] : null
        );
    }
    public function getDevices() {
        $config = array();
        for ($i=0; $i<5; $i++) {
            $config[] = array(
                "id" => $i,
                "name"=> "",
                "mac"=> "",
                "ip_address"=> ""
            );
        };
        return $config;
    }
}
