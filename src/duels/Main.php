<?php

namespace duels;

use duels\commands\DesafiarCommand;
use duels\commands\SetupArenaCommand;
use duels\tasks\ArenaHeartbeat;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase
{

    private static ?Main $instance = null;

    private Config $arenas;
    private ArenaManager $arenaManager;
    private Config $arenaPrefs;

    public function onEnable()
    {

        self::$instance = $this;

        $this->saveResource("arena_preferences.yml");

        $this->arenas = new Config($this->getDataFolder()."arenas.json", Config::JSON);
        $this->arenaPrefs = new Config($this->getDataFolder()."arena_preferences.yml", Config::YAML);

        $this->arenaManager = new ArenaManager($this);

        $this->registerTasks();
        $this->registerCommands();

    }

    /**
     * @return Config
     */
    public function getArenaPrefs(): Config
    {
        return $this->arenaPrefs;
    }

    private function registerCommands():void
    {

        $this->getServer()->getCommandMap()->registerAll("desafiar", [
          new DesafiarCommand($this),
          new SetupArenaCommand($this)
        ]);

    }

    private function registerTasks():void
    {

        $this->getScheduler()->scheduleRepeatingTask(new ArenaHeartbeat($this), 20);

    }

    /**
     * @return ArenaManager
     */
    public function getArenaManager(): ArenaManager
    {
        return $this->arenaManager;
    }

    /**
     * @return Config
     */
    public function getArenas(): Config
    {
        return $this->arenas;
    }

    /**
     * @return Main|null
     */
    public static function getInstance(): ?Main
    {
        return self::$instance;
    }

}