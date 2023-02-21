<?php

namespace App\Domain\Sections\HtmlTags;

use App\Domain\Sections\Facades\AvatarFacade;
use App\Domain\Sections\HtmlTags\HtmlBaseTag;
use DOMElement;
use function app;

class Avatar extends HtmlBaseTag
{
    public function createNode($domDocument): DOMElement
    {
        $newNode = $domDocument->createElement('img');

        $randomGender = random_int(0, 1) == 0 ? 'male' : 'female';

        $gender = !empty($newNode->getAttribute('gender')) ? $newNode->getAttribute('gender') : $randomGender;

        $avatar = AvatarFacade::getAvatar($gender);

        $blend = app('colors')['image-blend'];

        $blend = str_replace('#', '', $blend);

        $saturation = app('colors')['background_image-saturation'];

        $satStr = '';

        if ($saturation) {
            $satStr = '&sat=' . $saturation;
        }

        $newNode->setAttribute('src', $avatar['img_url'] . '?q=90&fit=facearea&h=300&w=300&crop=faces&facepad=' . $avatar->face_pad . '&faceindex=' . $avatar->face_index . '&blend=' . $blend . '&blend-mode=multiply' . $satStr);

        $newNode->setAttribute('class', $this->getNode()->getAttribute('class'));
        $newNode->setAttribute('style', $this->getNode()->getAttribute('style'));
        
        return $newNode;
    }
}
