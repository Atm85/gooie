<?php

namespace atom\gui\type;

use atom\gui\elements\Button;
use pocketmine\Player;

class SimpleGui extends Type{

    protected $title = '';
    protected $content = '';
    protected $buttons = [];

    public function __construct() {
        parent::__construct();
    }

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function setContent(string $content) {
        $this->content = $content;
    }

    public function addButton(string $text){
        $button = new Button($text);
        $this->buttons[] = $button;
    }

    public function jsonSerialize() {
        $data = [
            'type' => 'form',
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => []
        ];
        foreach ($this->buttons as $button) {
            $data['buttons'][] = $button;
        }
        return $data;
    }

    public function handleResponse(Player $player, $data): void{
        if (!is_numeric($data)) {
//            $this->close($player);
            return;
        }
        $return = "";
        if (isset($this->buttons[$data])) {
            if (!is_null($value = $this->buttons[$data]->handle($data, $player))) $return = $value;
        } else {
            error_log(__CLASS__ . '::' . __METHOD__ . " Button with index {$data} doesn't exists.");
        }
        $callable = $this->getCallback();
        if ($callable !== null) {
            $callable($player, $return);
        }
    }
}
