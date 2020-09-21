<?php

namespace matsuo\NGWordBAN;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class main extends PluginBase implements Listener {
  public function onEnable() {
    $this->getLogger()->notice('読み込まれました');
    $this->config = $this->getConfig();
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }

  
  public function onChat(PlayerChatEvent $event) {
    $message = $event->getMessage();
    $ngwords = $this->config->get('NGWord');
    $player = $event->getPlayer();
    $playername=$player->getName();
    $blacklist = $this->config->get('Blacklist');
    $foundwords = [];
    $blacklist = $this->config->get('Blacklist', []); // 存在しないときは空の配列を代入
    foreach ($ngwords as $value) { // なるべくループ内で多くの処理をしない
      //if (preg_match('{' . $value . '}', $message)) { 使わない
      if (strpos($message, $value) !== false) { // この方が処理は軽い
          $foundwords[] = $value;
      }
    }
    if (!empty($foundwords)) { // 1つでも見つかってたとき
      if (in_array($playername, $blacklist)) {

        // 2回目
        $player->setBanned('NGWord:' . implode(', ', $foundwords));
        unset($blacklist[array_search($playername, $blacklist)]);
        $blacklist = array_values($blacklist);
      } else {
        // 1回目
        $blacklist[] = $playername; // クォーテーションで囲む必要ないですよ
      }
      // 変更した $blacklist をセット
      $this->config->set('Blacklist', $blacklist);
      $this->config->save();
    }
  }

  
  public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
    switch($command->getName()) {
      case 'ngword':
        if(isset($args[0])) {
          $ngwlist = $this->config->get('NGWord');
          $ngwlist[] = $args[0];
          $this->config->set('NGWord', $ngwlist);
          $this->config->save();
          $sender->sendMessage($args[0] . "をNGワードに登録しました！");
          return true;
        }
      default:
        return false;
    }
  }

}

