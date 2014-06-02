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

?>

<div id="keyword">
  <div class="tags">
    <?php 
        foreach(Popular_keywords() as $popularkeyword){
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
      $("#keyword").slideDown(500);
      });
     $("#hide_keyword").click(function(){
      $("#keyword").slideUp(500);
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
  </div>

  <div class="navbar footer navbar-fixed-bottom">
    <span id="fsr">
       <span class="_le" >© 2014 BT-SS.com</span>
     </span>

    <span id="fsl">
      <a class="_le" data-toggle="modal" data-target="#ad" style="text-decoration:none;">合作/广告/反馈</a>
      <a class="_le" style="color:rgb(202, 24, 24); margin-left:10px;" target="_blank" href="<?php echo $siteconf['url'].'/m'; ?>">移动网站</a>
      <a class="_le" style="margin-left:10px;" target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=d1a3001b426c8e2afd7bc6eb4e788349993e719957bcaa8afea8107eb0a5f0eb"><img border="0" src="https://www.bt-ss.com/public/images/group.png" alt="BT-SS用户交流" title="BT-SS用户交流"></a>
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
            邮件联系：Kslrwang@gmail.com<br>
            QQ群：207302852

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<!-- 网站内容结束 -->

<?php include APP_ROOT.'/include/template/footer.php'; ?>