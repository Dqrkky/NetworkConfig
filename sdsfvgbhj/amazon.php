<?php

class Amazon {
    private $config = array();
    public function __construct($id=null, $secert=null) {
        $this->config["id"] = (isset($id) && is_string($id)) ? $id : null;
        $this->config["secret"] = (isset($secert) && is_string($secert)) ? $secert : null;
    }
    publiC function construct(String $url = null, array $params = null) {
        return $url . "?" . http_build_query($params);
    }

    public function code($redirect_uri=null, $scopes=null) {
        if (isset($redirect_uri) && is_string($redirect_uri) && isset($scopes) && is_array($scopes)) {
            $config = array(
                "url" => "https://www.amazon.com/ap/oa",
                "params" => array(
                    "client_id" => $this->config["id"],
                    "response_type" => "code",
                    "redirect_uri" => $redirect_uri,
                    "scope" => implode(" ", $scopes)
                )
            );
            return $this->construct(
                $url=$config["url"],
                $params=$config["params"]
            );
        } else {
            return null;
        }
    }
}
?>
