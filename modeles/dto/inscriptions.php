<?php
class inscriptions{
	private array $inscriptions ;

	public function __construct($array){
		if (is_array($array)) {
			$this->inscriptions = $array;
		}
	}

	public function getInscriptions(){
		return $this->inscriptions;
	}


	public function chercheInscriptions($idForma)
    {
        $i = 0;
        while ($idForma != $this->inscriptions[$i]->getIdForma() && $i < count($this->inscriptions) - 1) {
            $i++;
        }
        if ($idForma == $this->inscriptions[$i]->getIdForma()) {
            return $this->inscriptions[$i];
        }
    }
}