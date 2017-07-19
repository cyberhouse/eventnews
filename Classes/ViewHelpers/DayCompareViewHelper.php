<?php

namespace GeorgRinger\Eventnews\ViewHelpers;

use GeorgRinger\Eventnews\Domain\Model\Dto\Demand;
use GeorgRinger\Eventnews\Domain\Model\News;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

class DayCompareViewHelper extends AbstractConditionViewHelper implements CompilableInterface
{

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        $this->registerArgument('newsItem', News::class, 'News item', true);
        $this->registerArgument('demand', Demand::class, 'demand object', true);
        parent::initializeArguments();
    }

    /**
     * @param array|null $arguments
     * @return bool
     */
    protected static function evaluateCondition($arguments = null)
    {

        /** @var Demand $demand */
        $demand = $arguments['demand'];
        /** @var News $newsItem */
        $newsItem = $arguments['newsItem'];

        $currentDay = \DateTime::createFromFormat('d-m-Y H:i:s', sprintf(
            '%s-%s-%s 00:00:01', $demand->getDay(), $demand->getMonth(), $demand->getYear()));

        $found = false;
        if ($demand->getDay() > 0) {
            $newsBeginDate = $newsItem->getDatetime()->format('Y-m-d');
            $day = date('Y-m-d', $currentDay->getTimestamp());

            if ($newsItem->getEventEnd() == 0) {
                if ($newsBeginDate === $day) {
                    $found = true;
                }
            } else {
                $newsEndDate = $newsItem->getEventEnd();
                $newsEndDate->setTime(23, 59, 59);
                $newsBeginDate = $newsItem->getDatetime();
                $newsBeginDate->setTime(0, 0);
                $currentDay->setTime(0, 0);

                if ($newsBeginDate <= $currentDay && $newsEndDate >= $currentDay) {
                    $found = true;
                }
            }
        }

        return $found;
    }
}
