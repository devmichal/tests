<?php


namespace App\Model\AssignMixture\Helper;

use App\Entity\Mixture\GenericMixtures;
use App\Entity\Mixture\MixtureUsage;

class CheckAssignMixture
{
    /** @var MixtureUsage */
    private $mixtureUsage;    //doc here is a many items

    /** @var GenericMixtures */
    private $searchMixtureName; //doc it`s only one

    protected function isAssignAlready($mixtureUsages, GenericMixtures $genericMixtures)
    {
        $this->searchMixtureName = $genericMixtures;

        return $this->iterableFunction($mixtureUsages);
    }

    private function iterableFunction($mixtureUsages)
    {
        foreach ($mixtureUsages as $mixtureUsage) {

            $this->mixtureUsage = $mixtureUsage;
            $variable = $this->checkAssignMixtureInDepartment();

            if ($variable){

                return true;
            }
        }
    }

    private function checkAssignMixtureInDepartment(): bool
    {
        $myMixture = $this->mixtureUsage->getCompanyMixture()->getGenericMixture()->getName();
        $searchMixture = $this->searchMixtureName->getName();

        if ($myMixture == $searchMixture) {

            return true;
        }
        return false;
    }
}