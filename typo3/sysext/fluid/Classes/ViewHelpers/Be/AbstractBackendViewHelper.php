<?php
namespace TYPO3\CMS\Fluid\ViewHelpers\Be;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is backported from the TYPO3 Flow package "TYPO3.Fluid".
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

use TYPO3\CMS\Backend\Template\DocumentTemplate;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * The abstract base class for all backend view helpers
 * Note: backend view helpers are still experimental!
 */
abstract class AbstractBackendViewHelper extends AbstractViewHelper {

	/**
	 * Gets instance of template if exists or create a new one.
	 * Saves instance in viewHelperVariableContainer
	 *
	 * @return DocumentTemplate $doc
	 */
	public function getDocInstance() {
		if ($this->viewHelperVariableContainer->exists(AbstractBackendViewHelper::class, 'DocumentTemplate')) {
			$doc = $this->viewHelperVariableContainer->get(AbstractBackendViewHelper::class, 'DocumentTemplate');
		} else {
			/** @var $doc DocumentTemplate */
			$doc = GeneralUtility::makeInstance(DocumentTemplate::class);
			$doc->backPath = $GLOBALS['BACK_PATH'];
			$this->viewHelperVariableContainer->add(AbstractBackendViewHelper::class, 'DocumentTemplate', $doc);
		}

		return $doc;
	}

}
