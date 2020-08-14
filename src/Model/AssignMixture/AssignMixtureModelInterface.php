<?php


namespace App\Model\AssignMixture;


interface AssignMixtureModelInterface
{
    public function createFoundedTable(GenericMixtures $genericMixtures, $mixtureUsage);
}