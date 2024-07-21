<?php

namespace Phantom\Core;

class Application
{
    public Request $request;
    public Response $response;
    public Router $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function get(string $url, array|callable $callback): void
    {
        $this->router->get($url, $callback);
    }

    public function post(string $url, array|callable $callback): void
    {
        $this->router->post($url, $callback);
    }

    public function put(string $url, array|callable $callback): void
    {
        $this->router->put($url, $callback);
    }

    public function delete(string $url, array|callable $callback): void
    {
        $this->router->delete($url, $callback);
    }

    public function patch(string $url, array|callable $callback): void
    {
        $this->router->patch($url, $callback);
    }

    public function run(): void
    {
        $this->router->resolve();
    }
}