<?php

namespace Cisco\Shadow\dotenv;

class Env {
    private $envVars;
    public function __construct(string $file= "../env.json") {
        $this->envVars = file_get_contents($file);
        $arr = json_decode($this->envVars);
        foreach ($arr as $key => $value) {
            $_ENV[$key] = $value;
        }
    }

}