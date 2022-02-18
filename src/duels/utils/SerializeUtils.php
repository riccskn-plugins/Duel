<?php

namespace duels\utils;

use pocketmine\level\Location;

class SerializeUtils
{

    public static function serialize(Location $location):string
    {

        return $location->getFloorX().":".$location->getFloorY().":".$location->getFloorZ().":".$location->getYaw().":".$location->getPitch().":".$location->getLevel()->getName();
        
    }

    public static function deserialize(string $data):Location
    {

        $trim = explode(":", $data);

        return new Location($trim[0],$trim[1],$trim[2],$trim[3],$trim[4]);

    }

}