<?php

namespace GeorgRinger\Eventnews\Hooks;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class FormEngineHook
 */
class FormEngineHook
{
    const FIELDS = 'full_day,event_end,organizer,organizer_simple,location,location_simple';

    /**
     * Remove rendered field from output if it is no event
     *
     * @param string $table
     * @param string $field
     * @param array $row
     * @param string $out
     * @return void
     */
    public function getSingleField_postProcess($table, $field, $row, &$out)
    {
        if ($table === 'tx_news_domain_model_news' && $row['is_event'] == 0) {
            if (GeneralUtility::inList(self::FIELDS, $field)) {
                $out = '';
            }
        }
    }
}
