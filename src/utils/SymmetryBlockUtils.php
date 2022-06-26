<?php

namespace oirancage\symmetrica\utils;

use LogicException;
use pocketmine\block\Block;
use pocketmine\math\Axis;
use pocketmine\math\Facing;

class SymmetryBlockUtils{
	private function __construct(){
		// Nope.
	}

	public static function rotateBlock(Block $block) : Block{
		if(method_exists($block, "getFacing") && method_exists($block, "setFacing")){
			$facing = $block->getFacing();
			if($facing === Facing::UP || $facing === Facing::DOWN){
				return $block;
			}
			$block->setFacing(Facing::rotateY(Facing::rotateY($facing, true), true));
		}
		return $block;
	}

	public static function mirrorBlock(Block $block, int $axis) : Block{
		if(method_exists($block, "getFacing") && method_exists($block, "setFacing")){
			$facing = $block->getFacing();
			$facing ^= match ($axis){
				Axis::X => ($facing & Facing::WEST) === Facing::WEST,
				Axis::Z => ($facing & Facing::NORTH) === Facing::NORTH,
				default => throw new LogicException("invalid axis")
			};
			$block->setFacing($facing);
		}
		return $block;
	}
}