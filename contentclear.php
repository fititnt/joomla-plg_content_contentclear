<?php
/*
 * @package         plg_contentclear
 * @author          Emerson Rocha Luiz (emerson@alligo.com.br)
 * @copyright       Copyright (C) 2005 - 2018 Alligo LTDA.
 * @license         GPL3
 */

defined('_JEXEC') or die;

/**
 * Example Content Plugin
 *
 * @since  1.6
 */
class PlgContentContentclear extends JPlugin
{

	/**
	 * see https://www.sitepoint.com/community/t/remove-inline-style-with-preg-replace/21743/3
	 * see https://stackoverflow.com/questions/5517255/remove-style-attribute-from-html-tags
	 * see https://stackoverflow.com/questions/7740249/how-to-strip-style-attributes-from-html-tags
	 **/
	private function _clean($htmlstring) {
		$domd = new DOMDocument();
		libxml_use_internal_errors(true);
		$domd->loadHTML($html);
		libxml_use_internal_errors(false);

		$domx = new DOMXPath($domd);
		$items = $domx->query("//span[@style]");
		
		foreach($items as $item) {
		  $item->removeAttribute("style");
		}
		
		return $domd->saveHTML();
	}


	/**
	 * This is an event that is called right before the content is saved into 
	 * the database.
	 *
	 * @param   string   $context  The context of the content passed to the plugin (added in 1.6)
	 * @param   object   $article  A JTableContent object
	 * @param   boolean  $isNew    If the content is just about to be created
	 *
	 * @return  boolean   true if function not enabled, is in frontend or is new. Else true or
	 *                    false depending on success of save function.
	 *
	 * @since   1.6
	 */
	public function onContentBeforeSave($context, $article, $isNew)
	{

		//die();
		// Check we are handling the frontend edit form.
		if ($context !== 'com_content.article')
		{
			return true;
		}


		// print_r($article->introtext. 'TEEESTE 1111');
		// print_r($this->_clean($article->introtext) . 'TEEESTE 2222');
		// die ();
		$article->introtext = 'oioioi' . $article->introtext . $this->_clean($article->introtext);
		echo $article->introtext ;
		die;
		// $article->introtext = $this->_clean($article->introtext);

		//...,

		return true;
	}

}
