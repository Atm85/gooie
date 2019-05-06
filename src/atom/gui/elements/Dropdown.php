<?php

namespace atom\gui\elements;

use pocketmine\Player;

class Dropdown extends Element {

    protected $options = [];
    protected $defaultOptionIndex = 0;

    public function __construct(string $title, array $options = []) {
        $this->text = $title;
        $this->options = $options;
    }

    public function jsonSerialize() {
        return [
            'type' => 'dropdown',
            'text' => $this->text,
            'options' => $this->options,
            'default' => $this->defaultOptionIndex
        ];
    }

    public function handle($value, Player $player){
        return $this->options[$value];
    }
}
