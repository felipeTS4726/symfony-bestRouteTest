<?php

namespace App\Entity;

use App\Repository\AirportsRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=AirportsRepository::class)
 */
class Airports
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="airportName", type="string", length=50)
     */
    private $airportName;

    /**
     * @ORM\Column(name="cityId", type="integer")
     */
    private $cityId;

    /**
     * @ORM\Column(name="countryId", type="integer")
     */
    private $countryId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added;

	/**
	 * @ORM\OneToOne(targetEntity="Cities")
	 * @ORM\JoinColumn(name="cityId", referencedColumnName="id")
	 */
	private $City;

	/**
	 * @ORM\OneToOne(targetEntity="Countries")
	 * @ORM\JoinColumn(name="countryId", referencedColumnName="id")
	 */
	private $Country;

	/**
	 */
	public function __construct() {
		$this->City = new \Doctrine\Common\Collections\ArrayCollection();
		$this->Country = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * @return mixed
	 */
	public function getCountry() {
		return $this->Country;
	}

	/**
	 * @return mixed
	 */
	public function getCity() {
		return $this->City;
	}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAirportName(): ?string
    {
        return $this->airportName;
    }

    public function setAirportName(string $airportName): self
    {
        $this->airportName = $airportName;

        return $this;
    }

    public function getCityId(): ?int
    {
        return $this->cityId;
    }

    public function setCityId(int $cityId): self
    {
        $this->cityId = $cityId;

        return $this;
    }

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): self
    {
        $this->countryId = $countryId;

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
}
