<?php

namespace oirancage\symmetrica\usecase;

use InvalidArgumentException;
use oirancage\symmetrica\transform\LineSymmetryTransform;
use oirancage\symmetrica\utils\SymmetryBlockUtils;
use oirancage\symmetrica\utils\WorldUtils;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\world\Position;

class LineSymmetryBlockPlace implements SymmetryBlockPlace{
	public function __construct(
		private int $axis,
		private int $center,
		private bool $shouldAddHalfBlockLength
	){
	}

	public function involve(Position $position, Block $block) : void{
		if(!$position->isValid()){
			throw new InvalidArgumentException("Position is invalid.");
		}

		$world = $position->getWorld();
		$symmetry = new LineSymmetryTransform($position->x, $position->z, $this->axis, $this->center, $this->shouldAddHalfBlockLength);
		$transformedX = $transformedZ = 0;
		$symmetry->execute($transformedX, $transformedZ);
		$transformedBlock = SymmetryBlockUtils::mirrorBlock($block, $this->axis);
		$transformedPosition = new Vector3($transformedX, $position->y, $transformedZ);
		WorldUtils::setBlockSafely($world, $transformedPosition, $transformedBlock);
	}
}