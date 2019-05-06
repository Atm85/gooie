<?php

namespace atom\gui;

use pocketmine\form\Form;
use pocketmine\Player;

class GUI{

    private static $gui = [];

    /**
     * @param string $identifier
     * @param Form $gui
     */
    public static function register(string $identifier, Form $gui) {
        self::$gui[$identifier] = $gui;
    }

    public static function send(Player $player, $gui) {
        $player->sendForm(self::$gui[$gui]);
    }
}
