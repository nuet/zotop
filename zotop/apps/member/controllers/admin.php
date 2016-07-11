<?php
defined('ZOTOP') OR die('No direct access allowed.');
/*
* 会员 后台控制器
*
* @package		member
* @version		1.0
* @author		zotop.chenlei
* @copyright	zotop.chenlei
* @license		http://www.zotop.com
*/
class member_controller_admin extends admin_controller
{
	private $member;
	private $model;
	private $user;
	private $group;

	/**
	 * 重载__init函数
	 */
	public function __init()
	{
		parent::__init();

		$this->member = m('member.member');
		$this->model  = m('member.model');
		$this->group  = m('member.group');
		$this->user   = m('system.user');
	}


	/**
	 * 会员列表
	 * 
	 * @return mixed
	 */
	public function action_index()
    {

		$models  = $this->model->select();
		$groups  = $this->group->cache();

		if ( $keywords = trim($_GET['keywords']) )
		{
			$this->user->where(array(
				array('username','like',$keywords),'or',
				array('mobile','like',$keywords),'or',
				array('email','like',$keywords),'or',
				array('nickname','like',$keywords)
			));
		}

		$dataset = $this->user->where('modelid','in',array_keys($models))->orderby('logintime','desc')->paginate();

		$this->assign('title',t('会员管理'));
		$this->assign($dataset);
		$this->assign('keywords',$keywords);
		$this->assign('groups',$groups);
		$this->assign('models',$models);
		$this->display();
	}

	/**
	 * 多选操作
	 *
	 * @param $operation 操作
	 * @return mixed
	 */
    public function action_operate($operation, $v=null)
    {
		if ( $post = $this->post() )
		{
			switch($operation)
			{
				case 'delete' :
					$result = $this->member->delete($post['id']);
					break;
				case 'disabled' :
					$result = $this->member->disabled($post['id'], $v);
					break;
				default :
					break;
			}

			if ( $result )
			{
				return $this->success(t('%s成功',$post['operation']),request::referer());
			}

			$this->error(t('%s失败',$post['operation']));
		}

		$this->error(t('禁止访问'));
    }


	/**
	 * 添加会员
	 * 
	 * @param  string $modelid 模型标识
	 * @return mixed
	 */
	public function action_add($modelid)
    {
		if ( $post = $this->post() )
		{
			if ( $this->member->add($post) )
			{
				return $this->success(t('保存成功'),u('member/admin'));
			}

			return $this->error($this->member->error());
		}

		$data = array('modelid'=>$modelid);

		$fields = m('member.field')->formatted($modelid);

		$models = $this->model->get($modelid);

		$groups = arr::hashmap(m('member.group')->getModel($modelid),'id','name');

		$this->assign('title',t('添加%s', $models['name']));
		$this->assign('data',$data);
		$this->assign('groups',$groups);
		$this->assign('fields',$fields);
		$this->assign('models',$models);
		$this->display('member/admin_post.php');
	}


	/**
	 * 编辑会员
	 * 
	 * @param  int $id 会员编号
	 * @return mixed
	 */
	public function action_edit($id)
    {
		if ( $post = $this->post() )
		{
			if ( $this->member->edit($post, $id) )
			{
				return $this->success(t('保存成功'), request::referer());
			}

			return $this->error($this->member->error());
		}

		$data = $this->member->get($id);

		$fields = m('member.field')->formatted($data['modelid'], $data);

		$groups = arr::hashmap(m('member.group')->getModel($data['modelid']),'id','name');

		$models = $this->model->get($data['modelid']);

		$this->assign('title',t('编辑%s', $models['name']));
		$this->assign('data',$data);
		$this->assign('groups',$groups);
		$this->assign('fields',$fields);
		$this->assign('models',$models);
		$this->display('member/admin_post.php');
	}

	/**
	 * 删除会员
	 * 
	 * @param  int $id 会员编号
	 * @return mixed
	 */
	public function action_delete($id)
	{
		if ( $this->member->delete($id) )
		{
			return $this->success(t('删除成功'),u('member/admin'));
		}

		return $this->error($this->member->error());
	}
}
?>