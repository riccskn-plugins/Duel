<?php
namespace duels\request;


use pocketmine\Player;

class RequestCache
{

    private static array $requests = [];

    public static function addToList(Player $from, Player $to)
    {

        self::$requests[$to->getName()] = $from->getName();

    }

    public static function hasInList(Player $player)
    {

        return isset(self::$requests[$player->getName()]);

    }

    public static function getFromList(Player $player)
    {

      return  self::$requests[$player->getName()];

    }

}