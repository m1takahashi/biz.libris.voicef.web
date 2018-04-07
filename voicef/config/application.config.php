<?php
return array(
	// 後ろから順にマッチング
	// 利用頻度が多いものを下にする
    'modules' => array(
    	'ZSmarty',
		'System',    	
        'Application',
    ),

    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
    ),
);
