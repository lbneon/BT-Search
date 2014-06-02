<?php
/**
 * index.php
 *
 * 移动版应用程序首页
 *
 * @author     Kslr
 * @copyright  2014 kslrwang@gmail.com
 * @version    0.1
 */

include dirname(__FILE__).'/../config.php';
include APP_ROOT.'/include/core.php';
include 'header.php';

if(isset($_GET['error'])) {
  $error_code = intval($_GET['error']);
    switch ($error_code) {
      case '0':
        $default_keyword = '此关键词被列入黑名单！';
        break;
      case '1':
        $default_keyword = '使用了错误的页码';
        break;
      case '2':
        $default_keyword = '抱歉，未能搜素到数据。';
        break;
      case '3':
        $default_keyword = '详情页使用了错误的HASH ！';
        break;
      default:
        $default_keyword = $siteconf['default_keyword'];
        break;
    }
} else {
  $default_keyword = $siteconf['default_keyword'];
}
?>

<div data-role="page">

	<div data-role="header">
		<h1><?php echo $siteconf['title']; ?></h1>
	</div><!-- /header -->

	<div data-role="content">	
		<form action="<?php echo $siteconf['url'].'/m/search.php'; ?>" method="get">
			<label for="keyword">请输入搜索关键词:</label>
			<input type="search" name="keyword" id="keyword"/>
			<input type="submit" data-inline="true" value="提交">
		</form>
	</div><!-- /content -->

	<div data-role="footer" data-position="fixed">
		<p>@ BT-SS.com 版权所有</p>
	</div>

</div><!-- /page -->
<?php include 'footer.php'; ?>