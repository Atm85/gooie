<?php

namespace atom\gui\type;

use pocketmine\Player;

class ModalGui extends Type {

    protected $title = '';
    protected $content = '';
    protected $trueButtonText = '';
    protected $falseButtonText = '';

    public function __construct() {
        parent::__construct();
    }

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function setContent(string $content) {
        $this->content = $content;
    }

    public function setButton1(string $true) {
        $this->trueButtonText = $true;
    }

    public function setButton2(string $false) {
        $this->falseButtonText = $false;
    }

    public function jsonSerialize() {
        return [
            'type' => 'modal',
            'title' => $this->title,
            'content' => $this->content,
            'button1' => $this->trueButtonText,
            'button2' => $this->falseButtonText,
        ];
    }

    public function handleResponse(Player $player, $data): void{
        $callable = $this->getCallback();
        if ($callable !== null) {
            $callable($player, boolval($data));
        }
    }
}