<?php

namespace GeorgRinger\Eventnews\ViewHelpers;

class FormViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\FormViewHelper {


	/**
	 * Render the form.
	 *
	 * @param string $action Target action
	 * @param array $arguments Arguments
	 * @param string $controller Target controller
	 * @param string $extensionName Target Extension Name (without "tx_" prefix and no underscores). If NULL the current extension name is used
	 * @param string $pluginName Target plugin. If empty, the current plugin name is used
	 * @param integer $pageUid Target page uid
	 * @param mixed $object Object to use for the form. Use in conjunction with the "property" attribute on the sub tags
	 * @param integer $pageType Target page type
	 * @param boolean $noCache set this to disable caching for the target page. You should not need this.
	 * @param boolean $noCacheHash set this to suppress the cHash query parameter created by TypoLink. You should not need this.
	 * @param string $section The anchor to be added to the action URI (only active if $actionUri is not set)
	 * @param string $format The requested format (e.g. ".html") of the target page (only active if $actionUri is not set)
	 * @param array $additionalParams additional action URI query parameters that won't be prefixed like $arguments (overrule $arguments) (only active if $actionUri is not set)
	 * @param boolean $absolute If set, an absolute action URI is rendered (only active if $actionUri is not set)
	 * @param boolean $addQueryString If set, the current query parameters will be kept in the action URI (only active if $actionUri is not set)
	 * @param array $argumentsToBeExcludedFromQueryString arguments to be removed from the action URI. Only active if $addQueryString = TRUE and $actionUri is not set
	 * @param string $fieldNamePrefix Prefix that will be added to all field names within this form. If not set the prefix will be tx_yourExtension_plugin
	 * @param string $actionUri can be used to overwrite the "action" attribute of the form tag
	 * @param string $objectName name of the object that is bound to this form. If this argument is not specified, the name attribute of this form is used to determine the FormObjectName
	 * @param string $hiddenFieldClassName
	 * @return string rendered form
	 */
	public function render($action = NULL, array $arguments = array(), $controller = NULL, $extensionName = NULL, $pluginName = NULL, $pageUid = NULL, $object = NULL, $pageType = 0, $noCache = FALSE, $noCacheHash = FALSE, $section = '', $format = '', array $additionalParams = array(), $absolute = FALSE, $addQueryString = FALSE, array $argumentsToBeExcludedFromQueryString = array(), $fieldNamePrefix = NULL, $actionUri = NULL, $objectName = NULL, $hiddenFieldClassName = NULL) {
		$this->setFormActionUri();
		if (strtolower($this->arguments['method']) === 'get') {
			$this->tag->addAttribute('method', 'get');
		} else {
			$this->tag->addAttribute('method', 'post');
		}
		$this->addFormObjectNameToViewHelperVariableContainer();
		$this->addFormObjectToViewHelperVariableContainer();
		$this->addFieldNamePrefixToViewHelperVariableContainer();
		$this->addFormFieldNamesToViewHelperVariableContainer();

		$content = $this->renderChildren();
		$this->tag->setContent($content);
		$this->removeFieldNamePrefixFromViewHelperVariableContainer();
		$this->removeFormObjectFromViewHelperVariableContainer();
		$this->removeFormObjectNameFromViewHelperVariableContainer();
		$this->removeFormFieldNamesFromViewHelperVariableContainer();
		$this->removeCheckboxFieldNamesFromViewHelperVariableContainer();
		return $this->tag->render();
	}

	/**
	 * Renders hidden form fields for referrer information about
	 * the current controller and action.
	 *
	 * @return string Hidden fields with referrer information
	 * @todo filter out referrer information that is equal to the target (e.g. same packageKey)
	 */
	protected function renderHiddenReferrerFields() {
		$request = $this->controllerContext->getRequest();
		$extensionName = $request->getControllerExtensionName();
		$vendorName = $request->getControllerVendorName();
		$controllerName = $request->getControllerName();
		$actionName = $request->getControllerActionName();
		$result = chr(10);
		if ($this->configurationManager->isFeatureEnabled('rewrittenPropertyMapper')) {
			$result .= '<input type="hidden" name="' . $this->prefixFieldName('__referrer[@extension]') . '" value="' . $extensionName . '" />' . chr(10);
			if ($vendorName !== NULL) {
				$result .= '<input type="hidden" name="' . $this->prefixFieldName('__referrer[@vendor]') . '" value="' . $vendorName . '" />' . chr(10);
			}
			$result .= '<input type="hidden" name="' . $this->prefixFieldName('__referrer[@controller]') . '" value="' . $controllerName . '" />' . chr(10);
			$result .= '<input type="hidden" name="' . $this->prefixFieldName('__referrer[@action]') . '" value="' . $actionName . '" />' . chr(10);
			$result .= '<input type="hidden" name="' . $this->prefixFieldName('__referrer[arguments]') . '" value="' . htmlspecialchars($this->hashService->appendHmac(base64_encode(serialize($request->getArguments())))) . '" />' . chr(10);
		} else {
			// @deprecated since Fluid 1.4.0, will be removed two versions after Fluid 6.1.
			$result .= '<input type="hidden" name="' . $this->prefixFieldName('__referrer[extensionName]') . '" value="' . $extensionName . '" />' . chr(10);
			$result .= '<input type="hidden" name="' . $this->prefixFieldName('__referrer[controllerName]') . '" value="' . $controllerName . '" />' . chr(10);
			$result .= '<input type="hidden" name="' . $this->prefixFieldName('__referrer[actionName]') . '" value="' . $actionName . '" />' . chr(10);
		}
		return $result;
	}

}