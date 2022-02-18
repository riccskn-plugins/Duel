<?php

namespace duels\config;

use duels\Main;

class MessagesConfig
{

    public static function getMessage(string $key)
    {

       return Main::getInstance()->getArenaPrefs()->get("mensagens")[$key];
        
    }
    
}