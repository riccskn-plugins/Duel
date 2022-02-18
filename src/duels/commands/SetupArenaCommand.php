<?php

namespace duels\commands;

use duels\Main;
use duels\utils\SerializeUtils;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class SetupArenaCommand extends Command
{

    private Main $plugin;

    private array $templete = [];

    public function __construct(Main $plugin)
    {
        parent::__construct("setuparena","Configurar arenas duelos");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player){
            if (isset($args[0])) {
                switch ($args[0]){

                    case "criar":
                        if (isset($args[1])) {
                            $this->templete[$args[1]] = ["spawn-one" => "n.a","spawn-two" => "n.a"];

                            $sender->sendMessage("§e*Agora sete os spawn usando o comando /setuparena setspawn");

                        }
                        break;

                    case "setspawn":
                        if (isset($args[1])) {

                            $name = $args[1];

                            if (isset($this->templete[$name]["spawn-one"])) {

                            if ($this->templete[$name]["spawn-one"] == 'n.a') {

                                $this->templete[$name]["spawn-one"] = SerializeUtils::serialize($sender->getLocation());

                                $sender->sendMessage("§a*Spawn setado com sucesso agora va para a outra posição e ultilize novamente este mesmo comando");

                            } else {

                                $this->templete[$name]["spawn-two"] = SerializeUtils::serialize($sender->getLocation());

                                $old = $this->plugin->getArenas()->getAll();

                                $new = $old[] = $this->templete;

                                $this->plugin->getArenas()->setAll($new);
                                $this->plugin->getArenas()->save();

                                $sender->sendMessage("§a*Todos os spawns setados, a arena foi criada");

                            }

                        }

                        }
                        break;

                }
            }
        }
    }

}