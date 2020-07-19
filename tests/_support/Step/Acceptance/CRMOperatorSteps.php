<?php
namespace Step\Acceptance;

use Faker\Factory;

class CRMOperatorSteps extends \AcceptanceTester
{
    /**
     * Go to the /customer/add
     */
    public function amInAddCustomerUi()
    {
        $I = $this;
        $I->amOnPage('/customer/add');
    }

    /**
     * Return fake customer data
     *
     * @return array
     */
    public function imagineCustomer()
    {
        $faker = Factory::create();

        return [
            'CustomerRecord[name]' => $faker->name,
            'CustomerRecord[birth_date]' => $faker->date('Y-m-d'),
            'CustomerRecord[notes]' => $faker->sentence(8),
            'PhoneRecord[number]' => $faker->phoneNumber,
        ];
    }

    /**
     * Fill customer data
     *
     * @param $fieldsData
     */
    public function fillCustomerDataForm($fieldsData)
    {
        $I = $this;
        foreach ($fieldsData as $key => $value) {
            $I->fillField($key, $value);
        }
    }

    /**
     * Click on Submit button
     */
    public function submitCustomerDataForm()
    {
        $I = $this;
        $I->click('Submit');
    }

    /**
     * Check if we exist in the list
     */
    public function seeIAmInListCustomersUi()
    {
        $I = $this;
        $I->seeCurrentUrlMatches('/customers/');
    }

    /**
     * Go to the /customers
     */
    function amInListCustomersUi()
    {
        $I = $this;
        $I->amOnPage('/customers');
    }
}
