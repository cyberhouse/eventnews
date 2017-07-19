<?php

namespace GeorgRinger\Eventnews\ViewHelpers;

use TYPO3\CMS\Core\Utility\HttpUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Redirect a given url
 * <f:if condition="{news -> f:count()} == 1">
 *   <f:if condition="{demand.day}">
 *       <f:for each="{news}" as="newsItem">
 *           <events:redirect url="{n:link(newsItem:newsItem,settings:settings,uriOnly:1,configuration:{forceAbsoluteUrl:1})}" />
 *       </f:for>
 *   </f:if>
 *  </f:if>
 */
class RedirectViewHelper extends AbstractViewHelper
{

    /**
     * @param string $url
     */
    public function render($url)
    {
        if ($url) {
            HttpUtility::redirect($url);
        }
    }
}
