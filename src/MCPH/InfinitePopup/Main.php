<?php

namespace MCPH\InfinitePopup;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\scheduler\CallbackTask;

class Main extends PluginBase
{
   
  public function onEnable(){
        $this->getLogger()->info("InfinitePopup has been enabled.");
        $cfg = $this->getConfig();
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new Tasks\PluginCallbackTask(array($this, "popup")),3); //Callbacktask still works lol

  }
  
  public function onDisable(){
        $this->getLogger()->info("InfinitePopup has been disabled.")

  public function popup(){
       
        //$tn = substr($this->pmsg,(strlen($this->pmsg)-1)); //Other way
        //$tc = substr($this->pmsg,0,(strlen($this->pmsg)-1));
       
        $this->lobby = $this->getServer()->getLevelByName($cfg->get("world-name"));
        $this->pmsg = $cfg->get("popup-message");
        $this->pmc = 0;
       
        $tn = substr($this->pmsg,1);
        $tc = substr($this->pmsg,1,1);
       
        $this->pmsg = $tn.$tc;
       
        foreach($this->getServer()->getOnlinePlayers() as $ppp){
           
            if($ppp->getLevel() == $this->lobby){
           
                $ppp->sendPopup("\n§e   " . substr($this->pmsg,0,25));
           
            }
        }
       
        $this->pmc++;
       
  }
}

?>
