<?php

namespace duels\listeners;

use duels\events\JoinArenaEvent;
use duels\Main;
use duels\session\SessionManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener
{

    private Main $plugin;

   public function __construct(Main $plugin)
   {

       $this->plugin = $plugin;

   }

    public function onJoin(PlayerJoinEvent $event)
    {

        $player = $event->getPlayer();

        SessionManager::createSession($player);

   }

    public function onQuit(PlayerQuitEvent $event)
    {

        $player = $event->getPlayer();

        SessionManager::deleteSession($player);

   }

    public function onJoinArena(JoinArenaEvent $event)
    {



   }

}