<?php namespace WildPE;

use pocketmine\plugin\PluginBase;

use pocketmine\command\{
	Command,
	CommandSender
};

use pocketmine\math\Vector3;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\entity\EntityDamageEvent;

class wild extends PluginBase implements  Listener {
	
	public $immune = [];
	
	public function onEnable(){
		$this->getLogger()->info(TF::AQUA . "[WildPE] Enabled!");
	}

	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
		switch(strtolower($cmd->getName())){
			case "wild":
				if($sender instanceof Player) {
					$x = mt_rand(-75000,75000);
            				$y = 128; //Todo: safe spawning
					$z = mt_rand(-75000,75000);
					$this->immune[$p->getName()] = time();
					$sender->teleport($sender->getLevel()->getSafeSpawn(new Vector3($x, $y, $z)));
					$sender->sendTip(TF::AQUA . "[Wild]" . TF::GRAY . " You've been teleported somewhere random!");
					$sender->sendMessage(TF::AQUA . "[Wild]" . TF::GRAY . " Teleporting to: X-" . $x . " Z-" . $z);
				} else {
					$sender->sendMessage(TF::AQUA . "[Wild]" . TF::GRAY . " Only in-game!");
				}
			break;
		}
	}
	
	public function onDmg(EntityDamageEvent $e) {
		$p = $e->getEntity();
		$cause = $e->getCause();
		if($p instanceof Player) {
			if($cause == EntityDamageEvent::CAUSE_FALL && isset($this->immune[$p->getName()])) {
				$e->setCancelled(true); //Cancels fall damage after wild teleporting
				unset($this->immune[$p->getName()]);
				return;
			}
		}
	}
	
	public function onQuit(PlayerQuitEvent $e){
		if(isset($this->immune[$p->getName()])) unset($this->immune[$p->getName()]);
	}
}
