<?php

namespace GeorgRinger\Eventnews\Tests\Unit\Domain\Model;

use GeorgRinger\Eventnews\Domain\Model\Location;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class LocationTest extends UnitTestCase
{

    /**
     * @var Location
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new Location();
    }

    /**
     * @test
     */
    public function setTitle()
    {
        $value = 'A title';
        $this->subject->setTitle($value);

        $this->assertEquals($value, $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function setDescription()
    {
        $value = 'A description';
        $this->subject->setDescription($value);

        $this->assertEquals($value, $this->subject->getDescription());
    }

    /**
     * @test
     */
    public function setLng()
    {
        $value = 1.2;
        $this->subject->setLng($value);

        $this->assertEquals($value, $this->subject->getLng());
    }

    /**
     * @test
     */
    public function setLat()
    {
        $value = 2.3;
        $this->subject->setLat($value);

        $this->assertEquals($value, $this->subject->getLat());
    }

    /**
     * @test
     */
    public function setLink()
    {
        $value = 'montagmorgen.at';
        $this->subject->setLink($value);

        $this->assertEquals($value, $this->subject->getLink());
    }
}
