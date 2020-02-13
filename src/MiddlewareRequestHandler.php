<?php

/**
 * Aphiria
 *
 * @link      https://www.aphiria.com
 * @copyright Copyright (C) 2020 David Young
 * @license   https://github.com/aphiria/aphiria/blob/master/LICENSE.md
 */

declare(strict_types=1);

namespace Aphiria\Middleware;

use Aphiria\Net\Http\Handlers\IRequestHandler;
use Aphiria\Net\Http\IHttpRequestMessage;
use Aphiria\Net\Http\IHttpResponseMessage;

/**
 * Defines the middleware request handler
 */
final class MiddlewareRequestHandler implements IRequestHandler
{
    /** @var IMiddleware The middleware that will handle the request */
    private IMiddleware $middleware;
    /** @var IRequestHandler The next request handler */
    private IRequestHandler $next;

    /**
     * @param IMiddleware $middleware The middleware that will handle the request
     * @param IRequestHandler $next The next request handler
     */
    public function __construct(IMiddleware $middleware, IRequestHandler $next)
    {
        $this->middleware = $middleware;
        $this->next = $next;
    }

    /**
     * @inheritdoc
     */
    public function handle(IHttpRequestMessage $request): IHttpResponseMessage
    {
        return $this->middleware->handle($request, $this->next);
    }
}
