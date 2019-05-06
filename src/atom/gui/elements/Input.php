<?php

namespace atom\gui\elements;

use pocketmine\Player;

class Input extends Element {

    protected $placeholder = '';
    protected $defaultText = '';

    public function __construct(string $text, string $placeholder, string $defaultText = '') {
        $this->text = $text;
        $this->placeholder = $placeholder;
        $this->defaultText = $defaultText;
    }

    public function jsonSerialize() {
        return [
            "type" => "input",
            "text" => $this->text,
            "placeholder" => $this->placeholder,
            "default" => $this->defaultText
        ];
    }

    public function handle($value, Player $player) {
        return $value;
    }
}
