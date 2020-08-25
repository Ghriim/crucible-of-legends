<?php

namespace App\Event\Dev;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

final class WrapApiResponseInHtmlEventListener
{
    private bool $wrapApiResponse;

    public function __construct(bool $wrapApiResponse = false)
    {
        $this->wrapApiResponse = $wrapApiResponse;
    }

    public function wrapResponseInHtml(ResponseEvent $event): void
    {
        $request = $event->getRequest();
        $path = $request->getPathInfo();
        if (false === $this->wrapApiResponse
            || 0 !== strpos($path, '/api')
            || Response::HTTP_OK !== $event->getResponse()->getStatusCode()) {
            return;
        }

        if (false === $event->isMasterRequest()) {
            return;
        }

        if (false === $request->headers->has('Accept') || false === strpos($request->headers->get('Accept'), 'text/html')) {
            return;
        }

        $response = $event->getResponse();
        $content = json_encode(json_decode($response->getContent()), JSON_PRETTY_PRINT);
        $response->setContent('<html><body><pre><code>'.htmlspecialchars($content).'</code></pre></body></html>');

        $response->headers->set('Content-Type', 'text/html; charset=UTF-8');
        $request->setRequestFormat('html');
        $event->setResponse($response);
    }
}