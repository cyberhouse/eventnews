<?php

namespace GeorgRinger\Eventnews\Aspect;

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

class NewsImportAspect
{

    /**
     * @param array $importData
     * @param \GeorgRinger\News\Domain\Model\News $news
     * @return void
     */
    public function postHydrate(array $importData, $news)
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
