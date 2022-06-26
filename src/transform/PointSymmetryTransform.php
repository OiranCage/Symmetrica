<?php

namespace oirancage\symmetrica\transform;


class PointSymmetryTransform{

	use SymmetryTransformTrait;

	public function __construct(
		private int $x,
		private int $z,
		private int $centerX,
		private int $centerZ,
		private bool $shouldAddHalfBlockLength
	){
	}

	public function execute(int &$transformedX, int &$transformedZ) : void{
		$transformedX = self::reflection($this->x, $this->centerX, $this->shouldAddHalfBlockLength);
		$transformedZ = self::reflection($this->z, $this->centerZ, $this->shouldAddHalfBlockLength);
	}
}