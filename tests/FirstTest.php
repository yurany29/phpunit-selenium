<?php


class FirstTest extends PHPUnit_Extensions_Selenium2TestCase{

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

	public function testTitle()
	{
		$this->url('');
		$this->assertEquals('HTML by Adam Morse, mrmrs.cc', $this->title());
	}
	public function testGettingElements()
	{
		$this->url('');

		$h1 = $this->byCssSelector('header h1'); //p.class p#id input [name="myname"] .alert.alert-danger

		$this->assertContains('HTML', $h1->text());

		$h1 = $this->elements($this->using('css selector')->value('h1'));

		$this->assertEquals(16, count($h1));

		$this->assertContains('Headings', $h1[2]->text());

		$field = $this->byId('first-name');

		$this->assertSame('Adam', $field->value()); //$field->name()

		$this->assertSame('Adam', $field->attribute('value'));

		$link = $this->byId('google-link-id');//$this->byName  $this->byClassName
		
		// $href = $link->attribute('href);

		$this->assertSame('Google', $link->text());

		//$this->clickOnElement('google-link-id');
		$link->click();
		$this->assertEquals('Google', $this->title());
		//$this->url('');
		$this->back();
		//$this->forward();
		$this->refresh();

		$content = $this->byTag('body')->text();

		$this->assertContains('Every html element in one place. Just waiting to be styled', $content);

		$this->assertContains('At vero eos et accusamus', $this->source());
	}
}

