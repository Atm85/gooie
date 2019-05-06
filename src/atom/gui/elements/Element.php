<?php

namespace atom\gui\elements;

use JsonSerializable;
use pocketmine\Player;

abstract class Element implements JsonSerializable {
    protected $text = '';

    public function jsonSerialize() {
        return [];
    }

    abstract public function handle($value, Player $player);

    public function getText(): string{
        return $this->text;
    }
}
