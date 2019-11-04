<?php
namespace FaigerSYS\MIE_Protector;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\TextFormat as CLR;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

use pocketmine\block\tile\ItemFrame;
use FaigerSYS\MapImageEngine\item\FilledMap;

class MIE_Protector extends PluginBase implements Listener {

	public function onEnable() {
		$this->getLogger()->info(CLR::GOLD . 'MIE_Protector enabling...');

		$this->getServer()->getPluginManager()->registerEvents($this, $this);

		$this->getLogger()->info(CLR::GOLD . 'MIE_Protector enabled!');
	}

	/**
	 * @priority LOW
	 * @ignoreCancelled
	 */
	public function onClick(PlayerInteractEvent $e) {
		$pos = $e->getBlock()->getPos();
		$frame = $pos->getWorld()->getTile($pos);
		if ($frame instanceof ItemFrame && $frame->getItem() instanceof FilledMap && !$e->getPlayer()->hasPermission('mapimageengine.bypassprotect')) {
			$e->setCancelled(true);
		}
	}

}
