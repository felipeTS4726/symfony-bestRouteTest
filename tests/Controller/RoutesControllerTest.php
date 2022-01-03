<?php

namespace App\Tests\Controller;

use App\Controller\RoutesController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoutesControllerTest extends WebTestCase {

	public function testBestRouteResponse() {
		$client = static::createClient();
		$client->request( 'GET', '/routes/best-route/', [ 'from' => 1, 'to' => 2 ] );

		$this->assertResponseIsSuccessful();
	}

	public function testBestRouteNoParamsError() {
		$client = static::createClient();
		$client->request( 'GET', '/routes/best-route/', [] );

		$response = $client->getResponse();
		$this->assertEquals(
			'{"success":false,"messages":["' . RoutesController::INVALID_DEPARTURE_LOCATION . '","' . RoutesController::INVALID_DESTINATION_LOCATION . '"]}',
			$response->getContent() );
	}

	public function testBestRouteNoFromParamError() {
		$client = static::createClient();
		$client->request( 'GET', '/routes/best-route/', [ 'to' => 1 ] );

		$response = $client->getResponse();
		$this->assertEquals(
			'{"success":false,"messages":["' . RoutesController::INVALID_DEPARTURE_LOCATION . '"]}',
			$response->getContent() );
	}

	public function testBestRouteNoToParamError() {
		$client = static::createClient();
		$client->request( 'GET', '/routes/best-route/', [ 'from' => 1 ] );

		$response = $client->getResponse();
		$this->assertEquals(
			'{"success":false,"messages":["' . RoutesController::INVALID_DESTINATION_LOCATION . '"]}',
			$response->getContent() );
	}

	public function testBestRouteInvalidParamsError() {
		$client = static::createClient();
		$client->request( 'GET', '/routes/best-route/', [ 'from' => 999999, 'to' => 999999 ] );

		$response = $client->getResponse();
		$this->assertEquals(
			'{"success":false,"messages":["' . RoutesController::INVALID_DEPARTURE_ID . '","' . RoutesController::INVALID_DESTINATION_ID . '"]}',
			$response->getContent() );
	}

	public function testBestRouteInvalidFromParamError() {
		$client = static::createClient();
		$client->request( 'GET', '/routes/best-route/', [ 'from' => 999999, 'to' => 1 ] );

		$response = $client->getResponse();
		$this->assertEquals(
			'{"success":false,"messages":["' . RoutesController::INVALID_DEPARTURE_ID . '"]}',
			$response->getContent() );
	}

	public function testBestRouteInvalidToParamError() {
		$client = static::createClient();
		$client->request( 'GET', '/routes/best-route/', [ 'from' => 1, 'to' => 999999 ] );

		$response = $client->getResponse();
		$this->assertEquals(
			'{"success":false,"messages":["' . RoutesController::INVALID_DESTINATION_ID . '"]}',
			$response->getContent() );
	}

	public function testBestRouteOPOtoLIS() {
		$client = static::createClient();
		$client->request( 'GET', '/routes/best-route/', [ 'from' => 1, 'to' => 2 ] );

		$response = $client->getResponse();
		$this->assertEquals(
			'{"success":true,"data":[{"airportId":1,"cityId":1,"cityName":"Oporto","countryName":"Portugal"},{"airportId":7,"cityId":7,"cityName":"Paris","countryName":"France"},{"airportId":2,"cityId":2,"cityName":"Lisbon","countryName":"Portugal"}]}',
			$response->getContent(), 'Best Route from OPO to LIS failed or have changed' );
	}

}