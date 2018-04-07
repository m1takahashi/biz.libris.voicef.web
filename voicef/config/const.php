<?php
date_default_timezone_set('Asia/Tokyo');

/**
 * 設定
 */
define('COMPANY_NAME',         '');
define('COMPANY_NAME_JP',      '');
define('COMPANY_EMAIL',		   '');
define('SERVICE_NAME',         'voicef');
define('SERVICE_NAME_DISPLAY', 'voicef');

// ディレクトリー
define('BASE_DIR',  '/home/voicef/voicef/current');
define('INI_DIR',    BASE_DIR . '/config');
define('LIB_DIR',    BASE_DIR . '/library');
define('MODULE_DIR', BASE_DIR . '/module');

// ニュース保存期間
define('ENTRY_STORE_HOUR', 24 * 120); // 4ヶ月分

define('DOMAIN_BASE_PRODUCTION',  '');
define('DOMAIN_BASE_DEVELOPMENT', '');

if (APPLICATION_ENV == 'development') {
	define('URL_BASE', 'http://' . DOMAIN_BASE_DEVELOPMENT);
} else {
	define('URL_BASE', 'http://' . DOMAIN_BASE_PRODUCTION);
}

define('URL_IMAGE_PROXY_FULL', URL_BASE . '/scripts/image-proxy.php?url=');