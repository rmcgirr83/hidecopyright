<?php
/**
*
* Hide Copyright extension for the phpBB Forum Software package.
*
* @copyright 2020 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/
namespace rmcgirr83\hidecopyright\event;

/**
* @ignore
*/
use phpbb\language\language;
use phpbb\template\template;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var language */
	protected $language;

	/** @var template */
	protected $template;

	/**
	* Constructor
	*
	*/
	public function __construct (
			language $language,
			template $template)
	{
		$this->language = $language;
		$this->template = $template;
	}

	static public function getSubscribedEvents ()
	{
		return array(
			'core.acp_extensions_run_action_after'	=>	'acp_extensions_run_action_after',
		);
	}

	/* Display additional metdate in extension details
	*
	* @param $event			event object
	* @param return null
	* @access public
	*/
	public function acp_extensions_run_action_after($event)
	{
		if ($event['ext_name'] == 'rmcgirr83/hidecopyright' && $event['action'] == 'details')
		{
			$this->language->add_lang('common', $event['ext_name']);
			$this->template->assign_var('S_BUY_ME_A_BEER_HIDECOPYRIGHT', true);
		}
	}
}
