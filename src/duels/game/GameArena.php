<?php

namespace duels\game;

use duels\events\WinArenaEvent;
use duels\game\enums\GameStateEnums;
use duels\Main;
use duels\queue\QueueManager;
use pocketmine\Player;
use pocketmine\Server;

class GameArena
{
    private Main $plugin;

    private string $name;

    private int $gameState = GameStateEnums::SEARCHING_QUEUE;

    private array $players = [];

    private int $tick;
    private int $countdown;
    private int $maxTime;

    public function __construct(Main $plugin,string $name,int $tick, int $countdown, int $maxTime)
    {

        $this->plugin = $plugin;

        $this->name = $name;
        $this->tick = $tick;
        $this->countdown = $countdown;
        $this->maxTime = $maxTime;
        
    }

    public function tick()
    {

        switch ($this->getGameState()) {

            case GameStateEnums::SEARCHING_QUEUE:

                if (empty($this->players)) {

                    if (!empty(QueueManager::getQueues())) {

                       $queue = QueueManager::getFirst();

                       $this->gameState = GameStateEnums::STARTING;

                       $this->joinPlayer($queue->getPlayerOne());
                       $this->joinPlayer($queue->getPlayerTwo());

                    }

                    $this->tick = $this->countdown;
                }
                break;

            case GameStateEnums::STARTING:

                $this->tick--;

                if ($this->tick <= 5) {


                }

                if ($this->tick == 0) {

                    $this->gameState = GameStateEnums::RUNNING;
                    $this->tick = $this->maxTime;

                }

                break;

            case GameStateEnums::RUNNING:

                $this->tick--;

                if ($this->tick == 0) {



                }

        }

    }

    public function joinPlayer(Player $player)
    {

        $this->players[] = $player->getName();

    }

    public function stopArena()
    {

        $this->gameState = GameStateEnums::SEARCHING_QUEUE;
        $this->players = [];

    }

    /**
     * @return int
     */
    public function getGameState():int
    {
        return $this->gameState;
    }

    public function getPlayers()
    {

        $players = [];

        foreach ($this->players as $nick) {

            $p = Server::getInstance()->getPlayer($nick);

            if ($p != null){

                $players[] = $p;

            }

        }

        return $players;

    }

}