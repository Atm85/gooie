<?php

namespace atom\gui\elements;

use pocketmine\Player;

class Label extends Element {

    public function __construct($text) {
        $this->text = $text;
    }


    public function jsonSerialize() {
        return [
            "type" => "label",
            "text" => $this->text
        ];
    }

    public function handle($value, Player $player) {
        return $this->text;
    }
}
