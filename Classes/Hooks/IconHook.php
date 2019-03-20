<?php

namespace GeorgRinger\Eventnews\Hooks;

/**
 * Change news icon if it is an event
 */
class IconHook
{

    /**
     * @param array $params
     * @return string|null
     */
    public function run(array $params)
    {
        $row = $params['row'];
        if ($row['is_event']) {
            return 'ext-news-type-event';
        }

        return null;
    }
}
