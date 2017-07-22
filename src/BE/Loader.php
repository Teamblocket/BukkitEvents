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
	public function onTransaction(InventoryTransactionEvent $event){
        $transactions = $event->getTransaction()->getTransactions();
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
						break 2;
					}
				}
			}
		}
        
        $this->getServer()->getPluginManager()->callEvent($ev = new InventoryClickEvent($chestinv, $player, $action->getSlot(), $action->getItem($action->getSlot())));
    }
}
