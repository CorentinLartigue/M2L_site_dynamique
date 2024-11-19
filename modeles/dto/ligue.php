<?php
class ligue{
    use hydrate;
	private ?int $idLigue;
	private ?string  $nomLigue;
	private ?string $lienSite;
	private ?string $descriptif;


    public function __construct(?int $unIdLigue, ?string $unNomLigue)
    {
        $this->idLigue = $unIdLigue;
        $this->nomLigue = $unNomLigue;
    }


    public function getIdLigue(): int{
		return $this->idLigue;
	}

	public function setIdLigue(int $unIdLigue): void{
		$this->idLigue = $unIdLigue;
	}

	public function getNomLigue(): ?string{
		return $this->nomLigue;
	}

	public function setNomLigue(?string $unNomLigue): void{
		$this->nomLigue = $unNomLigue;
	}

	public function getLienSite(): ?string{
		return $this->lienSite;
	}

	public function setLienSite(?string $unLienSite): void{
		$this->lienSite = $unLienSite;
	}

	public function getDescriptif(): ?string{
		return $this->descriptif;
	}

	public function setDescriptif(?string $unDescriptif): void{
		$this->descriptif = $unDescriptif;
	}

}
?>