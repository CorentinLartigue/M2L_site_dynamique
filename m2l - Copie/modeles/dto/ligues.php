<?php
class ligues{
	private array $ligues ;

	public function __construct($array){
		if (is_array($array)) {
			$this->ligues = $array;
		}
	}

	public function getLigues(){
		return $this->ligues;
	}

	public function chercheLigue($unIdLigue){
		$i = 0;
		while ($unIdLigue != $this->ligues[$i]->getIdLigue() && $i < count($this->ligues)-1){
			$i++;
		}
		if ($unIdLigue == $this->ligues[$i]->getIdLigue()){
			return $this->ligues[$i];
		}
	}

    public function premierLigue(){
        return $this->ligues[0]->getIdLigue();

    }
}

?>