<?php

namespace GeorgRinger\Eventnews\Tests\Unit\Domain\Model;

use GeorgRinger\Eventnews\Domain\Model\Location;
use GeorgRinger\Eventnews\Domain\Model\News;
use GeorgRinger\Eventnews\Domain\Model\Organizer;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class NewsTest extends UnitTestCase
{

    /**
     * @var News
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new News();
    }

    /**
     * @test
     */
    public function setIsEvent()
    {
        $value = true;
        $this->subject->setIsEvent($value);

        $this->assertEquals($value, $this->subject->getIsEvent());
    }

    /**
     * @test
     */
    public function setFullDay()
    {
        $value = true;
        $this->subject->setFullDay($value);

        $this->assertEquals($value, $this->subject->getFullDay());
    }

    /**
     * @test
     */
    public function setEventEnd()
    {
        $value = new \DateTime('2014-10-10');
        $this->subject->setEventEnd($value);

        $this->assertEquals($value, $this->subject->getEventEnd());
    }

    /**
     * @test
     */
    public function setOrganizer()
    {
        $value = new Organizer();
        $value->setTitle('Organizer 1');
        $this->subject->setOrganizer($value);

        $this->assertEquals($value, $this->subject->getOrganizer());
    }

    /**
     * @test
     */
    public function setLocation()
    {
        $value = new Location();
        $value->setTitle('Location1 1');
        $this->subject->setLocation($value);

        $this->assertEquals($value, $this->subject->getLocation());
    }
}
