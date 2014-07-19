<?php
include 'config.php';
include 'include/Medoo.class.php';

/**
* 显示最近搜索的关键词列表
*/
function Recentsearches() {
	$medoo = new medoo($GLOBALS['DB']);
	//$expiretime = time() - 1 * 60 * 60 * 24 * 5; //5 days
	//return $expiretime;
	$medoo->query("delete from bt_tags where TIMESTAMPDIFF(HOUR,`createtime`,CURRENT_TIMESTAMP())> 240");
	$medoo->query("delete from bt_data where TIMESTAMPDIFF(HOUR,`createtime`,CURRENT_TIMESTAMP())> 240");
	//$searches_keyword = $medoo->query("select tags from bt_tags order by id desc limit 60")->fetchAll();
	$searches_keyword = $medoo->query("select tags from bt_tags order by click desc limit 60")->fetchAll();
	return $searches_keyword;
}

/**
* 刚刚被搜索的种子列表
*/
function RecentBT($hava = true, $keyword = NUll) {
	$medoo = new medoo($GLOBALS['DB']);
	if ($hava) {
		$bt_list = $medoo->query("select * from bt_data order by tid desc limit 30")->fetchAll();
	} else {
		$bt_list = $medoo->select("bt_data", array('name', 'size', 'date', 'url'), array('LIKE' => array('name' => $keyword), 'LIMIT' => '20'));
	}

	return $bt_list;
}

/*
* 批量插入数据
*/
function batchsql($data, $keyword) {
	$medoo = new medoo($GLOBALS['DB']);
	if (is_array($data)) {
		foreach ($data as $video) {
		 $medoo->insert("bt_data", array('name' => $video['name'], 'size' => $video['size'], 'date' => $video['date'], 'createtime' => date("Y-m-d H:i:s"), 'tag' => $keyword, 'url' => $video['url']));
		}
	}
}