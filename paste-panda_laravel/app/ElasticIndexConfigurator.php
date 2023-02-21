<?php

namespace App;

use ScoutElastic\IndexConfigurator;

class ElasticIndexConfigurator extends IndexConfigurator
{
	public static function getFullName() : String
	{
		return (new static())->getName();
	}
}
