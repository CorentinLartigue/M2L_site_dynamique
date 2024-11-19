<?php
class club{
    use hydrate;
	private ?int $idClub;
    private ?int $idLigue;
    private ?string $idCommune;
	private ?string  $nomClub;
	private ?string $adresseClub;


    public function __construct(?int $unIdClub, ?string $unNomClub, ?int $idLigue)
    {
        $this->idClub = $unIdClub;
        $this->nomClub = $unNomClub;
        $this->idLigue = $idLigue;

    }


    public function getIdClub(): int{
		return $this->idClub;
	}

	public function setIdClub(int $unIdClub): void{
	    $this->idClub =  $unIdClub;
	}

    public function getIdLigue(): ?int
    {
        return $this->idLigue;
    }

    public function setIdLigue(?int $idLigue): void
    {
        $this->idLigue = $idLigue;
    }

    public function getIdCommune(): ?string
    {
        return $this->idCommune;
    }

    public function setIdCommune(?string $idCommune): void
    {
        $this->idCommune = $idCommune;
    }

	public function getNomClub(): ?string{
		return $this->nomClub;
	}

	public function setNomClub(?string $unNomClub): void{
		$this->nomClub = $unNomClub;
	}

	public function getAdresseClub(): ?string{
		return $this->adresseClub;
	}

	public function setAdresseClub(?string $unAdresseClub): void{
		$this->adresseClub = $unAdresseClub;
	}


}
?>