	<div class="form-group">
		{form::label(t('电话'),'account',true)}
		{form::field(array('type'=>'text','name'=>'account','value'=>$data['account'],'required'=>'required'))}
		{form::tips(t('请输入固定电话或者手机号码'))}
	</div>
	<div class="form-group">
		{form::label(t('说明'),'text',true)}
		{form::field(array('type'=>'title','name'=>'text','value'=>$data['text'],'style'=>$data['style'],'required'=>'required','maxlength'=>50))}
		{form::tips(t('显示的标题，如 技术支持 客服一 等'))}
	</div>

