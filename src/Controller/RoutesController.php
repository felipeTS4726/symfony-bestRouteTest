<?php

namespace App\Controller;

use App\Entity\Airports;
use App\Entity\Routes;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class RoutesController {

	const INVALID_DEPARTURE_LOCATION = "Invalid departure location.";
	const INVALID_DESTINATION_LOCATION = "Invalid destination location.";
	const INVALID_DEPARTURE_ID = "Invalid departure ID.";
	const INVALID_DESTINATION_ID = "Invalid destination ID.";


	/**
	 * @Route("/routes/best-route/", name="bestRoute", methods="GET")
	 */
	public function bestRoute( ManagerRegistry $mr, Request $request ): JsonResponse {
		$from   = $request->query->get( 'from' );
		$to     = $request->query->get( 'to' );
		$errors = array();

		if ( empty( $from ) || ! is_numeric( $from ) ) {
			$errors [] = $this::INVALID_DEPARTURE_LOCATION;
		}
		if ( empty( $to ) || ! is_numeric( $to ) ) {
			$errors [] = $this::INVALID_DESTINATION_LOCATION;
		}

		if ( ! empty( $errors ) ) {
			return new JsonResponse( [ 'success' => false, 'messages' => $errors ] );
		}

		$ar = new \App\Repository\AirportsRepository( $mr );
		if ( ! $origin = $ar->find( $from ) ) {
			$errors [] = $this::INVALID_DEPARTURE_ID;
		}
		if ( ! $destiny = $ar->find( $to ) ) {
			$errors [] = $this::INVALID_DESTINATION_ID;
		}


		if ( ! empty( $errors ) ) {
			return new JsonResponse( [ 'success' => false, 'messages' => $errors ] );
		}

		$data = array();
		foreach ( Routes::getBestRoute( $origin, $destiny, $mr ) as $airportInRoute ) {
			$data[] = array(
				'airportId'   => $airportInRoute->getId(),
				'cityId'      => $airportInRoute->getCityId(),
				'cityName'    => $airportInRoute->getCity()->getCityName(),
				'countryName' => $airportInRoute->getCountry()->getCountryName()
			);
		}

		return new JsonResponse( [ 'success' => true, 'data' => $data ] );
	}
}
