<?php

namespace GeorgRinger\Eventnews\ViewHelpers\Filter;

use GeorgRinger\Eventnews\Domain\Model\News;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class OrganizerViewHelper extends AbstractViewHelper
{

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @param object $organizers
     * @param object $news
     * @param string $as
     * @return mixed
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception\InvalidVariableException
     */
    public function render($organizers, $news, $as = 'filteredOrganizers')
    {
        $filteredOrganizers = $availableOrganizers = [];
        foreach ($organizers as $organizerItem) {
            $availableOrganizers[$organizerItem->getUid()] = 1;
        }
        foreach ($news as $n) {
            /** @var News $n */
            $loc = $n->getOrganizer();
            if ($loc && isset($availableOrganizers[$loc->getUid()]) && !isset($filteredOrganizers[$loc->getUid()])) {
                $filteredOrganizers[$loc->getUid()] = $loc;
            }
        }
        $this->templateVariableContainer->add($as, $filteredOrganizers);
        $output = $this->renderChildren();
        $this->templateVariableContainer->remove($as);
        return $output;
    }
}
