<?php
class HandleMethod{
    public $config;
    public $functions;

    public function __construct(String $method = null, array $parameters = null) {
        $this->config = array(
            "method" => strtolower($_SERVER["REQUEST_METHOD"]),
            "path" => isset($_SERVER["PATH_INFO"]) ? $_SERVER["PATH_INFO"] : '/',
            "parameters" => $_GET,
            "body" => file_get_contents("php://input"),
            "headers" => getallheaders(),
            "REQUEST_TIME_FLOAT" => $_SERVER["REQUEST_TIME_FLOAT"],
            "ip" => $_SERVER['REMOTE_ADDR']
        );
        $this->functions = array();
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
