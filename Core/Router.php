<?php

namespace Phantom\Core;

use JetBrains\PhpStorm\NoReturn;

class Router
{
    public Request $request;
    public Response $response;

    public array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function resolve(): void
    {
        $url = $this->request->uri;
        $method = $this->request->method;

        foreach ($this->routes as $route) {
            if ($route['url'] === $url && $route['method'] === $method) {
                $callback = $route['callback'];

                if (is_array($callback))
                {
                    $callback[0] = new $callback[0]();
                }

                if (is_callable($callback))
                {
                    $res = call_user_func($callback, $this->request, $this->response);
                    if (is_string($res)){
                        $this->response->send($res);
                    }
                }

                return;
            }
        }

        $this->routeNotFound();
    }

    #[NoReturn]public function routeNotFound(): void
    {
        $this->response->setStatusCode(Response::NOT_FOUND);
        $this->response->render('_404');
        die();
    }

    public function get(string $url, array|callable $callback): void
    {
        $this->add('GET', $url, $callback);
    }

    public function post(string $url, array|callable $callback): void
    {
        $this->add('POST', $url, $callback);
    }

    public function put(string $url, array|callable $callback): void
    {
        $this->add('PUT', $url, $callback);
    }

    public function delete(string $url, array|callable $callback): void
    {
        $this->add('DELETE', $url, $callback);
    }

    public function patch(string $url, array|callable $callback): void
    {
        $this->add('PATCH', $url, $callback);
    }

    protected function add(string $method, string $url, array|callable $callback): void
    {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'callback' => $callback
        ];
    }


}