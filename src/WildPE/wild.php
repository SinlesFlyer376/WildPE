<?php
namespace WildPE;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\level\{Level,Position};
use pocketmine\math\Vector3;
use pocketmine\{Server,Player};
use pocketmine\utils\TextFormat;
use pocketmine\event\entity\EntityDamageEvent;

       class wild extends PluginBase implements  Listener {
          public function onEnable(){
              $this->getLogger()->info(C::AQUA . "Enabled Plugin WildPE by SinlesFlyer");
    }
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $param ) {
		switch(strtolower($cmd->getName())){
			case "wild":
				if($sender->hasPermission("FactionsCore.command.wild")) {
					if($sender instanceof Player) {
						$x = rand(1,350000);
            					$y = rand(1,256);
						$z = rand(1,350000);
						$sender->teleport($sender->getLevel()->getSafeSpawn(new Vector3($x, $y, $z)));
						$sender->sendTip(TF::AQUA . "[Wild] §7You've been teleported somewhere wild!");
						$sender->sendMessage(TF::AQUA . "[Wild] §7teleporting to: X-$x Z-$z");
					}
					else {
						$sender->sendMessage(TF::AQUA . "[Wild] &7Only in-game!");
					}
				}
				else {
					$sender->sendMessage(TF::AQUA . "[Wild] §7You have no permission to use this command!");
				}
				return true;
			break;
		}
	  }
	}
<?
