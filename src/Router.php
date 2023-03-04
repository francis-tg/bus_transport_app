<?php

declare(strict_types=1);

namespace Cisco\Shadow;

class Router
{
    private $handlers;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';
    private $HandlerNotFound;

    public function get(string $path, $handler)
    {
        $this->AddHandler(self::METHOD_GET, $path, $handler);
    }

    public function post(string $path, $handler)
    {
        $this->AddHandler(self::METHOD_POST, $path, $handler);
    }

    public function HandlerNotFound($handler): void
    {
        $this->HandlerNotFound = $handler;
    }

    private function AddHandler(string $method, string $path, $handler): void
    {
        $this->handlers[$method.$path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
        ];
    }

    public function run()
    {
        $request_uri = parse_url($_SERVER['REQUEST_URI']);
        $request_path = $request_uri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;

        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $request_path && $method == $handler['method']) {
                $callback = $handler['handler'];
            }
        }
        if (is_string($callback)) {
            $partition = explode('::', $callback);
            if (is_array($partition)) {
                $classname = array_shift($partition);
                $handler = new $classname();
                $method = array_shift($partition);
                $callback = [$handler, $method];
            }
        }
        if (!$callback) {
            header('HTTP/1.0 404 PAGE NON TROUVEE');
            if (!empty($this->HandlerNotFound)) {
                $callback = $this->HandlerNotFound;
            }
        }

        call_user_func_array($callback, [
            array_merge($_GET, $_POST),
        ]);
        
    }
    static function redirect(string $path="",bool $goback=false){
        if(!$goback){
            return header("Location: " . $path);
        }else {
            return header("Location: " . $_SERVER["HTTP_REFERER"]);

        }
    }
}
