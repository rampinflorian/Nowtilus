<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RdvPlanningRepository")
 */
class RdvPlanning
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $horodatage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="RdvPlanning")
     */
    private $Client;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heureFin;

    /**
     * @ORM\Column(type="float")
     */
    private $KmLibre;

    /**
     * @ORM\Column(type="float")
     */
    private $kmPaye;

    /**
     * @ORM\Column(type="boolean")
     */
    private $annule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $periode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHorodatage(): ?\DateTimeInterface
    {
        return $this->horodatage;
    }

    public function setHorodatage(\DateTimeInterface $horodatage): self
    {
        $this->horodatage = $horodatage;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): self
    {
        $this->Client = $Client;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getKmLibre(): ?float
    {
        return $this->KmLibre;
    }

    public function setKmLibre(float $KmLibre): self
    {
        $this->KmLibre = $KmLibre;

        return $this;
    }

    public function getKmPaye(): ?float
    {
        return $this->kmPaye;
    }

    public function setKmPaye(float $kmPaye): self
    {
        $this->kmPaye = $kmPaye;

        return $this;
    }

    public function getAnnule(): ?bool
    {
        return $this->annule;
    }

    public function setAnnule(bool $annule): self
    {
        $this->annule = $annule;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getPeriode(): ?string
    {
        return $this->periode;
    }

    public function setPeriode(string $periode): self
    {
        $this->periode = $periode;

        return $this;
    }
}
