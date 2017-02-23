<?php namespace WildPE;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\{Command,CommandSender};
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player\NoFallDamage;

class wild extends PluginBase implements  Listener {
	
	public function onEnable(){
		$this->getLogger()->info(TF::AQUA . "Enabled Plugin WildPE by SinlesFlyer");
	}

	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
		switch(strtolower($cmd->getName())){
			case "wild":
				if($sender instanceof Player) {
					$x = mt_rand(-75000,75000);
            				$y = rand(70,90);
					$z = mt_rand(-75000,75000);
					$sender->teleport($sender->getLevel()->getSafeSpawn(new Vector3($x, $y, $z)));
					$sender->sendTip(TF::AQUA . "[Wild]" . TF::GRAY . " You've been teleported somewhere random!");
					$sender->sendMessage(TF::AQUA . "[Wild]" . TF::GRAY . " Teleporting to: X-" . $x . " Z-" . $z);
				} else {
					$sender->sendMessage(TF::AQUA . "[Wild]" . TF::GRAY . " Only in-game!");
				}
			break;
		}
	}
}
