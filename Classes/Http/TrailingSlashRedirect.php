<?php

namespace StudioMitte\Redirect2trailingslash\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Core\Site\Entity\NullSite;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class TrailingSlashRedirect implements MiddlewareInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $site = $request->getAttribute('site', null);
        if ($site && !$site instanceof NullSite) {
            $path = $request->getUri()->getPath();
            $pathInfo = pathinfo($path);
            if (!isset($pathInfo['extension']) && $path !== '/' && !\str_ends_with($path, '/')) {
                $path .= '/';
                $redirectUri = $request->getUri()->withPath($path);
                return new RedirectResponse(
                    $redirectUri,
                    $this->getStatusCode(),
                    [
                        'X-Redirect-By' => 'TYPO3 Redirect2TrailingSlash Redirect'
                    ]
                );
            }
        }
        return $handler->handle($request);
    }

    private function getStatusCode(): int
    {
        $statusCode = 0;
        try {
            $statusCode = (int)GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('redirect2trailingslash', 'statusCode');
        } catch (\Exception $e) {
            // do nothing
        }
        if (!$statusCode) {
            $statusCode = 307;
        };

        return $statusCode;
    }
}
