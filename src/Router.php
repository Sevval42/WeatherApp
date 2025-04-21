<?php

declare(strict_types=1);

class Router {
    private array $routes;

    public function add(string $path, Closure $closure): void
    {
        $this->routes[$path] = $closure;
    }

    public function detach(string $path): void
    {
        foreach ($this->routes as $route => $handler) {
            $pattern = preg_replace("#\{\w+\}#", "([^\/]+)", $route);
            
            if(preg_match("#^$pattern$#", $path, $matches)) {
                array_shift($matches);
                call_user_func_array($handler, $matches);
                return;
            }
        }
        echo 'ayy papi';
    }


}