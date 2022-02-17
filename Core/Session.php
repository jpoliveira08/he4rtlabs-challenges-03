<?php

declare(strict_types=1);

namespace Core;

class Session
{
    protected const FLASH_KEY = 'flash_messages';

    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? []; 
        foreach ($flashMessages as $key => $flashMessage) {
            //Mark to be removed
            $flashMessage['remove'] = true;
        }
    }

    public function __destruct()
    {
        //Iterate over marked to be removed flashMessages
    }

    public function setFlash(string $key, string $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash(string $key)
    {

    }

}