<?php

namespace MCPH\InfinitePopup;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use MCPH\InfinitePopup\Tasks\PluginCallbackTask;

class Main extends PluginBase
{
   
   public function onEnable(){
      $this->getServer()->getPluginManager()->registerEvents($this, $this);
      $this->getLogger()->info("InfinitePopup has been enabled.");
      $cfg = $this->getConfig();
      $this->getServer()->getScheduler()->scheduleRepeatingTask(new Tasks\PluginCallbackTask(array($this, "popup")),3); //Callbacktask still works lol
   }
  
   public function onDisable(){
      $this->getLogger()->info("InfinitePopup has been disabled.")
   }
   
   public function popup(){
      //$tn = substr($this->pmsg,(strlen($this->pmsg)-1)); //Other way
      //$tc = substr($this->pmsg,0,(strlen($this->pmsg)-1));
       
      $this->lobby = $cfg->get("world-name");
      $this->pmsg = $cfg->get("popup-message");
      $this->pmc = 0;
       
      $tn = substr($this->pmsg, 1);
      $tc = substr($this->pmsg, 1, 1);
       
      $this->pmsg = $tn.$tc;
       
      foreach($this->getServer()->getOnlinePlayers() as $ppp){
         if($ppp->getLevel() == $this->lobby){
            $ppp->sendPopup(str_repeat(TextFormat::AQUA . "=" . TextFormat::RED . "-", 12) . "\n" . TextFormat::YELLOW . "   " . substr($this->pmsg, 0, 25));
         }
       }
      $this->pmc++;
  }
}

?>
