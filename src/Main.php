<?php

namespace oirancage\symmetrica;

use CortexPE\Commando\PacketHooker;
use oirancage\symmetrica\command\SymmetricaCommand;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{
	protected function onEnable() : void{
		PacketHooker::register($this);
		$this->getServer()->getCommandMap()->registerAll("symmetrica", [
			new SymmetricaCommand($this)
		]);
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
	}
}