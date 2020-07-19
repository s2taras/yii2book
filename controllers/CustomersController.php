<?php

namespace app\controllers;

use app\models\customer\Customer;
use app\models\customer\CustomerRecord;
use app\models\customer\Phone;
use app\models\customer\PhoneRecord;
use DateTime;
use Exception;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\Response;

class CustomersController extends Controller
{
    public function actionQuery()
    {
        return $this->render('query');
    }

    /**
     * @return string
     * @throws Exception
     */
    public function actionIndex()
    {
        $records = $this->findRecordByQuery();

        return $this->render('index', compact('records'));
    }

    /**
     * @return string|Response
     * @throws Exception
     */
    public function actionAdd()
    {
        $customer = new CustomerRecord();
        $phone = new PhoneRecord();

        if ($this->load($customer, $phone, $_POST)) {
            $this->store($this->makeCustomer($customer, $phone));

            return $this->redirect('/customers');
        }

        return $this->render('add', compact('customer', 'phone'));
    }

    /**
     * @param CustomerRecord $customer_record
     * @param PhoneRecord $phone_record
     * @param array $post
     * @return bool
     */
    private function load(CustomerRecord $customer_record, PhoneRecord $phone_record, array $post): bool
    {
        return $customer_record->load($post)
            && $phone_record->load($post)
            && $customer_record->validate()
            && $phone_record->validate(['number']);
    }

    /**
     * @param Customer $customer
     */
    private function store(Customer $customer)
    {
        $customer_record = new CustomerRecord();
        $customer_record->name = $customer->name;
        $customer_record->birth_date = $customer->birth_date->format('Y-m-d');
        $customer_record->notes = $customer->notes;
        $customer_record->save();

        foreach ($customer->phones as $phone) {
            $phone_record = new PhoneRecord();
            $phone_record->number = $phone->number;
            $phone_record->customer_id = $customer_record->id;
            $phone_record->save();
        }
    }

    /**
     * @param CustomerRecord $customer_record
     * @param PhoneRecord $phone_record
     * @return Customer
     * @throws Exception
     */
    private function makeCustomer(CustomerRecord $customer_record, PhoneRecord $phone_record): Customer
    {
        $name = $customer_record->name;
        $birth_date = new DateTime($customer_record->birth_date);

        $customer = new Customer($name, $birth_date);
        $customer->notes = $customer_record->notes;
        $customer->phones[] = new Phone($phone_record->number);

        return $customer;
    }

    /**
     * @return ArrayDataProvider
     * @throws Exception
     */
    private function findRecordByQuery(): ArrayDataProvider
    {
        $number = Yii::$app->request->get('phone_number');
        $records = $this->getRecordsByPhoneNumber($number);
        $dataProvider = $this->wrapIntoDataProvider($records);

        return $dataProvider;
    }

    /**
     * @param string $number
     * @return Customer[]
     * @throws Exception
     */
    private function getRecordsByPhoneNumber(?string $number): array
    {
        if ($number == null) {
            return [];
        }

        $phone_record = PhoneRecord::findOne(['number' => $number]);
        if (!$phone_record) {
            return [];
        }

        $customer_record = CustomerRecord::findOne($phone_record->customer_id);
        if (!$customer_record) {
            return [];
        }

        return [$this->makeCustomer($customer_record, $phone_record)];
    }

    /**
     * @param Customer[] $data
     * @return ArrayDataProvider
     */
    private function wrapIntoDataProvider(array $data): ArrayDataProvider
    {
        return new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => false,
        ]);
    }
}
