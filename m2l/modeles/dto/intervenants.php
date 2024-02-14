<?php
class Intervenants
{
    private array $intervenants;

    public function __construct($array)
    {
        $this->intervenants = [];
        foreach ($array as $intervenantInfos) {
            $intervenant = new Intervenant($intervenantInfos['idUser'], $intervenantInfos['nom'], $intervenantInfos['prenom'], null, null, $intervenantInfos['status'], null);
            array_push($this->intervenants, $intervenant);
        }
    }

    public function getIntervenants(){
        return $this->intervenants;
    }

    public function chercheIntervenant($unIdIntervenant){
        $i = 0;
        while ($unIdIntervenant != $this->intervenants[$i]->getIdIntervenant() && $i < count($this->intervenants)-1){
            $i++;
        }
        if ($unIdIntervenant == $this->intervenants[$i]->getIdIntervenant()){
            return $this->intervenants[$i];
        }
    }
}