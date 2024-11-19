<?php
class formation{

    use hydrate;
	private  $idForma;
	private ?string  $intitule;
	private ?string $descriptif;
	private ?int $duree;
	private ?string $dateOuvertInscriptions;
	private ?string $dateClotureInscriptions;
	private ?int $effectifMax;
	private array $lesFormations = [];


	
	public function __construct($unIdFormation , ?string $unIntitule){
	    $this->idForma = $unIdFormation;
	    $this->intitule = $unIntitule;
        $this->descriptif = null;
        $this->duree = null;
        $this->dateOuvertInscriptions = null;
        $this->dateClotureInscriptions = null;
        $this->effectifMax = null;
        $this->lesFormations = array();
	}

    public function getIdForma(){
	    return $this->idForma;
	}

	public function setIdForma(string $unIdFormation): void{
	    $this->idForma =  $unIdFormation;
	}

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $Undescriptif): void
    {
        $this->descriptif = $Undescriptif;
    }

	public function getIntitule(): ?string{
	    return $this->intitule;
	}

	public function setIntitule(string $unIntitule): void{
	    $this->intitule = $unIntitule;
	}

	
	public function getDateOuvertInscriptions()
	{
	    return $this->dateOuvertInscriptions;
	}
	
	public function setDateOuvertInscriptions($dateOuvertInscriptions)
	{
	    $this->dateOuvertInscriptions = $dateOuvertInscriptions;
	}


	
	public function getDateClotureInscriptions()
	{
	    return $this->dateClotureInscriptions;
	}
	
	public function setDateClotureInscriptions($dateClotureInscriptions)
	{
	    $this->dateClotureInscriptions = $dateClotureInscriptions;
	}
	

	public function getEffectifMax()
	{
	    return $this->effectifMax;
	}
	
	
	public function setEffectifMax($effectifMax)
	{
	    $this->effectifMax = $effectifMax;
	}

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): void
    {
        $this->duree = $duree;
    }



}