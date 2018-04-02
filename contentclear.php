<?php
	/*
 * @package         plg_content_contentclear
 * @author          Emerson Rocha Luiz (emerson@alligo.com.br)
 * @license         Public Domain
 */

defined('_JEXEC') or die;

class PlgContentContentclear extends JPlugin
{
	/**
	 * Not implemented
	 */
	protected $dom_replace = [
	];

	/**
	 * @see     http://php.net/manual/function.preg-replace.php
	 */
	protected $regex_replace = [
	];

	/**
	 * @see     http://php.net/manual/function.str-replace.php
	 */
	protected $simple_replace = [
		'span style="font-size: 12.16px;"' => 'span'
	];


	/**
	 * Cleans one HTML string based on simple string replace and regex replace.
	 * It will show a message on joomla administration if changed something on
	 * the HTML created.
	 *
	 * @todo    A more serious implementation would use DOM manipulation, since
	 *          Simple string replace and even regex are not really reliable.
	 *          Implemement DOM manipulation if necessary on the future
	 *          (fititnt, 2018-04-01 21:01 BRT)
	 *
	 * @param   string   $htmlstring  HTML string to be manipulated
	 *
	 * @return  string
	 **/
	private function _clean($htmlstring) {
		if (!empty($htmlstring) && is_string($htmlstring)) {
			$original_string = $htmlstring;
			$diff = 0;

			if (!empty($this->simple_replace)){
				foreach($this->simple_replace AS $pattern => $replacement) {
					$htmlstring = str_replace($pattern, $replacement, $htmlstring);
				}
			}
			if (!empty($this->preg_replace)){
				foreach($this->preg_replace AS $pattern => $replacement) {
					$htmlstring = str_replace($pattern, $replacement, $htmlstring);
				}
			}

			$diff = strlen($original_string) - strlen($htmlstring);
			if ($diff) {
				JFactory::getApplication()->enqueueMessage(JText::sprintf('PLG_CONTENTCLEAR_DIFFCOUNT', $diff));
			}

			// NOTE:$this->dom_replace is not implemented
		}

		return $htmlstring;
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
		// Check we are handling the frontend edit form.
		if ($context !== 'com_content.article')
		{
			return true;
		}

		$article->introtext = $this->_clean($article->introtext);
		$article->fulltext = $this->_clean($article->fulltext);

		return true;
	}

}
