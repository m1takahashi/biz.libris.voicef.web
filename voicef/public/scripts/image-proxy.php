<?php
/**
 * 画像サムネイル＆キャッシュ
 * @see http://www.php.net/manual/ja/imagick.thumbnailimage.php
 */
define('THUMB_WIDTH',	160);
define('THUMB_QUARITY', 80);

$url = $_GET['url'];

$imagick = new Imagick();

// URLをキーとして画像を保存
$memcached = new Memcached();
if ($memcached) {
    $memcached->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
	
    $memcached->addServer('127.0.0.1', 11211);
	
	$blob = $memcached->get($url);
	if ($blob) {
		// キャッシュあり
		trigger_error("Stored Cache : YES");
		$imagick->readimageblob($blob);
	} else {
		// キャッシュなし
		trigger_error("Stored Cache : NO");
		$handle = fopen($url, 'rb');
		$imagick->readImageFile($handle);
		$imagick->resizeImage(THUMB_WIDTH, 0, 0, 0);
		$imagick->setImageFormat('jpeg');
		$imagick->setImageCompressionQuality(THUMB_QUARITY);
		// キャッシュセット
	    if (!$memcached->set($url, $imagick->getimageblob())) {
	    	trigger_error("Could not set Blob."); //  サーバーが落ちている
	    }
	}
}

// 出力
header("Content-Type: image/jpeg");
exit($imagick->getImageBlob());
?>