<?php

namespace GeorgRinger\Eventnews\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Georg Ringer, montagmorgen.at
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * News
 */
class News extends \GeorgRinger\News\Domain\Model\News
{

    /**
     * isEvent
     *
     * @var bool
     */
    protected $isEvent = false;

    /**
     * fullDay
     *
     * @var bool
     */
    protected $fullDay = false;

    /**
     * eventEnd
     *
     * @var \DateTime
     */
    protected $eventEnd = null;

    /**
     * organizer
     *
     * @var \GeorgRinger\Eventnews\Domain\Model\Organizer
     */
    protected $organizer = null;

    /**
     * location
     *
     * @var \GeorgRinger\Eventnews\Domain\Model\Location
     */
    protected $location = null;

    /**
     * @var string
     */
    protected $organizerSimple;

    /**
     * @var string
     */
    protected $locationSimple;

    /**
     * Returns the isEvent
     *
     * @return bool $isEvent
     */
    public function getIsEvent()
    {
        return $this->isEvent;
    }

    /**
     * Sets the isEvent
     *
     * @param bool $isEvent
     * @return void
     */
    public function setIsEvent($isEvent)
    {
        $this->isEvent = $isEvent;
    }

    /**
     * Returns the boolean state of isEvent
     *
     * @return bool
     */
    public function isIsEvent()
    {
        return $this->isEvent;
    }

    /**
     * Returns the fullDay
     *
     * @return bool $fullDay
     */
    public function getFullDay()
    {
        return $this->fullDay;
    }

    /**
     * Sets the fullDay
     *
     * @param bool $fullDay
     * @return void
     */
    public function setFullDay($fullDay)
    {
        $this->fullDay = $fullDay;
    }

    /**
     * Returns the boolean state of fullDay
     *
     * @return bool
     */
    public function isFullDay()
    {
        return $this->fullDay;
    }

    /**
     * Returns the eventEnd
     *
     * @return \DateTime $eventEnd
     */
    public function getEventEnd()
    {
        return $this->eventEnd;
    }

    /**
     * Sets the eventEnd
     *
     * @param \DateTime $eventEnd
     * @return void
     */
    public function setEventEnd(\DateTime $eventEnd)
    {
        $this->eventEnd = $eventEnd;
    }

    /**
     * Returns the organizer
     *
     * @return \GeorgRinger\Eventnews\Domain\Model\Organizer $organizer
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * Sets the organizer
     *
     * @param \GeorgRinger\Eventnews\Domain\Model\Organizer $organizer
     * @return void
     */
    public function setOrganizer(\GeorgRinger\Eventnews\Domain\Model\Organizer $organizer)
    {
        $this->organizer = $organizer;
    }

    /**
     * Returns the location
     *
     * @return \GeorgRinger\Eventnews\Domain\Model\Location $location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the location
     *
     * @param \GeorgRinger\Eventnews\Domain\Model\Location $location
     * @return void
     */
    public function setLocation(\GeorgRinger\Eventnews\Domain\Model\Location $location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getOrganizerSimple()
    {
        return $this->organizerSimple;
    }

    /**
     * @param string $organizerSimple
     */
    public function setOrganizerSimple($organizerSimple)
    {
        $this->organizerSimple = $organizerSimple;
    }

    /**
     * @return string
     */
    public function getLocationSimple()
    {
        return $this->locationSimple;
    }

    /**
     * @param string $locationSimple
     */
    public function setLocationSimple($locationSimple)
    {
        $this->locationSimple = $locationSimple;
    }
}
