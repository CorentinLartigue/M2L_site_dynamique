<?php

class Intervenant
{
    private string $idIntervenant;
    private ?string $nom;
    private ?string $prenom;
    private ?string $login;
    private ?string $mdp;
    private ?string $statut;
    private ?string $typeUser;


    public function __construct(string $unIdIntervenant, ?string $unNom, ?string $unPrenom, ?string $unLogin, ?string $unMdp, ?string $unStatut, ?string $unTypeUser)
    {
        $this->idIntervenant = $unIdIntervenant;
        $this->nom = $unNom;
        $this->prenom = $unPrenom;
        $this->login = $unLogin;
        $this->mdp = $unMdp;
        $this->statut = $unStatut;
        $this->typeUser = $unTypeUser;
    }


    public function getIdIntervenant(): string
    {
        return $this->idIntervenant;
    }

    public function setIdIntervenant(string $idIntervenant): void
    {
        $this->idIntervenant = $idIntervenant;
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

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): void
    {
        $this->statut = $statut;
    }

    public function getTypeUser(): ?string
    {
        return $this->typeUser;
    }

    public function setTypeUser(?string $typeUser): void
    {
        $this->typeUser = $typeUser;
    }


}