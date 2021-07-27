<?php
use Illuminate\Database\Seeder;
//use Faker\Generator as Faker;

class UserCest
{
    // php vendor/bin/codecept run acceptance --steps --env=chrome
    public function _before(AcceptanceTester $I)
    {
    }

    /**
     * @run php vendor/bin/codecept run tests/acceptance/UserCest:createUser --steps --env=chrome
     * @param AcceptanceTester $I
     * @env chrome
     */
    //
    public function createUser(AcceptanceTester $I)
    {
        $faker = Faker\Factory::create();
        $I->amOnPage('/');
        $I->see('Laravel');
        $I->resizeWindow(1920, 1080);
        $I->waitForElement('#start_user_create', 5);
        $I->click('#start_user_create');
        $I->fillField('#user_name', $faker->name);
        $I->fillField('#user_email', $faker->email);
        $I->fillField('#user_phone', $faker->regexify('(06)[0-9]{9}'));
        $I->checkOption('#user_is_active');
        $I->fillField('#user_date_of_birth', $faker->date);
        $I->click('#user_create');
        $I->wait( 3);
        $I->dontSeeElement('#errors');

        //TODO: check database
    }

    /**
     * @run php vendor/bin/codecept run tests/acceptance/UserCest:editUser --steps --env=chrome
     * @param AcceptanceTester $I
     * @env chrome
     */
    public function editUser(AcceptanceTester $I)
    {
        $faker = Faker\Factory::create();
        $I->amOnPage('/');
        $I->see('Laravel');
        $I->resizeWindow(1920, 1080);
        $I->waitForElement('#start_user_edit', 3);
        $I->click('#start_user_edit');
        $I->fillField('#user_name', $faker->name);
        $I->fillField('#user_email', $faker->email);
        $I->fillField('#user_phone', $faker->regexify('(06)[0-9]{9}'));
        $I->checkOption('#user_is_active');
        $I->fillField('#user_date_of_birth', $faker->date);
        $I->click('#user_edit');
        $I->wait( 3);
        $I->dontSeeElement('#errors');

        //TODO: check database
    }

    /**
     * @run php vendor/bin/codecept run tests/acceptance/UserCest:deleteUser --steps --env=chrome
     * @param AcceptanceTester $I
     * @env chrome
     */
    public function deleteUser(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Laravel');
        $I->resizeWindow(1920, 1080);
        $I->waitForElement('#user_delete', 3);
        $I->click('#user_delete');
        $I->wait( 3);
        $I->dontSeeElement('#errors');

        //TODO: check database
    }
}
