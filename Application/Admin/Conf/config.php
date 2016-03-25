<?php
return array(
	//'配置项'=>'配置值'

	'URL_HTML_SUFFIX'=>'html',
	//'URL_HTML_SUFFIX'=>'',

	'URL_MODEL'=>0,
	'URL_MODEL'=>1,
	'URL_MODEL'=>2,
	'URL_MODEL'=>3,
	'URL_MODEL'=>1,

	'TMPL_ACTION_ERROR' => 'Public/jump',//默认失败跳转对应的模板文件
	'TMPL_ACTION_SUCCESS' => 'Public/jump',//默认成功跳转对应的模板文件

	//'DEFAULT_V_LAYER' => 'View', 
	'TMPL_TEMPLATE_SUFFIX'=>'.html',
	'TMPL_FILE_DEPR'=>'/',

	//'DEFAULT_THEME' => 'default',
	'TMPL_PARSE_STRING' =>array(
		'__UPLOAD__' => __ROOT__.'/Uploads',
	)

);