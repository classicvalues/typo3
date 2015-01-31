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

use \TYPO3\CMS\Backend\Utility\BackendUtility;
use \TYPO3\CMS\Backend\Utility\IconUtility;

/**
 * View helper which return page info icon as known from TYPO3 backend modules
 * Note: This view helper is experimental!
 *
 * = Examples =
 *
 * <code>
 * <f:be.pageInfo />
 * </code>
 * <output>
 * Page info icon with context menu
 * </output>
 */
class PageInfoViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Be\AbstractBackendViewHelper {

	/**
	 * Render javascript in header
	 *
	 * @return string the rendered page info icon
	 * @see \TYPO3\CMS\Backend\Template\DocumentTemplate::getPageInfo() Note: can't call this method as it's protected!
	 */
	public function render() {
		$doc = $this->getDocInstance();
		$id = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
		$pageRecord = BackendUtility::readPageAccess($id, $GLOBALS['BE_USER']->getPagePermsClause(1));
		// Add icon with clickmenu, etc:
		if ($pageRecord['uid']) {
			// If there IS a real page
			$alttext = BackendUtility::getRecordIconAltText($pageRecord, 'pages');
			$iconImg = IconUtility::getSpriteIconForRecord('pages', $pageRecord, array('title' => htmlspecialchars($alttext)));
			// Make Icon:
			$theIcon = $doc->wrapClickMenuOnIcon($iconImg, 'pages', $pageRecord['uid']);
		} else {
			// On root-level of page tree
			// Make Icon
			$iconImg = '<img' . IconUtility::skinImg($GLOBALS['BACK_PATH'], 'gfx/i/_icon_website.gif') . ' alt="' . htmlspecialchars($GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename']) . '" />';
			if ($GLOBALS['BE_USER']->user['admin']) {
				$theIcon = $doc->wrapClickMenuOnIcon($iconImg, 'pages', 0);
			} else {
				$theIcon = $iconImg;
			}
		}
		// Setting icon with clickmenu + uid
		$pageInfo = $theIcon . '<em>[pid: ' . $pageRecord['uid'] . ']</em>';
		return $pageInfo;
	}

}
