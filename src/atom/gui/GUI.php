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

    /**
     * @param string $identifier
     * @param Form $gui
     * @return bool
     */
    public static function gui_exists(string $identifier, Form $gui): bool {
        if (isset($gui, self::$gui[$identifier])) return true;
        return '';
    }

    public static function send(Player $player, $gui) {
        $player->sendForm(self::$gui[$gui]);
    }
}
