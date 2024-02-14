<?php
class inscription{

    use hydrate;
    private ?string $idUser;
    private ?string $idForma;
    private ?string $etatInscription;
    private ?string $dateInscription;
    private ?string $intitule;
    private $nomFormation;

    private array $lesInscriptions = [];

    public function __construct(?string $idUser, ?string $idForma,?string $etatInscription) {
        $this->idUser = $idUser;
        $this->idForma = $idForma;
        $this->etatInscription = $etatInscription;
        $this->dateInscription = null;
        $this->intitule = null;
        $this->nomFormation = null;
    }



    public function getIdUser(): ?string
    {
        return $this->idUser;
    }

    public function setIdUser(?string $idUser): void
    {
        $this->idUser = $idUser;
    }

    public function getIdForma(): ?string
    {
        return $this->idForma;
    }

    public function setIdForma(?string $idForma): void
    {
        $this->idForma = $idForma;
    }

    public function getEtatInscription(): ?string
    {
        return $this->etatInscription;
    }

    public function setEtatInscription(?string $etatInscription): void
    {
        $this->etatInscription = $etatInscription;
    }

    public function getLesInscriptions(): array
    {
        return $this->lesInscriptions;
    }

    public function setLesInscriptions(array $lesInscriptions): void
    {
        $this->lesInscriptions = $lesInscriptions;
    }

    public function getIntitule(): ?string {
        return $this->intitule;
    }

    public function setIntitule(?string $unIntitule): void {
        $this->intitule = $unIntitule;
    }

    public function getDateInscription(): ?string
    {
        return $this->dateInscription;
    }

    public function setDateInscription(?string $dateInscription): void
    {
        $this->dateInscription = $dateInscription;
    }

}