<?php
class formations{
	private array $formations ;

	public function __construct($array){
		if (is_array($array)) {
			$this->formations = $array;
		}
	}

	public function getFormations(){
		return $this->formations;
	}



    public function chercheFormation($unIdFormation) {
        // Ajoutez un var_dump pour déboguer


        foreach ($this->formations as $formation) {
            if ($formation->getIdForma() === $unIdFormation) {
                return $formation;
            }
        }

        return null;
    }


}