<?php

namespace Phantom\Core;

class Response
{
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;

    public function cookie(string $name, string $value): void
    {
        $_COOKIE[$name] = $value;
    }
    public function redirect(string $url): void
    {
        header("Location: $url");
    }

    public function setStatusCode(int $code): void
    {
        http_response_code($code);
    }

    public function render(string $view, array $params = [], string $layout = 'base', string $ext='php'): void
    {
        extract($params);

        $layout = $this->obRender("layouts/$layout", $params, $ext);
        $content = $this->obRender($view, $params, $ext);

        echo str_replace('{{CONTENT}}', $content, $layout);
    }

    private function obRender(string $path, array $params, string $ext): string
    {
        extract($params);

        ob_start();

        include BASE_PATH . "views/$path.$ext";

        return ob_get_clean();
    }

    public function send(mixed $data): void
    {
        echo $data;
    }

    public function end(mixed $data): void
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
}