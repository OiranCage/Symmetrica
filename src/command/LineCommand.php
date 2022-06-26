<?php

namespace oirancage\symmetrica\command;

use CortexPE\Commando\args\BooleanArgument;
use CortexPE\Commando\args\IntegerArgument;
use CortexPE\Commando\args\StringEnumArgument;
use CortexPE\Commando\BaseSubCommand;
use oirancage\symmetrica\session\SessionStore;
use oirancage\symmetrica\usecase\LineSymmetryBlockPlace;
use pocketmine\command\CommandSender;
use pocketmine\math\Axis;
use pocketmine\player\Player;

class LineCommand extends BaseSubCommand{

	public function __construct(){
		parent::__construct("line", "line symmetry", ["l"]);
	}

	/**
	 * @inheritDoc
	 */
	protected function prepare() : void{
		$this->registerArgument(0, new class("axis", false) extends StringEnumArgument{
			protected const VALUES = [
				"x" => Axis::X,
				"z" => Axis::Z
			];

			public function parse(string $argument, CommandSender $sender) : int{
				return $this->getValue($argument);
			}

			public function getTypeName() : string{
				return "axis";
			}
		});
		$this->registerArgument(1, new IntegerArgument("center", false));
		$this->registerArgument(2, new BooleanArgument("shouldAddHalfBlockLength", false));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(!$sender instanceof Player){
			$sender->sendMessage("Command is only available in game.");
			return;
		}

		SessionStore::getInstance()->store($sender->getName(), new LineSymmetryBlockPlace($args["axis"], $args["center"], $args["shouldAddHalfBlockLength"]));
	}
}