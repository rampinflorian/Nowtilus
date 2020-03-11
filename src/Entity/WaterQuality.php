<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WaterQualityRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class WaterQuality
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
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
    private $createdAt;

    /**
     * @ORM\PrePersist()
     */
    public function PrePersistSetCreatedAt()
    {
        $this->setCreatedAt(new \DateTime('now'));
    }

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

}
