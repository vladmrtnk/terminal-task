<?php

namespace App;

use App\Traits\ApiTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class Router
{
    use ApiTrait;

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
            $strErrorDesc = 'Route method is not allowed';
            $this->sendOutput($strErrorDesc, 400);
        } catch (ResourceNotFoundException $e) {
            $strErrorDesc = 'Route does not exists';
            $this->sendOutput($strErrorDesc, 404);
        }
    }
}