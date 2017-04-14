<?php

namespace GeorgRinger\Eventnews\Tests\Unit\Domain\Model;

use GeorgRinger\Eventnews\Domain\Model\Organizer;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class OrganizerTest extends UnitTestCase
{

    /** @var Organizer */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new Organizer();
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
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
    public function setLink()
    {
        $value = 'www.typo3.org';
        $this->subject->setLink($value);

        $this->assertEquals($value, $this->subject->getLink());
    }
}
