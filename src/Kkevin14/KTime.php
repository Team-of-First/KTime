<?php
namespace Kkevin14;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

use pocketmine\network\mcpe\protocol\ServerSettingsRequestPacket;
use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;
use pocketmine\network\mcpe\protocol\ServerSettingsResponsePacket;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

use pocketmine\Player;

class KTime extends PluginBase implements Listener{

  public $id = [
    11535263
  ];

  public $title = '§l§eSYSTEM §f|| §e현재시간';

  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  public function onLoad(){
         date_default_timezone_set('Asia/Seoul');
    }

  public function sendUI (Player $player, $code, $data) {
    $packet = new ModalFormRequestPacket();
    $packet->formId = $code;
    $packet->formData = json_encode ($data);
    $player->dataPacket ($packet);
  }

  public function onTouch(PlayerInteractEvent $event){
    $player = $event->getPlayer();
    $item = $event->getItem();
    $date = date("h시 i분 s초 (A)");
    if($item->getId() != 347) return;
    $this->sendUI($player, $this->id[0], [
      'type' => 'form',
      'title' => $this->title,
      'content' => "\n" . '§l§f현재시간 : ' . $date . "\n\n",
      'buttons' => [
        [
          'text' => '§l§f[ §e시계 닫기 §f]'
        ]
      ]
    ]);
  }
}
