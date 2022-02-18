<?php

namespace duels\commands;

use duels\config\MessagesConfig;
use duels\form\FormManager;
use duels\Main;
use duels\queue\QueueInstance;
use duels\queue\QueueManager;
use duels\request\RequestCache;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;

class DesafiarCommand extends Command
{

    private Main $plugin;

    public function __construct(Main $plugin)
    {
        parent::__construct("desafiar", "Desafiar um jogador");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            if (isset($args[0])){

                if ($args[0] == "aceitar") {
                    if (is_null($sender->getInventory()->getContents())){
                    if (RequestCache::hasInList($sender)) {

                        $from = Server::getInstance()->getPlayer(RequestCache::getFromList($sender));

                        $queue = new QueueInstance($from, $sender);

                        if ($from != null) {
                            $queue = new QueueInstance($from, $sender);
                            QueueManager::addToQueue($queue);

                            $sender->sendMessage(MessagesConfig::getMessage("adicionado-na-fila"));
                            $from->sendMessage(MessagesConfig::getMessage("adicionado-na-fila"));
                        }else {

                            $sender->sendMessage("§cO Outro jogador não se encontra mais online");

                        }
                    }
                }
                }

            }else {
                FormManager::selectPlayerForm($sender);
            }
        }
    }

}