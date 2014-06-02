<?php
/**
 * info.php
 *
 * 移动版磁力信息页
 *
 * @author     Kslr
 * @copyright  2014 kslrwang@gmail.com
 * @version    0.1
 */

include dirname(__FILE__).'/../config.php';
include APP_ROOT.'/include/core.php';
include 'header.php';

$info = get_shahinfo($_GET['magnetic']);
if (isset($info['error'])) {
  header("location: ".$SITE['url']."?error=3");
  exit();
}

$dwz = create_dwz($siteconf['url'].'info.php?magnetic='.$_GET['magnetic'], $dwzconf);
?>

<div data-role="page">
  <div data-role="header">
    <a href="<?php echo $siteconf['url']; ?>/m" data-role="button">首页</a>
    <h1><?php echo $info['title']; ?></h1>
  </div><!-- /header -->

   <div data-role="content" >
      <div class="btinfo">
        <p>文件名：<?php echo $info['title']; ?></p>
        <p>文件大小：<?php echo $info['size']; ?></p>
        <p>文件数：<?php echo $info['quantity']; ?></p>
        <p>Hash：<?php echo $_GET['magnetic']; ?></p>
        <p>创建时间：<?php echo $info['cdate']; ?></p>
        <p>分享给好友：<a href="<?php echo $dwz; ?>"><?php echo $dwz; ?></a></p>
      </div>
      
      <div class="magnetic">
        <p>磁力链接：</p>
        <div class="link">
          <p><?php echo $info['magnetic']; ?></p>
        </div>
        <p>（打开迅雷或者旋风，新建任务 复制上面磁力链 即可下载）</p>
      </div>
        
   </div><!-- /content -->

  <div data-role="footer" data-position="fixed">
    <p>@ BT-SS.com 版权所有</p>
  </div>

</div><!-- /page -->

<?php include 'footer.php'; ?>