<?php

namespace atom\gui\elements;

use Exception;
use pocketmine\Player;

class Button extends Element {

    const IMAGE_TYPE_PATH = 'path';
    const IMAGE_TYPE_URL = 'url';

    /** @var string May be 'path' or 'url' */
    protected $imageType = '';
    protected $imagePath = '';

    public function __construct($text){
        $this->text = $text;
    }

    /**
     * @param string $imageType
     * @param string $imagePath
     * @throws Exception
     */
    public function addImage(string $imageType, string $imagePath){
        if ($imageType != self::IMAGE_TYPE_PATH && $imageType != self::IMAGE_TYPE_URL) {
            throw new Exception(__CLASS__ . '::' . __METHOD__ . ' Invalid image type');
        }
        $this->imageType = $imageType;
        $this->imagePath = $imagePath;
    }

    public function jsonSerialize() {
        $data = [
            'type' => 'button',
            'text' => $this->text
        ];
        if ($this->imageType != '') {
            $data['image'] = [
                'type' => $this->imageType,
                'data' => $this->imagePath
            ];
        }
        return $data;
    }

    public function handle($value, Player $player){
        return $this->text;
    }
}
