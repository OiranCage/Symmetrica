<?php

namespace oirancage\symmetrica;

use oirancage\symmetrica\session\SessionStore;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;

class EventListener implements Listener{

	/**
	 * @priority HIGH
	 */
	public function onBlockBreak(BlockBreakEvent $event){
		$usecase = SessionStore::getInstance()->find($event->getPlayer()->getName());
		if($usecase === null){
			return;
		}
		$position = $event->getBlock()->getPosition();
		$usecase->involve($position, VanillaBlocks::AIR());
	}

	public function onBlockPlace(BlockPlaceEvent $event){
		$usecase = SessionStore::getInstance()->find($event->getPlayer()->getName());
		if($usecase === null){
			return;
		}
		$block = $event->getBlock();
		$position = $block->getPosition();
		$usecase->involve($position, $block);
	}
}