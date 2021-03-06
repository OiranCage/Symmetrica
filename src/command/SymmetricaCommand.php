<?php

namespace oirancage\symmetrica\command;

use CortexPE\Commando\args\RawStringArgument;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;

class SymmetricaCommand extends \CortexPE\Commando\BaseCommand{

	public function __construct(Plugin $plugin){
		parent::__construct($plugin, "symmetrica", "symmetrica command", []);
	}

	/**
	 * @inheritDoc
	 */
	protected function prepare() : void{
		$this->setPermission("symmetrica.command.symmetrica");
		$this->registerSubCommand(new LineCommand());
		$this->registerSubCommand(new PointCommand());
		$this->registerSubCommand(new ClearCommand());
	}

	/**
	 * @inheritDoc
	 */
	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$this->sendUsage();
	}
}