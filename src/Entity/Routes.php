<?php

namespace App\Entity;

use App\Repository\RoutesRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @ORM\Entity(repositoryClass=RoutesRepository::class)
 */
class Routes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $origin;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $destiny;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getDestiny(): ?string
    {
        return $this->destiny;
    }

    public function setDestiny(string $destiny): self
    {
        $this->destiny = $destiny;

        return $this;
    }

    public function getAdded(): ?\DateTimeInterface
    {
        return $this->added;
    }

    public function setAdded(\DateTimeInterface $added): self
    {
        $this->added = $added;

        return $this;
    }


    public static function getBestRoute(Airports $origin, Airports $destiny, ManagerRegistry $mr){
	    $con = $mr->getConnection();
	    $statement = $con->prepare("SELECT
		 R.destiny as `first`, a.destiny as `second`, b.destiny as `third`, c.destiny as `fourth`
		 FROM Routes R
		 LEFT JOIN Routes a ON R.destiny = a.origin
		 LEFT JOIN Routes b ON R.destiny = a.origin AND a.destiny = b.origin
		 LEFT JOIN Routes c ON R.destiny = a.origin AND a.destiny = b.origin AND b.destiny = c.origin
		 WHERE R.origin = :from AND ( R.destiny = :to OR a.destiny = :to OR b.destiny = :to )
		
		 ORDER BY
		 CASE WHEN `first` = :to THEN 1 ELSE 0 END DESC,
		 CASE WHEN `second` = :to THEN 1 ELSE 0 END DESC,
		 CASE WHEN `third` = :to THEN 1 ELSE 0 END DESC
		LIMIT 1");
	    $statement->bindValue('from', $origin->getAirportName());
	    $statement->bindValue('to', $destiny->getAirportName());
	    $statement->execute();
	    $bestRoute = array();
	    if($results = $statement->fetch()) {
		    $ar        = new \App\Repository\AirportsRepository( $mr );
		    $bestRoute[] = $origin;
		    foreach ( $results as $result ) {
			    if ( $result == $destiny->getAirportName() ) {
				    $bestRoute[] = $destiny;
				    return $bestRoute;
			    }
			    if ( $layover = $ar->findOneBy( array( 'airportName' => $result) ) ) {
				    $bestRoute[] = $layover;
			    }
		    }
	    }
	    return false; //no routes or more than 4 hops
    }
}
