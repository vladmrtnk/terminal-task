<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class Router
{
    /**
     * @param  RouteCollection  $routes
     *
     * @return void
     */
    public function __invoke(RouteCollection $routes): void
    {
        session_start();
        $request = Request::createFromGlobals();
        $context = (new RequestContext())->fromRequest($request);

        $matcher = new UrlMatcher($routes, $context);
        try {
            $parameters = $matcher->match($request->getPathInfo());

            call_user_func([$parameters[0], $parameters[1]], end($parameters));

        } catch (MethodNotAllowedException $e) {
            echo 'Route method is not allowed.';
        } catch (ResourceNotFoundException $e) {
            echo 'Route does not exists.';
        }
    }
}