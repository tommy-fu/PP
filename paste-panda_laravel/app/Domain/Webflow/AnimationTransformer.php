<?php

namespace App\Domain\Webflow;

use Illuminate\Support\Collection;

class AnimationTransformer
{
    private $selector;
    private $delay;
    private $duration;
    private $transform;
    private $animations;

    public function __construct($selector)
    {
        $this->selector = $selector;
        $this->animations = new Collection();
    }

    public function setDelay($delay)
    {
        $this->delay = $delay;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function setTransform($transform)
    {
        $this->transform = $transform;
    }

    public function addAnimations($animation)
    {
        $this->animations->add($animation);
    }

    public function getAnimations()
    {
        $animations = $this->animations
            ->groupBy(function ($animation) {
                return $animation->getStartTime();
            })
            ->map(function ($animations) {
                return [
                    'selector' => $animations->first()->getSelector(),
                    'delay' => $animations->first()->getDelay(),
                    'startTime' => $animations->first()->getStartTime(),
                    'duration' => $animations->first()->getDuration(),
                    'easing' => $animations->first()->getEasing(),
                    'items' => $animations,
                ];
            });

        $collection = new Collection();

        $lastDelay = null;

        $order = 0;
        
        $lastStartTime = 0;
        
        foreach ($animations as $key => $animation) {

            $animationResult = new AnimationResult();
            $animationResult->setActionItems($animation['items']);
            $animationResult->setSelector($animation['selector']);
            $animationResult->setEasing($animation['easing']);
            $animationResult->setStartTime($animation['startTime']);
            $animationResult->setDuration($animation['duration']);
            $animationResult->setDelay($animation['delay']);
            $animationResult->setLastStartTime($lastStartTime);

            $animationResult->setTransform($this->get3dProperties($animation['items']));

            $opacityItem = $this->getOpacityIfExists($animation['items']);
            if ($opacityItem) {
                $animationResult->setOpacity($opacityItem->getValue());
            }

            $animationResult->setOrder($order);
            $order ++;
            
            $lastStartTime = $animationResult->getStartTime();

            $collection->add($animationResult);
        }

        return $collection;
    }

    public function getCode()
    {
    }

    public function getOpacityIfExists($actions)
    {
        $opacityItem = $this->findAction($actions, ActionItemOpacity::class);

        if ($opacityItem) {
            return $opacityItem;
        }

        return null;
    }

    public function get3dProperties($actions)
    {
        $move = $this->findAction($actions, ActionItemMove::class) ? $this->findAction($actions, ActionItemMove::class)->getJS() : 'translate3d(0px, 0px, 0px)';
        $scale = $this->findAction($actions, ActionItemTransformScale::class) ? $this->findAction($actions, ActionItemTransformScale::class)->getJS() : 'scale3d(1, 1, 1)';
        $rotate = $this->findAction($actions, ActionItemRotate::class) ? $this->findAction($actions, ActionItemRotate::class)->getJS() : ' rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg)';

        $arr = [$move, $scale, $rotate];

        return join(' ', $arr);
    }

    public function findAction($actions, $actionItem)
    {
        return $actions
            ->filter(function ($action) use ($actionItem) {
                return get_class($action) == $actionItem;
            })->first();
    }

    public function getSelector()
    {
        return $this->selector;
    }

    private function getDuration()
    {
        return $this->duration . 'ms';
    }

    private function getDelay()
    {
        return $this->delay . 'ms';
    }

    public function getJS()
    {
        $str = '';
        $str .= 'element.style.transitionDelay=' . $this->delay . PHP_EOL;
        $str .= 'element.style.transition=' . $this->duration . isset($this->easing) ? $this->easing : '' . PHP_EOL;
        $str .= 'element.style.transform = ' . $this->transform . PHP_EOL;

        return $str;
    }
}
