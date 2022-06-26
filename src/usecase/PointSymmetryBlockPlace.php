<?php

namespace oirancage\symmetrica\usecase;

use InvalidArgumentException;
use oirancage\symmetrica\transform\LineSymmetryTransform;
use oirancage\symmetrica\transform\PointSymmetryTransform;
use oirancage\symmetrica\utils\SymmetryBlockUtils;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\world\Position;

class PointSymmetryBlockPlace implements SymmetryBlockPlace{
	public function __construct(
		private int $centerX,
		private int $centerZ,
		private bool $shouldAddHalfBlockLength
	){
	}

	public function involve(Position $position, Block $block) : void{
		if(!$position->isValid()){
			throw new InvalidArgumentException("Position is invalid.");
		}

		$world = $position->getWorld();
		$symmetry = new PointSymmetryTransform($position->x, $position->z, $this->centerX, $this->centerZ, $this->shouldAddHalfBlockLength);
		$transformedX = $transformedZ = 0;
		$symmetry->execute($transformedX, $transformedZ);
		$transformedBlock = SymmetryBlockUtils::rotateBlock($block);
		$transformedPosition = new Vector3($transformedX, $position->y, $transformedZ);
		$world->setBlock($transformedPosition, $transformedBlock);
	}
}