<?php


namespace App\Domain\Sections\Services;


class JavaScriptService
{
	
	public static function getElementById($id){
		return 'document.getElementById("' . $id . '")';
	}
	
	public static function getElementsByClassName($className){
		return 'document.getElementsByClassName("' . $className . '")';
	}
	
	public static function setStyle($property, $value){
		return 'document.getElementsByClassName("' . $className . '")';
	}
}
