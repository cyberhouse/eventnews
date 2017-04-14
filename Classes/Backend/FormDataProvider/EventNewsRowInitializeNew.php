<?php

namespace GeorgRinger\Eventnews\Backend\FormDataProvider;

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

use TYPO3\CMS\Backend\Form\FormDataProviderInterface;

/**
 * Fill the news records with default values
 */
class EventNewsRowInitializeNew implements FormDataProviderInterface
{

    /**
     * @param array $result
     * @return array
     */
    public function addData(array $result)
    {
        if ($result['command'] !== 'new' || $result['tableName'] !== 'tx_news_domain_model_news') {
            return $result;
        }

        if (is_array($result['pageTsConfig']['tx_news.']) && (int)$result['pageTsConfig']['tx_news.']['newRecordAsEvent'] == 1) {
            $result['databaseRow']['is_event'] = 1;
        }

        return $result;
    }
}
