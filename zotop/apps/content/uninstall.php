<?php
defined('ZOTOP') OR die('No direct access allowed.');
defined('ZOTOP_UNINSTALL') OR die('No direct access allowed.');

/**
 * 卸载程序
 *
 * @package		system
 * @author		zotop team
 * @copyright	(c)2009 zotop team
 * @license		http://zotop.com/license.html
 */

// 卸载前检查数据表是否有数据，有则不允许删除
if ( $this->db->table('content')->count() )
{
	return $this->error(t('无法卸载，[ %s ] 数据表尚有数据', 'content'));
}

/*
 * 删除guestbook数据表
 */
$this->db->dropTable('content');
$this->db->dropTable('content_model');
$this->db->dropTable('content_category');
?>