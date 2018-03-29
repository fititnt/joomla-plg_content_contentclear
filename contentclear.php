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
class PlgContentclear extends JPlugin
{
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
		if ($context !== 'com_content.form')
		{
			return true;
		}

		//...,

		return $result;
	}

}
