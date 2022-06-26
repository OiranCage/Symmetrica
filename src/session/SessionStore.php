<?php

namespace oirancage\symmetrica\session;

use oirancage\symmetrica\usecase\SymmetryBlockPlace;
use pocketmine\utils\SingletonTrait;

class SessionStore{
	use SingletonTrait;

	/** @var array<string, SymmetryBlockPlace> */
	private array $sessions;

	public function find(string $name) : ?SymmetryBlockPlace{
		return $this->sessions[$name] ?? null;
	}

	public function store(string $name, SymmetryBlockPlace $session) : void{
		$this->sessions[$name] = $session;
	}

	public function discard(string $name) : void{
		unset($this->sessions[$name]);
	}
}