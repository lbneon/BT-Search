<?php
/**
 * index.php
 *
 * 应用程序首页
 *
 * @author     Kslr
 * @copyright  2014 kslrwang@gmail.com
 * @version    0.3
 */

include dirname(__FILE__).'/config.php';
include APP_ROOT.'/include/core.php'; 

$global_title = $siteconf['title'];
include APP_ROOT.'/include/template/header.php';
  
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
        $default_keyword = '抱歉，未能搜索到数据。';
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


// keywords records
include 'function.php';
  if (!empty($_POST['keyword'])) {
  	$search_data_tmp = Get_search(htmlspecialchars(trim($_POST['keyword'])), '', '', $key, $SITE['url']);
  	$search_data = json_decode($search_data_tmp, true);
  	print_r($search_data['data']);
  	if (!isset($search_data['Error'])) {
  		$keyword = $search_data['keyword'];
  		$collpage = $search_data['collpage'];
  		$currentpage = $search_data['currentpage'];
  		batchsql($search_data['data'], htmlspecialchars(trim($_POST['keyword'])));
  	} else {
  		$keyword = $default_keyword;
  	}
  } elseif (!empty($_GET['keyword'])) {
  	$st = false;
  	$keyword = htmlspecialchars(trim($_GET['keyword']));
  } else {
  	$st = true;
  	$keyword = null;
  }
  
  
  if (!empty($_GET['keyword']) && !empty($_GET['collpage']) && !empty($_GET['currentpage'])) {
  	$search_data_tmp = Get_search(htmlspecialchars(trim($_GET['keyword'])), htmlspecialchars(trim($_GET['currentpage'])), htmlspecialchars(trim($_GET['collpage'])), $key, $SITE['url']);
  	$search_data = json_decode($search_data_tmp, true);
  	if (!isset($search_data['Error'])) {
  		$keyword = $search_data['keyword'];
  		$collpage = $search_data['collpage'];
  		$currentpage = $search_data['currentpage'];
  	} else {
  		$keyword = $default_keyword;
  	}
  }

?>

<div id="keyword">
  <div class="tags">
    <?php 
        foreach(Popular_keywords_tk() as $popularkeyword){
          echo '<a href="search.php?keyword='.$popularkeyword.'" class="label label-primary tags_a" target="_blank">'.$popularkeyword.'</a> ';
        }
    ?>
  </div>

  <div class="hide_keyword">
    <p id="hide_keyword">关闭热门关键词</p>
  </div>

</div>
<script type="text/javascript">
  $("#keyword").hide();
    $(document).ready(function(){
      $("#show_keyword").click(function(){
      $("#keyword").slideDown(1500);
      });
     $("#hide_keyword").click(function(){
      $("#keyword").slideUp(1500);
      $("#show_keyword").show();
     });
  });
</script>

<div class="header">
  <span id="show_keyword" class="glyphicon glyphicon-bookmark"></span>
</div>

<div id='warp'>
  <div class="search">
    <div class="logo">
      <img src="<?php echo $siteconf['url'].'public/images/logo.jpg'; ?>" />
    </div>

      <form class="search_form" role="search" method="get" action="search.php">
      <input name="keyword" class="form-control" autofocus="autofocus"  placeholder="<?php echo $default_keyword; ?>" x-webkit-speech lang='zh-CN' required="required"/>
      <button class="btn search_btn" aria-label="搜一下" id="search_btn"><span>搜索</span></button>
      </form>
      
      
      <!-- 顶部刚搜索的关键词 -->
      <div class="row">
        <div class="col-lg-12 col-lg">
        	<h4>全部被搜索的词:</h4>
        	<?php 
        	  foreach(RecentsearchesAll() as $keyword_cont){
        		echo '<a href="search.php?keyword='.$keyword_cont['tags'].'" class="label label-primary" target="_blank">'.$keyword_cont['tags'].'</a> ';
        	  } 
        	?>
        </div>      
      </div>
      
  </div>

  <div class="navbar footer navbar-fixed-bottom">
    <span id="fsr">
       <span class="_le" >© 2014 Bunny.CF</span>
     </span>

    <span id="fsl">
      <a class="_le" data-toggle="modal" data-target="#ad" style="text-decoration:none;">合作/广告/反馈</a>
      <a class="_le" style="color:rgb(202, 24, 24); margin-left:10px;" target="_blank" href="<?php echo $siteconf['url'].'/m'; ?>">Mobile Ver</a>
      <a class="_le" style="color:rgb(202, 24, 24); margin-left:10px;" target="_blank" href="<?php echo $siteconf['url']; ?>">Home</a>
    </span>
  </div>
</div>

<div class="modal fade" id="ad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
          <h3>站点合作</h3>
            若不团结,任何力量都是弱小的，只有进行合作，强强联合，集双方之优势，获取合作进步，才能达到利益双赢的局面。
          <hr>

          <h3>投放广告</h3>
            广告位置：
            <li>搜索结果页上方970*90 ￥80/月</li>
            <li>详情页728*90 ￥75/月</li><br>
            流量数据请向我索取，联系方式在最后。

          <hr>
          
          <h3>建议反馈</h3>
            邮件联系：evimacsl@gmail.com<br>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<!-- 网站内容结束 -->

<?php include APP_ROOT.'/include/template/footer.php'; ?>