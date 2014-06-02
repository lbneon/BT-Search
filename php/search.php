<?php
/**
 * search.php
 *
 * 搜索结果列表
 *
 * @author     Kslr
 * @copyright  2014 kslrwang@gmail.com
 * @version    0.3
 */

include dirname(__FILE__).'/config.php';
include APP_ROOT.'/include/core.php';
include APP_ROOT.'/include/template/header.php';

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


<div class="container">
	<!-- 网站导航栏 -->
		<div class="navbar navbar-default" role="navigation">
	        <div class="navbar-collapse collapse">
		        <ul class="nav navbar-nav">
		            <li><a href="<?php echo $siteconf['url']; ?>">回到首页</a></li>
		        </ul>
	        </div>
    </div>
    <!-- 网站导航栏结束 -->

    <!-- 搜索结果页广告 -->
    <div class="ad970">
    	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<ins class="adsbygoogle"
		     style="display:inline-block;width:970px;height:90px"
		     data-ad-client="ca-pub-7279075760253335"
		     data-ad-slot="3609935756"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
    </div>


    <!-- 列表 -->
	<div class="history">
		<div class="col-lg-12">
           <h4>搜索结果</h4>
			<?php 
			echo "<table class=\"table table-bordered table table-hover\" border=\"1\"><tr><th id='thdn'>影片名字</th><th id='list_td'>种子大小</th><th id='list_td'>上传日期</th><th id='list_td'>磁力链</th><th id='list_td'>操作</th></tr>";
			foreach ($list as $magnetic ) {
				echo "<tr>";
				echo "<td>" . title_truncation($magnetic['name']) . "</td>";
				echo "<td id='list_td'>" . $magnetic['size'] . "</td>";
				echo "<td id='list_td'>" . date('Y-m-d', strtotime($magnetic['date'])) . "</td>";
				echo "<td id='list_td cili'><a href='" . $magnetic['url'] . "'>磁力<a></td>";
				echo "<td id='list_td'>";
				echo '<a href="info.php?magnetic=' .get_hash($magnetic['url']). '" target="_blank" class="btn btn-success">打开</a>';
				echo "</ul></div></td></tr>";
				}
			echo '</table>';
			?>
			</div>
		</div>
		<!-- 列表底部页码-->
		<?php
		if (!empty($counts) && !empty($page) && $counts > $page) {
			$pages = $page + 1;
			$pagesend = $page - 1;

			echo '<ul class="pagination next">';
			echo '<li><a href="search.php?keyword='.$keyword.'&counts='.$counts.'&page='.$pagesend.'">上一页</a></li>';
			echo '<li><a href="search.php?keyword='.$keyword.'&counts='.$counts.'&page='.$pages.'">下一页</a></li>';
			echo '<li><a href="#">&raquo;</a></li></ul>';

		} elseif (isset($page) && $page == $counts) {

			$pagesend = $page - 1;

			echo '<ul class="pagination next">';
			echo '<li><a href="search.php?keyword='.$keyword.'&counts='.$counts.'&page='.$pagesend.'">上一页</a></li>';
			echo '<li><a href="">最后一页</a></li>';

		} elseif ($counts > 1) {

			echo '<ul class="pagination next">';
			echo '<li><a href="search.php?keyword='.$keyword.'&counts='.$counts.'&page=2">下一页</a></li>';
			echo '<li><a href="#">&raquo;</a></li></ul>';
		}
		?>
		<!-- 网站底部页码结束 -->
	</div>
	<!-- 网站主体结束 -->
<?php include APP_ROOT.'/include/template/footer.php'; ?>