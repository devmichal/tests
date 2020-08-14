<?php


namespace App\Model\AssignMixture;

use App\Entity\Mixture\GenericMixtures;
use App\Model\AssignMixture\Helper\CheckAssignMixture;

class AssignMixtureModel extends CheckAssignMixture implements AssignMixtureModelInterface
{

    public function createFoundedTable(GenericMixtures $genericMixtures, $mixtureUsage): array
    {
        return[
            'id_generic_mixture' => $genericMixtures->getId(),
            'name' => $genericMixtures->getName(),
            'supplier_name' => $genericMixtures->getMixture()->getSupplier()->getName(),
            'exist' => $this->isAssignAlready($mixtureUsage, $genericMixtures)
        ];
    }
}