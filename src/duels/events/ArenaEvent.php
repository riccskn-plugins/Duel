<?php

namespace duels\events;

use duels\game\GameArena;
use pocketmine\event\Event;

abstract class ArenaEvent extends Event
{

    private GameArena $gameArena;

    public function __construct(GameArena $gameArena)
    {
        $this->gameArena = $gameArena;
    }

    /**
     * @return GameArena
     */
    public function getGameArena(): GameArena
    {
        return $this->gameArena;
    }

}