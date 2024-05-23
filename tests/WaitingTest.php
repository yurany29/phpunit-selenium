<?php

class WaitingTest extends PHPUnit_Extensions_Selenium2TestCase{

	public function setUp()
	{
		$this->setBrowserUrl('http://localhost/phpunit_selenium/src/testingHtmlPage.html');

		$this->setBrowser('MicrosoftEdge');

		$this->setDesiredCapabilities([
			'ms:edgeOptions' => [
				'w3c' => false
			]
		]); //phpunit-selenium does not support W3C mode yet
	}

	public function testExplicitWait()
	{
		$this->url('');

		$driver = $this;

		$this->waitUntil(function() use($driver){

			$item = $driver->byId('first-name');

			if ($item->value() === 'Adam') return true;
			return null;
		}, 4000);

		$this->assertSame('Adam', $this->byId('first-name'));
	}
}