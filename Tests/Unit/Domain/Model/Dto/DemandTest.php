<?php

namespace GeorgRinger\Eventnews\Tests\Unit\Domain\Model;

use GeorgRinger\Eventnews\Domain\Model\Dto\Demand;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class DemandTest extends UnitTestCase
{

    /** @var Demand */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new Demand();
    }

    /**
     * @test
     */
    public function setOrganizer()
    {
        $value = [
            3 => 3,
            4 => 4
        ];
        $this->subject->setOrganizers($value);

        $this->assertEquals($value, $this->subject->getOrganizers());
    }

    /**
     * @test
     */
    public function setLocation()
    {
        $value = [
            4 => 4,
            5 => 5,
            6 => null
        ];
        $valueCleaned = [
            4 => 4,
            5 => 5,
        ];
        $this->subject->setLocations($value);

        $this->assertEquals($valueCleaned, $this->subject->getLocations());
    }
}
