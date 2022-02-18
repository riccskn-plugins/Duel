<?php

namespace duels;

use duels\config\ArenaSettingsConfig;
use duels\game\GameArena;
use pocketmine\utils\Config;

class ArenaManager
{

    private Main $plugin;

    private Config $arenaData;

    private $arenas = [];

    public function __construct(Main $plugin)
    {

      $this->plugin = $plugin;
      $this->arenaData = $plugin->getArenas();

      $this->init();

    }

    public function init()
    {

        foreach ($this->arenaData->getAll() as $k => $v) {


            $this->arenas[$k] = new GameArena($this->plugin, $k,0, (int)ArenaSettingsConfig::getSetting("countdown"),(int)ArenaSettingsConfig::getSetting("max-time"));

        }

    }

    /**
     * @return array
     */
    public function getArenas(): array
    {
        return $this->arenas;
    }

}