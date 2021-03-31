<?php

declare(strict_types=1);

namespace Daguilarm\Belich\App\Http\Middleware;

use Closure;
use Daguilarm\Belich\Facades\Belich;
use Illuminate\Http\Request;

/**
 * @author: https://github.com/nckg/laravel-minify-html
 * It is not integrated as a package due to its simplicity (but it is a real awesome!)
 */
final class MinifyMiddleware
{
    /** @var array<string> */
    private array $htmlFilters = [
        // Remove HTML comments except IE conditions
        '/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s' => '',
        // Remove comments in the form /* */
        // Update from https://manas.tungare.name/software/css-compression-in-php
        '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\'|\")\/\/.*))/' => '',
        // Shorten multiple white spaces
        '/\s{2,}/' => ' ',
        // Remove whitespaces between HTML tags
        '/>\s{2,}</' => '><',
        // Collapse new lines
        '/(\r?\n)/' => '',
        //Close potential hacking attempts
        '/(\.+\/)/' => '',
    ];

    /** @var array<string> */
    private array $htmlSpaces = [
        '{ ' => '{',
        ' }' => '}',
        ' == ' => '==',
        ' === ' => '===',
        ' + ' => '+',
        'for (' => 'for(',
        'if (' => 'if(',
        'while (' => 'while(',
    ];

    /** @var array<string> */
    private array $exceptedActions = [
        'download',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Request
    {
        /** @var Response $response */
        $response = $next($request);

        // If the minify is disabled
        if (! config('belich.minifyHtml.enable')) {
            return $response;
        }

        // If the headers are incorrents
        if (! $this->isHtml($response)) {
            return $response;
        }

        // If the current action is excluded
        if (in_array(Belich::action(), $this->exceptedActions())) {
            return $response;
        }

        //Filter by url path
        if (in_array(trim($request->path(), '/'), config('belich.minifyHtml.except.paths'))) {
            return $response;
        }

        //Minify
        return $response->setContent(
            $this->html($response->getContent())
        );
    }

    /**
     * Filter Controller actions to be excluded from minify
     *
     * @return array<string>
     */
    private function exceptedActions(): array
    {
        return array_merge(
            $this->exceptedActions,
            config('belich.minifyHtml.except.actions')
        );
    }

    /**
     * Check if the header response is text/html.
     */
    private function isHtml(object $response): bool
    {
        $content = $response->headers->get('Content-Type');

        return $content
            ? strtolower(strtok($content, ';')) === 'text/html'
            : false;
    }

    /**
     * Filter the html
     */
    private function html(string $html): string
    {
        $html = preg_replace(array_keys($this->htmlFilters), array_values($this->htmlFilters), $html);

        return str_replace(array_keys($this->htmlSpaces), array_values($this->htmlSpaces), $html);
    }
}
