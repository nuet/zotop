{template 'header.php'}
<div class="side">
{template 'block/side.php'}
</div>

<div class="main side-main">
	<div class="main-header">
		<div class="title">{$category['name']} </div>

		<form class="searchbar" method="post" action="{u('block/block')}">
			<input type="text" name="keywords" value="{$keywords}" placeholder="{t('请输入关键词')}"  x-webkit-speech/>
			<button type="submit"><i class="icon icon-search"></i></button>
		</form>

		<div class="action">
			<div class="menu btn-menu">
				<a class="btn btn-highlight btn-icon-text" href="javascript:void(0);"><i class="icon icon-add"></i><b>{t('新建')}</b><b class="arrow"></b></a>
				<div class="dropmenu">
					<div class="dropmenulist">
						{loop $types $k $v}
							<a href="{u('block/block/add/'.$k.'/'.$category['id'])}"><i class="icon icon-item icon-{$k}"></i>{$v}</a>
						{/loop}
					</div>
				</div>
			</div>
		</div>
	</div><!-- main-header -->

	<div class="main-body scrollable">
		{form::header()}
		<table class="table zebra list sortable" id="datalist" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
			<td class="drag">&nbsp;</td>
			<td>{t('标题')}</td>
			<td class="w140">{t('标识')}</td>
			<td class="w180 none">{t('模板标签')}</td>
			<td class="w80">{t('类型')}</td>
			<td class="w160">{t('更新时间')}</td>
			</tr>
		</thead>
		<tbody>
		{if empty($data)}
			<tr class="nodata"><td colspan="4"><div class="nodata">{t('暂时没有任何数据')}</div></td></tr>
		{else}
		{loop $data $r}
			<tr>
				<td class="drag" title="{t('拖动排序')}" data-placement="left">&nbsp;<input type="hidden" name="id[]" value="{$r['id']}"></td>
				<td>
					<div class="title textflow" title="{$r['title']}"{if $r['style']}style="{$r['style']}"{/if}>
					{$r['name']}<span>{$r['description']}</span>
					</div>
					<div class="manage">
						<a href="{u('block/block/data/'.$r['id'])}">{t('数据管理')}</a>
						<s></s>
						<a class="ajax-post" href="{u('block/block/publish/'.$r['id'])}">{t('发布')}</a>
						<s></s>
						<a href="{u('block/block/edit/'.$r['id'])}">{t('设置')}</a>
						<s></s>
						<a class="dialog-confirm" href="{u('block/block/delete/'.$r['id'])}">{t('删除')}</a>
					</div>
				</td>
				<td>{$r['uid']}</td>
				<td class="none"><input value="{$r['tag']}" class="text" style="width:80%"/></td>
				<td><div class="textflow">{$types[$r['type']]}</div></td>
				<td>
					<div>{m('system.user.get', $r['userid'], 'username')}</div>
					<div class="f12 time">{format::date($r['updatetime'])}</div>
				</td>
			</tr>
		{/loop}
		{/if}
		</tbody>
		</table>
		{form::footer()}
	</div><!-- main-body -->
	<div class="main-footer">
		<div class="tips">{t('拖动列表项可以调整顺序')}</div>
	</div><!-- main-footer -->

</div><!-- main -->
<script type="text/javascript">
//sortable
$(function(){
	$("table.sortable").sortable({
		items: "tbody > tr",
		axis: "y",
		placeholder:"ui-sortable-placeholder",
		helper: function(e,tr){
			tr.children().each(function(){
				$(this).width($(this).width());
			});
			return tr;
		},
		update:function(){
			var action = $(this).parents('form').attr('action');
			var data = $(this).parents('form').serialize();

			$.post(action, data, function(msg){
				$.msg(msg);
			},'json');
		}
	});
});
</script>
{template 'footer.php'}