<?php

namespace matsuo\NGWordBAN;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\Config;
use pocketmine\Server;

class main extends PluginBase implements Listener{
  public function onEnable(){
    $this->getLogger()->notice("読み込まれました")
  }

}
