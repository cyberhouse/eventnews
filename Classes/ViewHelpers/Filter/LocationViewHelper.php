<?php

namespace GeorgRinger\Eventnews\ViewHelpers\Filter;

use GeorgRinger\Eventnews\Domain\Model\News;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class LocationViewHelper extends AbstractViewHelper
{

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @param object $locations
     * @param object $news
     * @param string $as
     * @return mixed
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception\InvalidVariableException
     */
    public function render($locations, $news, $as = 'filteredLocations')
    {
        $filteredLocations = $availableLocations = [];
        foreach ($locations as $locationItem) {
            $availableLocations[$locationItem->getUid()] = 1;
        }
        foreach ($news as $n) {
            /** @var News $n */
            $loc = $n->getLocation();
            if ($loc && isset($availableLocations[$loc->getUid()]) && !isset($filteredLocations[$loc->getUid()])) {
                $filteredLocations[$loc->getUid()] = $loc;
            }
        }
        $this->templateVariableContainer->add($as, $filteredLocations);
        $output = $this->renderChildren();
        $this->templateVariableContainer->remove($as);
        return $output;
    }
}
