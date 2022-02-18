<?php

namespace duels\config;

use duels\Main;

class ArenaSettingsConfig
{

    public static function getSetting($key)
    {

       return Main::getInstance()->getArenaPrefs()->get("arena")[$key];

    }

}