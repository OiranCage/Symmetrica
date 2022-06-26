<?php

namespace oirancage\symmetrica\transform;

use InvalidArgumentException;
use pocketmine\math\Axis;

class LineSymmetryTransform{

	use SymmetryTransformTrait;

	public function __construct(
		private int $x,
		private int $z,
		private int $axis,
		private int $center,
		private bool $shouldAddHalfBlockLength
	){
		if($axis !== Axis::X && $axis !== Axis::Z){
			throw new InvalidArgumentException("Invalid axis.");
		}
	}

	public function execute(int &$transformedX, int &$transformedZ) : void{
		if($this->axis === Axis::X){
			$transformedX = self::reflection($this->x, $this->center, $this->shouldAddHalfBlockLength);
			$transformedZ = self::identity($this->z);
		}else{
			$transformedX = self::identity($this->x);
			$transformedZ = self::reflection($this->z, $this->center, $this->shouldAddHalfBlockLength);
		}
	}
}