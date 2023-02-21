<?php


namespace App\Domain\Webflow;


use Illuminate\Support\Collection;

class ActionItemGroup
{
	
	private Collection $actions;
	private $title;
	private $id;
	private bool $isInitial = false;
	private $startTime;
	private $keyframe = -1;
	
	public function __construct()
	{
		$this->actions = new Collection();
	}
	
	public function addAction($actionItem)
	{
		$this->actions->add($actionItem);
	}
	
	public function getActions()
	{
		return $this->actions;
	}
	
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	public function getTitle(){
		return $this->title;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getId(){
		return $this->id;
	}
	public function getJS()
	{
		$opacity = $this->findAction(ActionItemOpacity::class) ? $this->findAction(ActionItemOpacity::class)->getJS() : '';
		return $this->get3dProperties();
	}
	
	public function get3dProperties(){
		$move = $this->findAction(ActionItemMove::class) ? $this->findAction(ActionItemMove::class)->getJS() : 'translate3d(0px, 0px, 0px)';
		$scale = $this->findAction(ActionItemTransformScale::class) ? $this->findAction(ActionItemTransformScale::class)->getJS()  : 'scale3d(1, 1, 1)';
		$rotate = $this->findAction(ActionItemRotate::class) ? $this->findAction(ActionItemRotate::class)->getJS() : ' rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg)';
		
		$arr = [$move, $scale, $rotate];
		
		return join(' ', $arr);
	}
	
	
	public function findAction($actionItem)
	{
		return $this->getActions()
			->filter(function ($action) use ($actionItem) {
				return get_class($action) == $actionItem;
			})->first();
	}
	
	/**
	 * @return bool
	 */
	public function isInitial(): bool
	{
		return $this->isInitial;
	}
	
	/**
	 * @param bool $isInitial
	 */
	public function setIsInitial(bool $isInitial): void
	{
		$this->isInitial = $isInitial;
	}
	
	public function setStartTime($startTime)
	{
		$this->startTime = $startTime;
	}
	
	public function setActions(Collection $actions)
	{
		$this->actions = $actions;
	}
	
	/**
	 * @return int
	 */
	public function getKeyframe(): int
	{
		return $this->keyframe;
	}
	
	/**
	 * @param int $keyframe
	 */
	public function setKeyframe(int $keyframe): void
	{
		$this->keyframe = $keyframe;
	}
}
