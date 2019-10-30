<?php 

use \Page\Acceptance\Login;
use Page\Acceptance\ReportNc;

class ReportNcCest
{
    private $reportSubject1 = 'Test Subject 1';
    private $reportSubject2 = 'Test Subject 2';

    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function submitNcToPrimaryUnitAsEmployee(AcceptanceTester $I, Login $login, ReportNc $reportNc)
    {
        $login->login($login::$employeeUsername, $login::$employeePassword);

        $data = [
            'subject' => $this->reportSubject1,
            'severity' => 'low',
            'timeHour' => '8',
            'timeMin' => '30',
            'description' => 'This is a test decription added by automation test',
            'category' => 'hse',
            'consequences' => 'Consequences added by automation',
            'improvement' => 'improvement added by kasun',
            'reportingUnit' => 'Primary unit (Compilo, Leader)'
        ];

        $reportNc->createNc($data);

        //submit verification
        $I->wait(5);
        $I->see($reportNc->confirmationPageTitle);
        $I->see($data['subject']);
        $I->see('Compilo, ' . ucfirst($login::$employeeUsername));
        $I->see($data['reportingUnit']);
        $I->see(ucfirst($data['severity']));

        // submit NC
        $reportNc->submitConfirm();

        // verify the dashboard
        $I->wait(5);
        $I->see($data['subject']);
    }

    public function submitNcToSecondaryUnitAsEmployee(AcceptanceTester $I, Login $login, ReportNc $reportNc)
    {
        $login->login($login::$employeeUsername, $login::$employeePassword);

        $data = [
            'subject' => $this->reportSubject2,
            'severity' => 'low',
            'timeHour' => '8',
            'timeMin' => '30',
            'description' => 'This is a test decription added by automation test',
            'category' => 'hse',
            'consequences' => 'Consequences added by automation',
            'improvement' => 'improvements',
            'reportingUnit' => 'Secondary unit (Compilo, Leader)'
        ];

        $reportNc->createNc($data);

        //submit verification
        $I->wait(5);
        $I->see($reportNc->confirmationPageTitle);
        $I->see($data['subject']);
        $I->see('Compilo, ' . ucfirst($login::$employeeUsername));
        $I->see($data['reportingUnit']);
        $I->see(ucfirst($data['severity']));

        // submit NC
        $reportNc->submitConfirm();

        // verify the dashboard
        $I->wait(5);
        $I->see($data['subject']);
    }


}
