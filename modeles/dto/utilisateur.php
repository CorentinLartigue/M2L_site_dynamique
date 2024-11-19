<?php

class utilisateur {

    use hydrate;
    private ?string $idUser;
    private ?string  $idFonct;
    private ?string $idLigue;
    private ?string $idClub;
    private ?string $nom;
    private ?string $prenom;
    private ?string $login;
    private ?string $mdp;
    private ?string $status;
    private ?string $typeUser;
    private array $lesUtilisateurs = [];


    public function __construct($unIdUser){
        $this->idUser = $unIdUser;
        $this->idFonct = null;
        $this->idLigue = null;
        $this->idClub = null;
        $this->nom = null;
        $this->prenom = null;
        $this->login = null;
        $this->mdp = null;
        $this->status = null;
        $this->typeUser = null;
        $this->lesUtilisateurs = array();
    }

    /**
     * @return mixed
     */
    public function getIdUser() : ?string
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser(?string $idUser): void
    {
        $this->idUser = $idUser;
    }

    public function getIdFonct(): ?string
    {
        return $this->idFonct;
    }

    public function setIdFonct(?string $idFonct): void
    {
        $this->idFonct = $idFonct;
    }

    public function getIdLigue(): ?string
    {
        return $this->idLigue;
    }

    public function setIdLigue(?string $idLigue): void
    {
        $this->idLigue = $idLigue;
    }

    public function getIdClub(): ?string
    {
        return $this->idClub;
    }

    public function setIdClub(?string $idClub): void
    {
        $this->idClub = $idClub;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): void
    {
        $this->login = $login;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(?string $mdp): void
    {
        $this->mdp = $mdp;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getTypeUser(): ?string
    {
        return $this->typeUser;
    }

    public function setTypeUser(?string $typeUser): void
    {
        $this->typeUser = $typeUser;
    }

    public function getLesUtilisateurs(): array
    {
        return $this->lesUtilisateurs;
    }

    public function setLesUtilisateurs(array $lesUtilisateurs): void
    {
        $this->lesUtilisateurs = $lesUtilisateurs;
    }






}