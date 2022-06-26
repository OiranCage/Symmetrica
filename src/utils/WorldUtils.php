<?php

namespace oirancage\symmetrica\utils;

use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\world\format\Chunk;
use pocketmine\world\format\SubChunk;
use pocketmine\world\World;

class WorldUtils{
	private function __construct(){
		// Nope.
	}

	public static function setBlockSafely(World $world, Vector3 $position, Block $block) : void{
		$chunkX = $position->x >> SubChunk::COORD_BIT_SIZE;
		$chunkZ = $position->z >> SubChunk::COORD_BIT_SIZE;
		if($world->loadChunk($chunkX, $chunkZ) === null){
			$world->requestChunkPopulation($chunkX, $chunkZ, null)->onCompletion(function(Chunk $chunk) use ($block, $position) : void{
				$chunk->setFullBlock($position->x & SubChunk::COORD_MASK, $position->y, $position->z & SubChunk::COORD_BIT_SIZE, $block->getFullId());
			}, static function() : void{});
			return;
		}
		$world->setBlock($position, $block);
	}
}