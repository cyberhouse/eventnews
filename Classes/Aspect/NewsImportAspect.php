<?php

declare(strict_types=1);

namespace GeorgRinger\Eventnews\Aspect;

/**
 * This file is part of the "eventnews" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */
class NewsImportAspect
{

    /**
     * @param array $importData
     * @param \GeorgRinger\News\Domain\Model\News $news
     */
    public function postHydrate(array $importData, $news): void
    {
        /** @var \GeorgRinger\Eventnews\Domain\Model\News $news */
        if (is_array($importData['_dynamicData'])) {
            if (isset($importData['_dynamicData']['location'])) {
                $news->setLocationSimple(trim($importData['_dynamicData']['location']));
            }
            if (!empty($importData['_dynamicData']['datetime_end'])) {
                $date = new \DateTime();
                $date->setTimestamp($importData['_dynamicData']['datetime_end']);
                $news->setEventEnd($date);
            }
        }
    }
}
