<?php
defined('ZOTOP') OR die('No direct access allowed.');
/*
* 在线客服 首页控制器
*
* @package		kefu
* @version		1.8
* @author		
* @copyright	
* @license		
*/
class kefu_controller_index extends site_controller
{
	/**
	 * 重载__init函数
	 */
	public function __init()
	{
		parent::__init();

	}

	/**
	 * index 动作
	 *
	 */
	public function action_index()
    {

		$this->assign('title',t('在线客服'));
		$this->assign('data',$data);
		$this->display('kefu/index.php');
	}
}
?>