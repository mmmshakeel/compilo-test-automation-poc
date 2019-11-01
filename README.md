# compilo-test-automation-poc
This project is a POC for test automation with Codeception

## How to run the tests
Navigate to the root folder of the project and run the respective commands below to start the selenium server for each browser.

#### Run tests in chrome browser
`java -Dwebdriver.chrome.driver=./drivers/chromedriver.exe -jar server/selenium-server-standalone-3.8.1jar`

Keep the selenium server running and run the following command in another terminal 

` vendor/bin/codecept run acceptance --steps --env=chrome`

#### Run tests in firefox browser
`java -Dwebdriver.gecko.driver=./drivers/geckodriver.exe -jar server/selenium-server-standalone-3.8.1.jar -enablePassThrough false`

Keep the selenium server running and run the following command in another terminal 

` vendor/bin/codecept run acceptance --steps --env=firefox`

#### Run tests in internet explorer
`java -Dwebdriver.ie.driver=drivers/IEDriverServer.exe -jar server/selenium-server-standalone-3.8.1.jar`

Keep the selenium server running and run the following command in another terminal 

` vendor/bin/codecept run acceptance --steps --env=ie`

## Generate reports
Pass the `--html` flag to the codecept command to generate an html report of the test

`vendor/bin/codecept run acceptance --steps --env=chrome --html`
