<?php

namespace GeorgRinger\Eventnews\Tests\Unit\Domain\Model;

use GeorgRinger\Eventnews\Domain\Model\Dto\Demand;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class DemandTest extends UnitTestCase {

	/** @var Demand */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new Demand();
	}

	/**
	 * @test
	 */
	public function setOrganizer() {
		$value = array(
			3 => 3,
			4 => 4
		);
		$this->subject->setOrganizers($value);

		$this->assertEquals($value, $this->subject->getOrganizers());
	}

	/**
	 * @test
	 */
	public function setLocation() {
		$value = array(
			4 => 4,
			5 => 5,
			6 => NULL
		);
		$valueCleaned = array(
			4 => 4,
			5 => 5,
		);
		$this->subject->setLocations($value);

		$this->assertEquals($valueCleaned, $this->subject->getLocations());
	}

}
