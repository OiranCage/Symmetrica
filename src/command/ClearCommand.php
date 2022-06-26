<?php

namespace oirancage\symmetrica\command;

use CortexPE\Commando\BaseSubCommand;
use oirancage\symmetrica\session\SessionStore;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class ClearCommand extends BaseSubCommand{

	public function __construct(){
		parent::__construct("clear", );
	}

	protected function prepare() : void{
		$this->setPermission("symmetrica.command.symmetrica");
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(!$sender instanceof Player){
			$sender->sendMessage("Command is only available in game.");
			return;
		}
		SessionStore::getInstance()->discard($sender->getName());
	}
}