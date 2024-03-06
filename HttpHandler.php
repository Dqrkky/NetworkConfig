<?php
class HandleMethod {
    public $config;
    public $functions;

    public function __construct() {
        $this->config = array(
            "method" => strtolower($_SERVER["REQUEST_METHOD"]),
            "path" => isset($_SERVER["PATH_INFO"]) ? $_SERVER["PATH_INFO"] : '/',
            "parameters" => $_GET,
            "body" => file_get_contents("php://input"),
            "headers" => getallheaders(),
            "REQUEST_TIME_FLOAT" => $_SERVER["REQUEST_TIME_FLOAT"],
            "ip" => $this->getIp()
        );
        $this->functions = array();
    }

    public function request(String $url = null) {
        return file_get_contents($url);
    }
    public function ipinfo(String $ip = null) {
        return $this->request("https://ipinfo.io/$ip");
    }
    public function getIp() {
        return array(
            "ipv4" => array(
                "ip" => (isset($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) ? $_SERVER['REMOTE_ADDR'] : null,
                "ipinfo" => (isset($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) ? $this->ipinfo($_SERVER['REMOTE_ADDR']) : null
            ),
            "ipv6" => array(
                "ip" => (isset($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) ? $_SERVER['REMOTE_ADDR'] : null,
                "ipinfo" => (isset($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) ? $this->ipinfo($_SERVER['REMOTE_ADDR']) : null
            )
        );
    }
    public function register($name, $function) {
        $this->functions[$name] = $function;
    }
    public function run() {
        $fun = "on_" . $this->config['method'];
        if (isset($this->functions[$fun]) && is_callable($this->functions[$fun])) {
            return call_user_func($this->functions[$fun], $this->config);
        } else {
            $errorFun = "on_method_error";
            if (isset($this->functions[$errorFun]) && is_callable($this->functions[$errorFun])) {
                return call_user_func($this->functions[$errorFun], $this->config['method']);
            } else {
                return "Method not found: " . $this->config['method'];
            }
        }
    }
}
