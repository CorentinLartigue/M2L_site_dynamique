<?php

class contrats
{

    private array $contrats;

    public function __construct($array)
    {
        $this->contrats = [];
        foreach ($array as $contratInfos) {
            $contrat = new contrat($contratInfos['idContrat'], $contratInfos['dateDebut'], $contratInfos['dateFin'], $contratInfos['typeContrat'], $contratInfos['nbHeures']);
            array_push($this->contrats, $contrat);
        }
    }

    public function getContrats()
    {
        return $this->contrats;
    }

    public function chercheContrats($unIdContrat)
    {
        $i = 0;
        while ($unIdContrat != $this->contrats[$i]->getIdContrat() && $i < count($this->contrats) - 1) {
            $i++;
        }
        if ($unIdContrat == $this->contrats[$i]->getIdContrat()) {
            return $this->contrats[$i];
        }
    }
}