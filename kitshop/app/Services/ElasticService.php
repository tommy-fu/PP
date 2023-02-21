<?php

namespace App\Services;

use Carbon\Carbon;
use GuzzleHttp\Client;

class ElasticService
{
	public static function addToElastic($type, $data = null)
	{

		$endpoint = env('ELASTIC_ENDPOINT') . '/_bulk';

		$client = new Client();

		$res = [];
		
		if (!empty($data)) {

			$res[] = array_merge($data, [
				'session.id' => session()->getId(),
				'event.type' => $type,
				'clientIP' => $_SERVER['REMOTE_ADDR'],
				'agent' => $_SERVER['HTTP_USER_AGENT'],
				'language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
				'referrer' => $_SERVER['HTTP_REFERER'] ?? 'No Referrer',
				'host' => $_SERVER['HTTP_HOST'],
				'statusCode' => $_SERVER['REDIRECT_STATUS'],
				'request_uri' => $_SERVER['REQUEST_URI'],
				'timestamp' =>  $_SERVER['REQUEST_TIME']
			]);
			$data = [];

			
			foreach ($res as $result) {
				$data[] = json_encode([
					'index' =>
					['_index' => 'kitshop-marketing-test'],
				]);
				$data[] = json_encode($result);
			}


			$data = join("\n", $data);

			$response = $client->post($endpoint, [
				'headers' => ['Content-Type' => 'application/json'],
				'body' => $data . "\n",
			]);

			return json_decode($response->getBody()->getContents(), true);

		}

		else {

			$res[] = [
				'session.id' => session()->getId(),
				'event.type' => $type,
				'clientIP' => $_SERVER['REMOTE_ADDR'],
				'agent' => $_SERVER['HTTP_USER_AGENT'],
				'language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
				'site_referrer' => $_SERVER['HTTP_REFERER'] ?? 'No Referrer',
				'host' => $_SERVER['HTTP_HOST'],
				'statusCode' => $_SERVER['REDIRECT_STATUS'],
				'request_uri' => $_SERVER['REQUEST_URI'],
				'timestamp' =>  $_SERVER['REQUEST_TIME']
			];
	
			foreach ($res as $result) {
				$data[] = json_encode([
					'index' =>
					['_index' => 'kitshop-marketing-test'],
				]);
				$data[] = json_encode($result);
			}
	
	
			$data = join("\n", $data);
	
			$response = $client->post($endpoint, [
				'headers' => ['Content-Type' => 'application/json'],
				'body' => $data . "\n",
			]);
		}
		
	
	}
	public static function get($query, $endpoint)
	{
		$endpoint = env('ELASTIC_ENDPOINT') . '/' . $endpoint;

		$client = new Client();

		$response = $client->get($endpoint, [
			'headers' => ['Content-Type' => 'application/json'],
			'body' => json_encode($query),
		]);

		return json_decode($response->getBody()->getContents(), true);
	}

	public static function post($query, $endpoint)
	{
		$endpoint = env('ELASTIC_ENDPOINT') . '/' . $endpoint;

		$client = new Client();

		$response = $client
			->post($endpoint, [
				'headers' => ['Content-Type' => 'application/json'],
				'body' => $query,
			]);

		return json_decode($response->getBody()->getContents(), true);
	}

	public static function ping($query, $endpoint)
	{
		$endpoint = env('ELASTIC_ENDPOINT') . '/' . $endpoint;

		$client = new Client();
		
		$response = $client
			->post($endpoint, [
				'headers' => ['Content-Type' => 'application/json'],
				'body' => $query,
			]);
		return json_decode($response->getBody()->getContents(), true);
	}
}
