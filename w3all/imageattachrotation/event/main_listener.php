<?php
/**
 *
 * Attachments Images Rotation. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2021, axew3, https://axew3.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace w3all\imageattachrotation\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Attachments Images Rotation Event listener.
 */
class main_listener implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		return array(
			'core.user_setup' => 'load_language_on_setup',
	                'core.page_head' => 'overall_header_head_append',
			'core.page_footer' => 'overall_footer_body_after',
		);
	}
	
	//protected $config;
        protected $language;
	//protected $helper;
	protected $template;
	protected $request;
	protected $phpbb_root_path;	
	protected $php_ext;

	//public function __construct(\phpbb\config\config $config, \phpbb\language\language $language, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\request\request_interface $request, $phpbb_root_path, $php_ext)
	public function __construct(\phpbb\language\language $language, \phpbb\template\template $template, \phpbb\request\request_interface $request, $phpbb_root_path, $php_ext)

{
		//$this->config = $config;
		$this->language = $language;
		//$this->helper   = $helper;
		$this->template = $template;
		$this->request = $request;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext  = $php_ext;
 }

	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'w3all/imageattachrotation',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}
	

	public function overall_header_head_append()
	{
	}	
	
	public function overall_footer_body_after()
	{ 
		
		$w3mode = $this->request->variable('mode', '');

    //$cookie_domain = empty($this->config['cookie_domain']) ? 'localhost' : $this->config['cookie_domain'];
    //$cookie_domain = $cookie_domain[0] == '.' ? substr($cookie_domain, 1) : $cookie_domain;

    // for Quick Reply condition on viewtopic, it is used S_QUICK_REPLY on file ext/w3all/imageattachrotation/styles/prosilver/template/event/overall_footer_body_after.html
		if( $w3mode != 'edit' && $w3mode != 'post' && $w3mode != 'reply' ){ 
			$w3mode = '';
		}

		$this->template->assign_vars(array( 
		 'W3IMAGEROTATION_YN_A'	=> $w3mode,
	 //'W3IMAGEROTATION_COOKIE'	=> $cookie_domain,
    ));
		
	 }
	
	
}
