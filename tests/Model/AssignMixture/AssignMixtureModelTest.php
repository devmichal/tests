<?php


namespace App\Tests\Model\AssignMixture;


use App\Entity\Company\Companies;
use App\Entity\Company\CompanyMixtures;
use App\Entity\Mixture\GenericMixtures;
use App\Entity\Mixture\Mixtures;
use App\Entity\Mixture\MixtureUsage;
use App\Entity\Supplier\Suppliers;
use App\Model\AssignMixture\AssignMixtureModel;
use PHPUnit\Framework\TestCase;

class AssignMixtureModelTest extends TestCase
{
    /** @var AssignMixtureModel */
    private $assignMixtureModel;

    /** @var GenericMixtures */
    private $genericMixture;

    /** @var MixtureUsage  */
    private $mixtureUsage;

    protected function setUp()
    {
        $genericMixture = new GenericMixtures();
        $mixtureUsage = new MixtureUsage();
        $mixture = new Mixtures();
        $supplier = new Suppliers();
        $company = new Companies();
        $companyMixture = new CompanyMixtures();

        $genericMixture->setName('name');
        $genericMixture->setMixture($mixture);
        $companyMixture->setGenericMixture($genericMixture);
        $companyMixture->setCompany($company);
        $mixture->setSupplier($supplier);
        $supplier->setName('supplier');
        $mixtureUsage->setCompanyMixture($companyMixture);

        $this->genericMixture = $genericMixture;
        $this->mixtureUsage = $mixtureUsage;

        $this->assignMixtureModel = new AssignMixtureModel();
    }

    public function testShouldReturnArrayCompanyDoNotHaveAssignMixture()
    {
        $result = $this->assignMixtureModel->createFoundedTable($this->genericMixture, $this->mixtureUsage);

        $this->assertArrayHasKey('id_generic_mixture', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('supplier_name', $result);
        $this->assertArrayHasKey('exist', $result);
        $this->assertNull($result['exist']);
    }

    public function testShouldReturnAssignMixtureToCompany()
    {
        $mixtureUsage = array($this->mixtureUsage);

        $result = $this->assignMixtureModel->createFoundedTable($this->genericMixture, $mixtureUsage);

        $this->assertTrue($result['exist']);
    }
}