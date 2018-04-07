<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
	<title>{$smarty.const.DISPLAY_NAME} 管理画面</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/pure.css">
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="/css/system/side-menu-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="/css/system/side-menu.css">
    <!--<![endif]-->
    <script src="/js/system/ui.js"></script>
    <!-- JQuery Mobile -->
    <script src="/js/jquery.min.js"></script> 
</head>
<body>
<div id="layout">
	<!-- Menu toggle -->
	<a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>
    <div id="menu">
        <div class="pure-menu pure-menu-open">
            <a class="pure-menu-heading" href="/system/index/index">管理メニュー</a>
            <ul>
                <li class="menu-item-divided">全般</li>
                <li><a href="/system/site-category/index">事務所管理</a></li>
                <li><a href="/system/site-category/index">声優管理</a></li>
                <li class="menu-item-divided">システム管理</li>
                <li><a href="/system/log/index">ログ</a></li>
                <li><a href="/system/phpmyadmin/" target="_blank">phpMyAdmin</a></li>
                <li><a href="/system/phpinfo.php" target="_blank">phpinfo</a></li>
                <li><a href="" target="_blank">さくらVPS</a></li>
                <li class="menu-item-divided">社内ドキュメント</li>
            </ul>
        </div>
    </div>
    <div id="main">
    	<div class="content">{$content}</div>
    </div>
</div>
</body>
</html>