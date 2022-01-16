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
     * Render a view file
     *
     * @param string $view The view file
     * @param array $args
     *
     * @return void
     */
    public static function render(string $view, $args = []): void
    {
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view"; //relative to Core directory

        if (!is_readable($file)) {
            echo "$file not found";
            return;
        }
        require $file;
    }

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
            $twig = new Environment($loader);
        }
        echo $twig->render($template, $args);
    }
}