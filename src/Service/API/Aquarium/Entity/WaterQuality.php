<?php

namespace App\Service\API\Aquarium\Entity;

use Doctrine\ORM\Mapping as ORM;

class WaterQuality
{

    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $ph;

    /**
     * @ORM\Column(type="float")
     */
    private $kh;

    /**
     * @ORM\Column(type="float")
     */
    private $co2;

    /**
     * @ORM\Column(type="float")
     */
    private $no2;

    /**
     * @ORM\Column(type="float")
     */
    private $no3;

    /**
     * @ORM\Column(type="float")
     */
    private $fe;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt = null;

    public function getPh(): ?float
    {
        return $this->ph;
    }

    public function setPh(float $ph): self
    {
        $this->ph = $ph;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getKh(): ?float
    {
        return $this->kh;
    }

    public function setKh(float $kh): self
    {
        $this->kh = $kh;

        return $this;
    }

    public function getCo2(): ?float
    {
        return $this->co2;
    }

    public function setCo2(float $co2): self
    {
        $this->co2 = $co2;

        return $this;
    }

    public function getNo2(): ?float
    {
        return $this->no2;
    }

    public function setNo2(float $no2): self
    {
        $this->no2 = $no2;

        return $this;
    }

    public function getNo3(): ?float
    {
        return $this->no3;
    }

    public function setNo3(float $no3): self
    {
        $this->no3 = $no3;

        return $this;
    }

    public function getFe(): ?float
    {
        return $this->fe;
    }

    public function setFe(float $fe): self
    {
        $this->fe = $fe;

        return $this;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

}
