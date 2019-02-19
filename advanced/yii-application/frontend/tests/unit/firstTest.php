<?php namespace frontend\tests;

use frontend\models\ContactForm;

class firstTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testRun()
    {
        $testBoolean = true;
        $this->assertTrue($testBoolean, ' в сравнение с true');
        $testEqual = 25;
        $this->assertEquals(25, $testEqual, 'Тестовое число равно 25');
        $this->assertLessThan(35, $testEqual, 'Тестовое число меньше 35');
        $model = new ContactForm();
        $model->setAttributes(['name' => 'Max', 'email' => 'max@ya.ru', 'body' => 'text']);
        $this->assertAttributeEquals('Max', 'name', $model, 'Имя совпадает');
        $this->assertAttributeEquals('max@ya.ru', 'email', $model, 'email совпадает');
        $arr = [
            'key1' => 1,
            'key2' => 2,
        ];
        $this->assertArrayHasKey('key2', $arr);
    }

}