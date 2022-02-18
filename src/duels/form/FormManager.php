<?php

namespace duels\form;

use duels\config\MessagesConfig;
use duels\Main;
use duels\request\RequestCache;
use pocketmine\Player;
use pocketmine\Server;

class FormManager
{

    public static function selectPlayerForm(Player $player)
    {

        $plugin = Main::getInstance();

        $list = [];
        foreach ($plugin->getServer()->getOnlinePlayers() as $p) {
            $list[] = $p->getName();
        }

        $form = new CustomForm(function (Player $player, $data = null) use(&$list) {

        if (!is_null($data)) {

            $player->sendMessage("Player selecionado: ".$list[$data[1]]);

            $to = Server::getInstance()->getPlayer($list[$data[1]]);

            if ($to != null) {

                $to->sendMessage(str_replace("%player%", $player->getName(), MessagesConfig::getMessage("desafio-recebido")));

                RequestCache::addToList($player, $to);

            }

        }

        });

        $form->setTitle(MessagesConfig::getMessage("form-title"));
        $form->addLabel(MessagesConfig::getMessage("form-content"));

        $form->addDropdown("Selecione um jogador para duelo", $list);

        $form->sendToPlayer($player);

    }


}