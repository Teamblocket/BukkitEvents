<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 14/11/2016
 * Time: 20:15
 */


namespace BE\inventory\event;

use pocketmine\event\Cancellable;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\event\inventory\InventoryEvent;
use pocketmine\inventory\Inventory;

class InventoryClickEvent extends InventoryEvent implements Cancellable{
    public static $handlerList = null;
    
    /** @var Inventory */
    private $inventory;
    
    /** @var Player */
    private $player;

    /** @var Item */
    private $target;

    /**
     * @param Inventory $inventory
     * @param Player    $player
     * @param Item      $target
     */
    public function __construct(Inventory $inventory, Player $player, Item $target){
        $this->inventory = $inventory;
        $this->player = $player;
        $this->target = $item;
        parent::__construct($inventory);
    }

    /**
     * @return Player
     */
    public function getClicker(){
        return $this->player;
    }
    
    /**
     * @return Player
     */
    public function getPlayer(){
        return $this->player;
    }

    /**
     * @return Item
     */
    public function getItem(){
        return $this->target;
    }
    
    /**
     * @return Inventory
     */
    public function getInventory(){
        return $this->inventory;
    }
}
