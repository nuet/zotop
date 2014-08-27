{template 'header.php'}
<div class="side main-side" style="width:300px;">
	<div class="side-header">{t('索引信息')}</div>
	<div class="side-body scrollable">
		<table class="table list">
		<thead>
			<tr>
				<td class="w60">{t('键名')}</td>
				<td class="w60">{t('类型')}</td>
				<td>{t('字段')}</td>
				<td class="w20"></td>
			</tr>
		</thead>
		<tbody>
		{if !empty($schema['primary']) and is_array($schema['primary'])}
			<tr class="red">
				<td><div class="textflow red" title="{$key}">PRIMARY</div></td>
				<td><span class="f12">PRIMARY</span></td>
				<td>
					{loop $schema['primary'] $i $f}
						{if $i>0}<hr />{/if}
						<div class="textflow f12"> {$f} </div>
						{$i++}
					{/loop}
				</td>
				<td><a class="dialog-confirm" href="{zotop::url('database/schema/dropprimary/'.$table)}" title="{t('删除')}"><span class="red">×</span></a></td>
			</tr>

		{/if}

		{loop $schema[unique] $key $field}
			<tr>
				<td><div class="textflow" title="{$key}">{$key}</div></td>
				<td><span class="f12">UNIQUE</span></td>
				<td>
					{loop $field $i $f}
						{if $i>0}<hr />{/if}
						<div class="textflow f12">{if is_array($f)} {$f[0]} <span class="f12 gray">|</span> {$f[1]} {else} {$f} {/if}</div>
						{$i++}
					{/loop}
				</td>
				<td><a class="dialog-confirm" href="{zotop::url('database/schema/dropindex/'.$table.'/'.$key)}" title="{t('删除')}"><span class="red">×</span></a></td>
			</tr>
		{/loop}

		{loop $schema[index] $key $field}
			<tr>
				<td><div class="textflow" title="{$key}">{$key}</div></td>
				<td><span class="f12">INDEX</span></td>
				<td>
					{loop $field $i $f}
						{if $i>0}<hr />{/if}
						<div class="textflow f12">{if is_array($f)} {$f[0]} <span class="f12 gray">|</span> {$f[1]} {else} {$f} {/if}</div>
						{$i++}
					{/loop}
				</td>
				<td><a class="dialog-confirm" href="{zotop::url('database/schema/dropindex/'.$table.'/'.$key)}" title="{t('删除索引')}"><span class="red">×</span></a></td>
			</tr>
		{/loop}
		</tbody>
		</table>
	</div><!-- side-body -->
</div>
<div class="main main-side" style="right:306px;">
	<div class="main-header">
		<div class="title">{$title}</div>
		<div class="position">
			<a href="{zotop::url('database/index')}">{t('数据库')}</a>
			<s class="arrow">></s>
			<a href="{zotop::url('database/index/table')}">{$database}</a>
			<s class="arrow">></s>
			{t('数据表')} : {$table}
		</div>
		<div class="action">
			<a class="btn btn-highlight btn-add dialog-open" href="{zotop::url('database/schema/addfield/'.$table)}" data-width="800px" data-height="480px">
				{t('新建字段')}
			</a>
			<a class="btn dialog-open" href="{zotop::url('database/schema/show/'.$table)}" data-width="800px" data-height="500px" title="{t('结构数组')}">
				{t('结构[s]')}
			</a>
		</div>
	</div>
	<div class="main-body scrollable">
		<form>
		<table class="table list zebra">
			<thead>
				<tr>
					<td class="select"><input type="checkbox" class="checkbox select-all"></td>
					<td class="w40 center none">{t('主键')}</td>
					<td class="w160">{t('名称')}</td>
					<td class="w260">{t('类型')}</td>
					<td class="w100">{t('默认值')}</td>
					<td>{t('说明')}</td>
					<td class="w60 center ">{t('自增')}</td>
					<td class="w100 center">{t('NOT NULL')}</td>
				</tr>
			</thead>
			<tbody>
			{loop $schema[fields] $key $field}
				<tr class="{if $i%2==0}even{else}odd{/if}">
					<td class="select"><input type="checkbox" class="checkbox" name="id[]" value="{$key}"></td>
					<td class="center none">{if in_array($key,$schema[primary])}<span class="green">√</span>{/if}</td>
					<td>
						<div class="title"><b class="name{if in_array($key,$schema[primary])} red{/if}">{$key}</b></div>
						<div class="manage">
							<a class="dialog-open" href="{zotop::url('database/schema/editfield/'.$table.'/'.$key)}" data-width="800px" data-height="480px">
								{t('编辑')}
							</a>
							<a class="dialog-confirm" href="{zotop::url('database/schema/dropfield/'.$table.'/'.$key)}">{t('删除')}</a>
						</div>
					</td>
					<td>{$field['type']}{if $field[length]}({$field[length]}){/if} {if $field[unsigned]}unsigned{/if}</td>
					<td>{if isset($field['default'])}{htmlspecialchars($field['default'])}{elseif $field['notnull'] === false}NULL{/if}</td>
					<td>{$field['comment']}</td>
					<td class="center">{if $field['autoinc']}<span class="green">√</span>{else}<span class="gray">×</span>{/if}</td>
					<td class="center">{if $field['notnull']}<span class="green">√</span>{else}<span class="gray">×</span>{/if}</td>
				</tr>
				{$i++}
			{/loop}
			<tbody>
		</table>
		</form>
	</div><!-- main-body -->
	<div class="main-footer">
		<input type="checkbox" class="checkbox select-all middle">
		<a class="btn operate" href="javascript:void(0)" id="field-datalist" style="display:none;">{t('浏览')}</a>
		<a class="btn operate" href="{zotop::url('database/schema/operate/'.$table.'/primary')}"><span class="red">{t('主键')}</span></a>
		<a class="btn operate" href="{zotop::url('database/schema/operate/'.$table.'/index')}">{t('索引')}</a>
		<a class="btn operate" href="{zotop::url('database/schema/operate/'.$table.'/unique')}">{t('唯一索引')}</a>
		<a class="btn operate" href="{zotop::url('database/schema/operate/'.$table.'/fulltext')}">{t('全文搜索')}</a>
	</div>
</div>
<style type="text/css">
	span.green,span.gray{font-family:tahoma;font-weight:bold;font-size:14px;}
</style>
<script type="text/javascript">
$(function(){
	var tablelist = $('table.list').data('tablelist');

	//底部全选
	$('input.select-all').click(function(e){
		tablelist.selectAll(this.checked);
	});

	//操作
	$("a.operate").each(function(){
		$(this).on("click", function(event){
			event.preventDefault();
			if( tablelist.checked() == 0 ){
				$.error('{t('请选择要操作的项')}');
			}else{
				var href = $(this).attr('href');
				var text = $(this).text();
				var data = $('form').serializeArray();;
					data.push({name:'operation',value:text});
				$.loading();
				$.post(href,$.param(data),function(msg){
					$.msg(msg);
				},'json');
			}
		});
	});
});
</script>
{template 'footer.php'}