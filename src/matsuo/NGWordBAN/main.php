<?php

namespace matsuo\NGWordBAN;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class main extends PluginBase implements Listener{
  public function onEnable(){
    $this->getLogger()->notice("読み込まれました");
    $this->config = new config($this->getDataFolder() . "config.yml", Config::YAML);
    $this->config->set("NGWord","");
    $this->config->set("count","");
    $this->config->save();
  }

  public function oncommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
   switch($command->getName()){
     case "ngw":
      $this->config->set("NGWord","$args[0]");
      $player->sendMessage($args[0]."をNGワードに登録しました！");
   }
  }
}
