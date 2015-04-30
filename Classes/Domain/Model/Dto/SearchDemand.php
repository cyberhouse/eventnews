<?php

namespace GeorgRinger\Eventnews\Domain\Model\Dto;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

class SearchDemand {

	/** @var array */
	protected $locations;

	/** @var array */
	protected $organizers;

	/** @var array */
	protected $categories;

	/**
	 * @return array
	 */
	public function getLocations() {
		return $this->locations;
	}

	/**
	 * @param array $locations
	 */
	public function setLocations($locations) {
		$this->locations = $locations;
	}

	/**
	 * @return array
	 */
	public function getOrganizers() {
		return $this->organizers;
	}

	/**
	 * @param array $organizers
	 */
	public function setOrganizers($organizers) {
		$this->organizers = $organizers;
	}

	/**
	 * @return array
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * @param array $categories
	 */
	public function setCategories($categories) {
		$this->categories = $categories;
	}
}