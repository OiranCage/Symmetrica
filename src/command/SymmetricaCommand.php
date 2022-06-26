<?php

namespace oirancage\symmetrica\command;

use pocketmine\command\CommandSender;

class SymmetricaCommand extends \CortexPE\Commando\BaseCommand{

	/**
	 * @inheritDoc
	 */
	protected function prepare() : void{
		$this->setPermission("symmetrica.command.symmetrica");
		$this->registerSubCommand(new LineCommand());
		$this->registerSubCommand(new PointCommand());
	}

	/**
	 * @inheritDoc
	 */
	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$this->sendUsage();
	}
}