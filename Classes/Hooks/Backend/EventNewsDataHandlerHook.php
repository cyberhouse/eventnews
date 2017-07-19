<?php

namespace GeorgRinger\Eventnews\Hooks\Backend;

use TYPO3\CMS\Backend\Utility\BackendUtility;

class EventNewsDataHandlerHook
{

    /**
     * Save a new news record as event if stated by tsconfig
     *
     * @param string $status status
     * @param string $table table name
     * @param int $recordUid id of the record
     * @param array $fields fieldArray
     * @param \TYPO3\CMS\Core\DataHandling\DataHandler $parentObject parent Object
     * @return void
     */
    public function processDatamap_postProcessFieldArray(
        $status,
        $table,
        $recordUid,
        array &$fields,
        \TYPO3\CMS\Core\DataHandling\DataHandler $parentObject
    ) {
        if ($status === 'new' && $table === 'tx_news_domain_model_news') {
            $tsconfig = BackendUtility::getPagesTSconfig($fields['pid']);
            if (isset($tsconfig['tx_news.']) && is_array($tsconfig['tx_news.']) && (int)$tsconfig['tx_news.']['newRecordAsEvent'] === 1) {
                $fields['is_event'] = 1;
            }
        }
    }
}
