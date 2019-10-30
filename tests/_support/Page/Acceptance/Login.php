<?php
namespace Page\Acceptance;

class Login
{
    // include url of current page
    public static $URL = '/';

    public static $employeeUsername = 'employee';
    public static $employeePassword = 'employee';
    public static $leaderUsername = 'leader';
    public static $leaderPassword = 'leader';

    public $usernameField = '#asdasd';
    public $passwordField = '#xfgmasda';
    public $formSubmitButton = "#prelogin";

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }

    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

    public function login($username, $password)
    {
        $I = $this->acceptanceTester;

        $I->amOnPage(self::$URL);
        $I->waitForElementVisible($this->usernameField, 10);
        $I->fillField($this->usernameField, $username);
        $I->fillField($this->passwordField, $password);
        $I->click($this->formSubmitButton);
    }
}
