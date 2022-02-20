<?php

namespace Core;

/**
 * Base controller
 */
abstract class Controller
{
    /** @var array $route_params contains parameters from the matched route */
    protected $route_params = [];
    protected Session $session;
    /**
     * Class constructor
     *
     * @param [type] $route_params Parameters from the route
     * 
     */
    public function __construct(array $route_params)
    {
        $this->route_params = $route_params;
        $this->session = new Session();
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param string $name  Method name
     * @param array $args Arguments passed to the method
     *
     * @return void
     */
    public function __call(string $name, array $args): void
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     * Before filter - called before an action method.
     *
     * @return void
     */
    protected function before(): void
    {
    }

    /**
     * After filter - called after an action method.
     *
     * @return void
     */
    protected function after(): void
    {
    }
}