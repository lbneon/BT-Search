<?php
define('IN_SYS', TRUE);
// ========== 数据库配置 ==========

define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PORT', getenv('OPENSHIFT_MYSQL_DB_PORT'));
define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define('DB_PASS', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
define('DB_NAME', getenv('OPENSHIFT_GEAR_NAME'));

$dbhost = constant("DB_HOST"); // Host name 
$dbport = constant("DB_PORT"); // Host port
$dbusername = constant("DB_USER"); // Mysql username 
$dbpassword = constant("DB_PASS"); // Mysql password 
$db_name = constant("DB_NAME"); // Database name 


$GLOBALS['DB'] = array(
	'database_type' => 'mysql',
	'database_name' => $db_name,
	'server' => $dbhost,
	'username' => $dbusername,
	'password' => $dbpassword,
	'port' => $dbport,
	'charset' => 'utf8',
	'option' => array(PDO::ATTR_CASE => PDO::CASE_NATURAL)
	);

$SITE['url'] = "http://www.bubby.cf/"; //网站地址  注意,网址后面必须加上/
//$SITE['url'] = "http://btsearch-aera.rhcloud.com/"; //网站地址  注意,网址后面必须加上/
$SITE['title'] = '兔子搜索_磁力种子搜索'; //网站标题
$SITE['keywords'] = 'BT,BT种子,种子,种子搜索,BT搜索,资源搜'; //网站关键词
$SITE['description'] = '磁力种子,提供影片搜索、BT种子、视频下载链接在线快速播放'; //网站描述
$badword = array('胡锦涛','江泽民', '邓小平', '毛泽东');	//过滤的关键词
$key = 'f9FkTlB25C';	//加盐字符
$default_keyword = '无人区';  //默认的关键词