<?php


namespace App\Services;


class ElasticApmService
{
	
	
	public static function track($callback)
	{
		if (is_callable($callback)) {
			if (config('app.env') === 'production') {
				$config = [
					'appName' => 'Pastepanda Master',
					'appVersion' => '1.0.42',
					'serverUrl' => 'https://505002aef13640a294004b10e3c13503.apm.eu-west-1.aws.cloud.es.io',
					'secretToken' => 'hGcLEHRZxNuscvuhpZ',
//		    'hostname'    => 'node-24.app.network.com',
//		    'env'         => ['DOCUMENT_ROOT', 'REMOTE_ADDR', 'REMOTE_USER'],
//		    'cookies'     => ['my-cookie'],
//		    'httpClient'  => [
//			    'verify' => false,
//			    'proxy'  => 'tcp://localhost:8125'
//		    ],
				];
				
				$agent = new \PhilKra\Agent($config);
				
				// Wrap everything in a Parent transaction
				$parent = $agent->startTransaction('GET /sections');
				$spanCache = $agent->factory()->newSpan('Retrieving sections', $parent);
				$spanCache->setType('db.query');
				$spanCache->start();
				
				// do some db.mysql.query action ..
			}
			
			$returnValue = call_user_func($callback);
			
			if (config('app.env') === 'production') {
				$spanCache->stop();
				$spanCache->setContext(['db' => [
					'instance' => 'redis01.example.foo',
					'statement' => 'GET data_12345',
				]]);
				$agent->putEvent($spanCache);
				
				// Query microservice with Traceparent Header
				$spanHttp = $agent->factory()->newSpan('Query DataStore Service', $parent);
				$spanHttp->setType('external.http');
				$spanHttp->start();
			}
			
			return $returnValue;
		}
	}
}
