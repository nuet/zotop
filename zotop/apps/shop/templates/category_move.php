{template 'dialog.header.php'}

{form::header()}
<div class="controls" style="margin:8px;height:280px;overflow:auto;">
		<table id="tree" class="table list hidden">
			<tbody>
				<tr data-tt-id="0" {if $category['parentid'] == 0}class="selected"{/if}>
					<td class="name"><i class="icon icon-folder"></i>{t('根类别')}</td>
				</tr>
				{loop m('shop.category.active') $c}
						<tr data-tt-id="{$c['id']}" data-tt-parent-id="{$c['parentid']}" {if $category['parentid'] == $c['id']}class="selected"{/if}>
							<td class="name"><i class="icon {if $c['childid']}icon-folder{else}icon-item{/if}"></i>{$c['name']}</td>
						</tr>
				{/loop}
			</tbody>
		</table>
</div>
{form::footer()}

<link rel="stylesheet" type="text/css" href="{A('system.url')}/common/css/jquery.treetable.css"/>
<script type="text/javascript" src="{A('system.url')}/common/js/jquery.treetable.js"></script>
<script type="text/javascript">
	$(function(){
		$("#tree").treetable({
			column : 0,
			indent : 18,
			expandable : true,
			persist: true,
			initialState : 'collapsed', //"expanded" or "collapsed".
			clickableNodeNames : true,
			stringExpand: "{t('展开')}",
			stringCollapse: "{t('关闭')}"
		}).removeClass('hidden');

		$("#tree").treetable("reveal", "{$id}");



		$("#tree").find('tr').click(function(){
			$(this).addClass('selected').siblings("tr").removeClass('selected'); //单选
		});
	})

	// 对话框设置
	$dialog.callbacks['ok'] = function(){
		var action	= $('form').attr('action');
		var parentid = $('form').find('.selected').attr('data-tt-id');

		$.loading();
		$.post(action, {parentid : parentid}, function(msg){
			if( msg.state ){
				$dialog.close();
			}
			$.msg(msg);
		},'json');

		return false;
	};

	$dialog.title('{t('移动 %s 到选中栏目下',$category['name'])}');
</script>
{template 'dialog.footer.php'}