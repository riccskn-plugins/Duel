<?php

namespace duels\tasks;

use duels\Main;
use pocketmine\scheduler\Task;

class ArenaHeartbeat extends Task
{

    private Main $plugin;

    public function __construct(Main $plugin)
    {

        $this->plugin = $plugin;

    }

    public function onRun(int $currentTick)
    {
       $arenas = $this->plugin->getArenaManager()->getArenas();

       foreach ($arenas as $k => $v) {


           $v->tick();

       }

    }
}