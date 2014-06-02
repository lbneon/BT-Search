<?php
/**
 * search.php
 *
 * 移动版搜索结果列表
 *
 * @author     Kslr
 * @copyright  2014 kslrwang@gmail.com
 * @version    0.1
 */

include dirname(__FILE__).'/../config.php';
include APP_ROOT.'/include/core.php';
include 'header.php';

if (!empty($_GET['keyword'])) {
	$str_temp = strip_tags(trim($_GET['keyword']));
	if (in_array($str_temp, $siteconf['badword'])) {
        header("Location: ".$siteconf['url'].'?error=0');
		exit();
	}

	$keyword = urldecode($str_temp);

	if (!empty($_GET['counts']) && !empty($_GET['page'])) {
		# 页码请求
		$counts = intval($_GET['counts']);
		$page = intval($_GET['page']);
		if ($counts >= $page && !empty($counts) && !empty($page)) {
			$list = Collection($keyword, '/'.$page);
			if (!$list) {
				header("Location: ".$siteconf['url'].'?error=2');
				exit();
			}
		} else {
			header("Location: ".$siteconf['url'].'?error=1');
			exit();
		}
	} else {
		# 初次请求
		$counts = Counts_page($keyword);
		$list = Collection($keyword, '/');

		if (!$list) {
			header("Location: ".$siteconf['url'].'?error=2');
			exit();
		}
	}

} else {
	header("Location: ".$siteconf['url']."");
	exit();
}

?>

<div data-role="page">
	<div data-role="header">
		<a href="<?php echo $siteconf['url']; ?>/m" data-role="button" data-rel="back">返回</a>
		<a href="<?php echo $siteconf['url']; ?>/m" data-role="button">首页</a>
		<h1><?php echo $siteconf['title']; ?></h1>
	</div><!-- /header -->

	 <div data-role="content" >

	      <ul data-role="listview" data-dividertheme="d" style="margin-top: 0;">
	         <?php 
				foreach ($list as $magnetic ) {
					echo '<li><a data-transition="slide" data-direction="reverse" href="info.php?magnetic='.get_hash($magnetic['url']).'">'.title_truncation($magnetic['name']).'</a></li>';
					}
				?>
	      </ul>
	    <div class="nextpage" data-role="controlgroup">
	    	<?php
			if (!empty($counts) && !empty($page) && $counts > $page) {
				$pages = $page + 1;
				$pagesend = $page - 1;
				echo '<a data-role="button" data-icon="arrow-l" data-iconpos="right" href="search.php?keyword='.$keyword.'&counts='.$counts.'&page='.$pagesend.'">上一页</a>';
				echo '<a data-role="button" data-icon="arrow-r" data-iconpos="right" href="search.php?keyword='.$keyword.'&counts='.$counts.'&page='.$pages.'">下一页</a>';
			} elseif (isset($page) && $page == $counts) {
				$pagesend = $page - 1;
				echo '<a data-role="button" data-icon="arrow-r" data-iconpos="right" href="search.php?keyword='.$keyword.'&counts='.$counts.'&page='.$pagesend.'">上一页</a>';
				echo '<a data-role="button" data-icon="arrow-l" data-iconpos="right" href="">最后一页</a>';

			} elseif ($counts > 1) {
				echo '<a data-role="button" data-icon="arrow-r" data-iconpos="right" href="search.php?keyword='.$keyword.'&counts='.$counts.'&page=2">下一页</a>';
			}
			?>
		</div>
   </div><!-- /content -->

	<div data-role="footer" data-position="fixed">
		<p>@ BT-SS.com 版权所有</p>
	</div>

</div><!-- /page -->


	<!-- 网站主体结束 -->
<?php include 'footer.php'; ?>