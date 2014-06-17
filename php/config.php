<?php
/**
 * config.php
 *
 * 应用程序的配置文件
 *
 * @author     Kslr
 * @copyright  2014 kslrwang@gmail.com
 * @version    0.3
 */

define('IN_SYS', TRUE);
define("APP_ROOT", dirname(__FILE__));

/* 
*   网站信息
*/
$siteconf = array(

    'url'          		=> 'http://www.bunny.cf/',	//网站地址  注意,网址后面必须加上/
    'title'  	   		=> '兔子 搜搜 - 专业磁力搜索工具,下载利器,免费下载各种资源',	//网站标题
    'keywords'    		=> '兔子搜素,磁力种子,磁力搜索引擎,磁力搜索,bt搜索器,bt搜索神器,,bt种子搜索器',	//网站关键词
    'description'  		=> '兔子 搜搜 -- 专注于提供磁力搜索和下载服务,你可以在这里搜索和下载电影、剧集、音乐、图书、图片、综艺、软件、动漫、教程、游戏等资源。',	//网站描述
    'badword'      		=> array('胡锦涛', '江泽民', '邓小平', '毛泽东'),	//关键词黑名单
    'default_keyword'   => '无人区',	//默认的关键词

);