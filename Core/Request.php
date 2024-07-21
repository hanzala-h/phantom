<?php

namespace Phantom\Core;

class Request
{
    public string $uri;
    public string $method;
    public string $path;
    public string $queryString;
    public array $body;

    public function __construct()
    {
        $this->uri = $this->getUri();
        $this->method = $this->getMethod();
        $this->path = $this->getPath();
        $this->queryString = $this->getQueryString();
        $this->body = $this->getBody();
    }

    public function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getMethod(): string
    {
        return $_POST['__request_method'] ?? $_SERVER['REQUEST_METHOD'];
    }

    public function isGet(): bool
    {
        return $this->method === 'GET';
    }

    public function isPost(): bool
    {
        return $this->method === 'POST';
    }

    public function isPut(): bool
    {
        return $this->method === 'PUT';
    }

    public function isDelete(): bool
    {
        return $this->method === 'DELETE';
    }

    public function isPatch(): bool
    {
        return $this->method === 'PATCH';
    }

    public function getPath(): string
    {
        return parse_url($this->uri, PHP_URL_PATH);
    }

    public function getQueryString(): string
    {
        return parse_url($this->uri, PHP_URL_QUERY) ?? '';
    }

    public function getBody(): array{
        $body = [];

        $params = $this->isGet() ? $_GET : $_POST;
        $input = $this->isGet() ? INPUT_GET : INPUT_POST;

        foreach ($params as $key => $value) {
            $body[$key] = filter_input($input, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }


        return $body;
    }

}