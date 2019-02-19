<?php namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class firtCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    /**
     * @param FunctionalTester     $I
     * @param \Codeception\Example $data
     *
     * @dataProvider pageProvider
     */
    public function tryRun(FunctionalTester $I, \Codeception\Example $data)
    {
        $I->amOnRoute($data['url']);
        $I->see($data['title'], '.active');
    }

    protected function pageProvider()
    {
        return [
            ['url' => 'site/index', 'title' => 'Home'],
            ['url' => 'site/about', 'title' => 'About'],
            ['url' => 'site/contact', 'title' => 'Contact'],
            ['url' => 'site/signup', 'title' => 'Signup'],
            ['url' => 'site/login', 'title' => 'Login'],
        ];
    }
}
