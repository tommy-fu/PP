<?php

namespace App\Services;

use App\Events\UserLoggedOut;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class ElasticService
{
	public static function addToElastic($type, $data)
	{
	
		\Event::dispatch(new UserLoggedOut($data, $type));
//		AddToElastic::dispatch();
//		$endpoint = env('ELASTIC_ENDPOINT') . '/_bulk';
//
//		$client = new Client();
//
//		$res = [];
//
//		$res[] = array_merge($data, [
//			'session.id' => session()->getId(),
//			'timestamp' => Carbon::now()->toIso8601String(),
//			'event.type' => $type,
//		]);
//		if (!Auth::guest()) {
//			$res[] = array_merge($res, [
//				'user.id' => Auth::user()->id,
//			]);
//		};
//
//		$data = [];
//
//		foreach ($res as $result) {
//			$data[] = json_encode(['index' =>
//				['_index' => env('ELASTIC_INDEX')],
//			]);
//
//			$data[] = json_encode($result);
//		}
//
//		$data = join("\n", $data);
//
//		$client->post($endpoint, [
//			'headers' => ['Content-Type' => 'application/json'],
//			'body' => $data . "\n",
//		]);
//
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
				'form_params' => $query,
			]);
		
		return json_decode($response->getBody()->getContents(), true);
	}
}
