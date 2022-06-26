<?php

namespace oirancage\symmetrica\command;

use CortexPE\Commando\args\BooleanArgument;
use CortexPE\Commando\args\IntegerArgument;
use CortexPE\Commando\args\StringEnumArgument;
use CortexPE\Commando\BaseSubCommand;
use oirancage\symmetrica\session\SessionStore;
use oirancage\symmetrica\usecase\LineSymmetryBlockPlace;
use oirancage\symmetrica\usecase\PointSymmetryBlockPlace;
use pocketmine\command\CommandSender;
use pocketmine\math\Axis;
use pocketmine\player\Player;

class PointCommand extends BaseSubCommand{

	public function __construct(){
		parent::__construct("point", "point symmetry", ["p"]);
	}

	/**
	 * @inheritDoc
	 */
	protected function prepare() : void{
		$this->setPermission("symmetrica.command.symmetrica");
		$this->registerArgument(0, new IntegerArgument("centerX", false));
		$this->registerArgument(1, new IntegerArgument("centerZ", false));
		$this->registerArgument(2, new BooleanArgument("shouldAddHalfBlockLength", false));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(!$sender instanceof Player){
			$sender->sendMessage("Command is only available in game.");
			return;
		}

		SessionStore::getInstance()->store($sender->getName(), new PointSymmetryBlockPlace($args["centerX"], $args["centerZ"], $args["shouldAddHalfBlockLength"]));
	}
}