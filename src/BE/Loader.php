<?php

namespace BE;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\event\inventory\InventoryTransactionEvent;
use BE\inventory\event\InventoryClickEvent;
use pocketmine\inventory\Inventory;
use pocketmine\inventory\SimpleTransactionQueue;

use pocketmine\inventory\ContainerInventory;
use pocketmine\inventory\PlayerInventory;

use pocketmine\Player;
use pocketmine\Server;

class Loader extends PluginBase implements Listener{

    public static $instance;

    public static function getInstance(){
        return self::$instance;
    }

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
	public function onTransaction(InventoryTransactionEvent $event){ // Credit to Muqsit i didnt make this code! 
        $transactions = $event->getTransaction()->getTransactions();     // REPO: https://github.com/Muqsit/ChestShop/blob/master/src/ChestShop/EventListener.php#L57
		$player = null;
		$chestinv = null;
		$action = null;
		foreach($transactions as $transaction){
			if(($inv = $transaction->getInventory()) instanceof Inventory){
				foreach($inv->getViewers() as $assumed){
					if($assumed instanceof Player){
						$player = $assumed;
						$chestinv = $inv;
						$action = $transaction;
						$ev = new InventoryClickEvent($chestinv, $player, $action->getTargetItem());
						break 2;
					}
				}
			}
			if(($player ?? $chestinv ?? $action) === null){
				return;
			}
			if($acyion->getTargetItem() !== null){
				$this->getServer()->getPluginManager()->callEvent($ev);
			}
			if($event->isCancelled()){
				$ev->setCancelled(true);
			}
		}
	}
	
	public function click(InventoryClickEvent $ev){
		if($ev->getInventory() instanceof ChestInventory){
			if($ev->getItem()->getId() == 102){
				$ev->setCancelled(true);
				$ev->getPLayer()->sendMessage("Working");
			}
		}
	}
}
