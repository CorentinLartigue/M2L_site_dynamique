<?php

class contrat
{
    private string $idContrat;
    private ?string $dateDebut;
    private ?string $dateFin;
    private ?string $typeContrat;
    private ?string $nbHeures;

    /**
     * @param string $idContrat
     * @param string|null $dateDebut
     * @param string|null $dateFin
     * @param string|null $typeContrat
     * @param string|null $nbHeures
     */
    public function __construct(string $idContrat, ?string $dateDebut, ?string $dateFin, ?string $typeContrat, ?string $nbHeures)
    {
        $this->idContrat = $idContrat;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->typeContrat = $typeContrat;
        $this->nbHeures = $nbHeures;
    }

    public function getIdContrat(): string
    {
        return $this->idContrat;
    }

    public function setIdContrat(string $idContrat): void
    {
        $this->idContrat = $idContrat;
    }

    public function getDateDebut(): ?string
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?string $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin(): ?string
    {
        return $this->dateFin;
    }

    public function setDateFin(?string $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(?string $typeContrat): void
    {
        $this->typeContrat = $typeContrat;
    }

    public function getNbHeures(): ?string
    {
        return $this->nbHeures;
    }

    public function setNbHeures(?string $nbHeures): void
    {
        $this->nbHeures = $nbHeures;
    }



}