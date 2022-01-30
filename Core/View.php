<?php

namespace Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * View
 */
class View
{
    /**
     * Render a view template using Twig
     *
     * @param string $template The template file
     * @param array $args Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function renderTemplate(string $template, array $args = []): void
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new FilesystemLoader(dirname(__DIR__) . '/App/Views');
            //$twig = new Environment($loader);
            //Just for debug
            $twig = new Environment($loader, ['debug' => true]);
            //Just for debug
            $twig->addExtension(new \Twig\Extension\DebugExtension());
        }
        echo $twig->render($template, $args);
    }
}