<?php

namespace oirancage\symmetrica\usecase;

use pocketmine\block\Block;
use pocketmine\world\Position;

interface SymmetryBlockPlace{
	public function involve(Position $position, Block $block) : void;
}