<?php

namespace duels\session;

use duels\game\GameArena;
use pocketmine\Player;

class Session
{

    private Player $player;

    private ?GameArena $arena = null;

    public function __construct(Player $player)
    {
    }

    /**
     * @return GameArena|null
     */
    public function getArena(): ?GameArena
    {
        return $this->arena;
    }

    /**
     * @param GameArena|null $arena
     */
    public function setArena(?GameArena $arena): void
    {
        $this->arena = $arena;
    }

}