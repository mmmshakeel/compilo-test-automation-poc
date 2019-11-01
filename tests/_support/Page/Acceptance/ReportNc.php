<?php
namespace Page\Acceptance;

class ReportNc
{
    // include url of current page
    public static $URL = '';

    public $pageTitle = 'NC';
    public $confirmationPageTitle = 'Forhåndsvisning';

    public $reportNcIcon = '/html/body/span[2]/span[1]/div/span[2]/span[1]/a[1]';
//    public $reportNcIcon = ['xpath' => '/html/body/span[2]/span[1]/div/span[2]/span[1]/a[1]'];
//    public $reportNcIcon = 'Report NC';
    public $subjectField = '#newreptexts';
    public $startReportButton = '#startReportSubmit';

    public $reportingUnitSelector = '#NcWizEnhId';

    public $severityLow = '#agx1';
    public $severityMedium = '#agx2';
    public $severityHigh = '#agx3';

    public $dateSelector = '#nctxtDate';
    public $calendarDate = ['xpath' => '//*[@id="actionday"]/div/table/tbody/tr[1]/td[5]/a'];
    public $timeHour = 'time';
    public $timeMin = 'min';

    public $descriptionField = '#ksxavvikskjema textarea[name=skildring]';

    // categories
    public $categoryHse = '#kategoriChkBx3';
    public $categoryOrganization = '#kategoriChkBx2';
    public $categoryServices = '#kategoriChkBx1';
    public $categoryEnvironmental = '#kategoriChkBx2960009';

    public $consequencesField = '#ksxavvikskjema textarea[name=konsekvenser]';

    public $improvementsField = '#ksxavvikskjema textarea[name=forslag]';

    public $NcSubmitButton = ['xpath' => '//*[@id="ksxavvikskjema"]/span[2]/span/a[3]'];
    public $NcConfirmSubmitButton = '#wizsendinn';

    public $leaderOpenReports = ['xpath' => '//*[@id="tlGroup4"]/a'];
    public $leaderReportList = '#inbxResList';
    public $leaderFirstReportEl = ['xpath' => '//*[@id="inbxResList"]/span[1]'];
    public $leaderStatusEl = ['xpath' => '//*[@id="avvikreport26"]/span[4]/span[1]'];
    public $leaderStatusNotRead = 'Not read';
    public $leaderStatusClosed = 'Closed';


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

    private function getSeverity($severity)
    {
        switch ($severity) {
            case 'low':
                return $this->severityLow;
            case 'medium':
                return $this->severityMedium;
            case 'high':
                return $this->severityHigh;
            default:
                return $this->severityLow;
        }
    }

    private function getCategory($category)
    {
        switch ($category) {
            case 'hse':
                return $this->categoryHse;
            case 'organization':
                return $this->categoryOrganization;
            case 'services':
                return $this->categoryServices;
            case 'environmental':
                return $this->categoryEnvironmental;
            default:
                return $this->categoryHse;
        }
    }

    public function createNc($data)
    {
        $I = $this->acceptanceTester;

        $I->wait(5);
        $I->click($this->reportNcIcon);
        $I->wait(10);
//        $I->waitForElementVisible($this->subjectField);
        $I->fillField($this->subjectField, $data['subject']);
        $I->click($this->startReportButton);

        $I->click($this->reportingUnitSelector);
        $I->selectOption($this->reportingUnitSelector, $data['reportingUnit']);

        //add NC Details
        $I->wait(5);
        $I->click($this->getSeverity($data['severity']));

        //pickdate
        $I->click($this->dateSelector);
        $I->click($this->calendarDate);
        $I->selectOption($this->timeHour,$data['timeHour']);
        $I->selectOption($this->timeMin,$data['timeMin']);

        //Description
        $I->fillField($this->descriptionField, $data['description']);

        //category
        $I->click($this->getCategory($data['category']));

        //Consequences
        $I->fillField($this->consequencesField, $data['consequences']);

        //improvement
        $I->fillField($this->improvementsField, $data['improvement']);

        //submit
        $I->click($this->NcSubmitButton);
    }

    public function submitConfirm()
    {
        $I = $this->acceptanceTester;
        $I->click($this->NcConfirmSubmitButton);
        $I->acceptPopup();
    }
}
