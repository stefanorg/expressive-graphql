<?php

namespace App\Action;

use Youshido\GraphQL\Execution\Processor;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GraphQLPageAction
{

    /**
     * @var Processor
     */
    private $processor;

    /**
     * GraphQLAction constructor.
     */
    public function __construct(Processor $processor)
    {
        $this->processor = $processor;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        list($query, $variables) = $this->getPayload($request);

        $this->processor->processPayload($query, $variables);

        $res = $this->processor->getResponseData();

        return new JsonResponse($res);
    }

    private function getPayload(ServerRequestInterface $request)
    {
        $method = $request->getMethod();

        switch ($method) {
            case "GET":
                return $this->fromGet($request);
            case "POST":
                return $this->fromPost($request);
            default:
                return $this->createEmptyResponse();

        }
    }

    private function fromGet(ServerRequestInterface $request)
    {
        $params = $request->getQueryParams();

        $query = isset($params['query']) ? $params['query'] : null;
        $variables = isset($params['variables']) ? $params['variables'] : [];

        $variables = is_string($variables) ? json_decode($variables, true) ?: [] : [];

        return [$query, $variables];

    }

    private function fromPost(ServerRequestInterface $request)
    {
        $content = $request->getBody()->getContents();

        $query = $variables = null;

        if (!empty($content)) {
            if ($request->hasHeader('Content-Type') && ('application/graphql' === $request->getHeader('Content-Type'))) {
                $query = $content;
            } else {
                $params = json_decode($content, true);
                if ($params) {
                    $query = isset($params['query']) ? $params['query'] : $query;
                    if (isset($params['variables'])) {
                        if (is_string($params['variables'])) {
                            $variables = json_decode($params['variables'], true) ?: $variables;
                        } else {
                            $variables = $params['variables'];
                        }
                        $variables = is_array($variables) ? $variables : [];
                    }
                }
            }
        }
        return [$query, $variables];

    }

    private function createEmptyResponse()
    {
        return new JsonResponse([], 200);
    }
}
