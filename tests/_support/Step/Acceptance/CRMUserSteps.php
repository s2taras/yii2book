<?php
namespace Step\Acceptance;

class CRMUserSteps extends \AcceptanceTester
{
    /**
     * Go to the /customers/query
     */
    public function amInQueryCustomerUi()
    {
        $I = $this;
        $I->amOnPage('/customers/query');
    }

    /**
     * Fill phone
     *
     * @param $customer_data
     */
    public function fillInPhoneFieldWithDataForm($customer_data)
    {
        $I = $this;
        $I->fillField('PhoneRecord[number]', $customer_data['PhoneRecord[number]']);
    }

    /**
     * Click on the Search button
     */
    public function clickSearchButton()
    {
        $I = $this;
        $I->click('Search');
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
     * Find customer name in the page by selector
     *
     * @param $customer_data
     */
    public function seeCustomerInList($customer_data)
    {
        $I = $this;
        $I->see($customer_data['CustomerRecord[name]'], '#search_results');
    }

    /**
     * Dont find customer name in the page by selector
     *
     * @param $customer_data
     */
    public function dontSeeCustomerInList($customer_data)
    {
        $I = $this;
        $I->dontSee($customer_data['CustomerRecord[name]'], '#search_results');
    }
}
