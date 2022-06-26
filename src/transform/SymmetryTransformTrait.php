<?php

namespace oirancage\symmetrica\transform;

trait SymmetryTransformTrait{
	private static function reflection(int $a, int $center, bool $shouldAddHalfBlockLength) : int{
		return $center * 2 + ($shouldAddHalfBlockLength ? 1 : 0) - $a;
	}

	private static function identity(int $a) : int{
		return $a;
	}
}