<?php

namespace duels\events;

use duels\game\GameArena;
use pocketmine\Player;

class WinArenaEvent extends ArenaEvent
{

   private Player $winner;

   public function __construct(GameArena $gameArena,Player $winner)
   {
        parent::__construct($gameArena);
       $this->winner = $winner;

   }

    /**
     * @return Player
     */
    public function getWinner(): Player
    {
        return $this->winner;
    }

}