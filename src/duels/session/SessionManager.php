<?php

namespace duels\session;

use pocketmine\Player;

class SessionManager
{

    private static array $sessions = [];

    public static function createSession(Player $player)
    {

        self::$sessions[$player->getUniqueId()->toString()] = new Session($player);

    }

    public static function getSession(Player $player)
    {

        if (!isset(self::$sessions[$player->getUniqueId()->toString()])) {

            self::createSession($player);

        }

        return self::$sessions[$player->getUniqueId()->toString()];
        
    }

    public static function deleteSession(Player $player)
    {

        unset(self::$sessions[$player->getUniqueId()->toString()]);

    }

}