{template 'header.php'}

<style type="text/css">
	#about{position:relative;padding:15px;background:#e5f3fb;display: none}
	#about img{width:42px;height:42px;}
	#about-content{position:absolute;left:72px;top:11px;}
	#about-content h2{font-size:20px;margin-bottom:2px;}
	#about-content div{font-size:80%;}
</style>


<div class="main">
	<div class="main-header">
		<div class="title">{$title}</div>
	</div><!-- main-header -->
	<div class="main-body scrollable">

		<div id="about">
			<img src="{A('translator.url')}/app.png">
			<div id="about-content">
				<h2>{A('translator.name')}</h2>
				<div>{A('translator.description')}</div>
			</div>
		</div>

		{form::header(u('translator/config/save'))}
		<table class="field">
			<caption>{t('参数设置')}</caption>
			<tr>
				<td class="label">{form::label(t('API KEY'),'baidu_clientid',true)}</td>
				<td class="input">
					{form::field(array('type'=>'text','name'=>'baidu_clientid','value'=>c('translator.baidu_clientid'),'required'=>'required'))}
					{form::tips(t('在百度开发者中心注册得到的授权API KEY'))}
				</td>
			</tr>
			<tr>
				<td class="label">{form::label(t('别名长度'),'alias_length',true)}</div>
				<td class="input">
					{form::field(array('type'=>'num','name'=>'alias_length','value'=>c('translator.alias_length'),'required'=>'required','max'=>128))}
					{form::tips(t('翻译后提取的别名长度，最长为128个字符'))}
				</td>
			</tr>

			<tr>
				<td class="label"></td>
				<td class="input">
				{form::field(array('type'=>'submit','value'=>t('保存')))}
				</td>
			</tr>
		</table>
		{form::footer()}

		<div class="blank"></div>
		<div class="blank"></div>

		<table class="field">
		<caption>{t('使用说明')}</caption>
		<tr>
			<td>			
				<ul class="list">
					<li>{t('百度翻译API是百度面向开发者推出的免费翻译服务开放接口')}</li>
					<li>{t('默认API KEY使用限制为1000次/小时限制，您最好申请一个自己的API KEY来使用')}</li>
				</ul>
			</td>
		<tr>
		</table>

	</div><!-- main-body -->
	<div class="main-footer">
	{A('translator.description')}
	</div><!-- main-footer -->
</div><!-- main -->

<script type="text/javascript" src="{zotop::app('system.url')}/common/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('form.form').validate({submitHandler:function(form){
			var action = $(form).attr('action');
			var data = $(form).serialize();
			$(form).find('.submit').disable(true);
			$.loading();
			$.post(action, data, function(msg){
				$.msg(msg);
				$(form).find('.submit').disable(false);
			},'json');
		}});
	});
</script>
{template 'footer.php'}