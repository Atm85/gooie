<?php

namespace atom\gui\type;

use pocketmine\form\Form;

abstract class Type implements Form{

    private $callback;

    public function __construct() {
    }

    public function close() {

    }

    public function getCallback() : ?callable{
        return $this->callback;
    }

    public function setAction($callback) {
        $this->callback = $callback;
    }
}
