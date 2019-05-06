<?php

namespace atom\gui\type;

use atom\gui\elements\Dropdown;
use atom\gui\elements\Element;
use atom\gui\elements\Input;
use atom\gui\elements\Label;
use atom\gui\elements\Slider;
use atom\gui\elements\StepSlider;
use atom\gui\elements\Toggle;
use Exception as ExceptionAlias;
use pocketmine\Player;

class CustomGui extends Type{

    protected $title = '';
    protected $elements = [];


    public function __construct() {
        parent::__construct();
    }

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function addElement(Element $element) {
        $this->elements[] = $element;
    }

    public function addDropdown(string $text, array $options) {
        $drop_down = new Dropdown($text, $options);
        $this->elements[] = $drop_down;
    }

    public function addInput(string $text, string $placeholder, string $defaultText = '') {
        $input = new Input($text, $placeholder, $defaultText);
        $this->elements[] = $input;
    }

    public function addLabel(string $text) {
        $label = new Label($text);
        $this->elements[] = $label;
    }

    public function addSlider(string $text, int $min, int $max, float $step = 0.0) {
        $slider = new Slider($text, $min, $max, $step);
        $this->elements[] = $slider;
    }

    public function addStepSlider(string $text, array $steps = []){
        $stepSlider = new StepSlider($text, $steps);
        $this->elements[] = $stepSlider;
    }

    public function addToggle(string $text, bool $value = false) {
        $toggle = new Toggle($text, $value);
        $this->elements[] = $toggle;
    }

    public function jsonSerialize(){
        $data = [
            'type' => 'custom_form',
            'title' => $this->title,
            'content' => []
        ];
        foreach ($this->elements as $element) {
            $data['content'][] = $element;
        }
        return $data;
    }

    public function handleResponse(Player $player, $data): void{
        if (empty($data)) {
            return;
        }
        $return = [];
        foreach ($data as $elementKey => $elementValue) {
            if (isset($this->elements[$elementKey])) {
                if (!is_null($value = $this->elements[$elementKey]->handle($elementValue, $player))) $return[] = $value;
            } else {
                error_log(__CLASS__ . '::' . __METHOD__ . " Element with index {$elementKey} doesn't exists.");
            }
        }
        $callable = $this->getCallback();
        if ($callable !== null) {
            $callable($player, $return);
        }
    }
}
