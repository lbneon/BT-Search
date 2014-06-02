<?php
/**
 * info.php
 *
 * 磁力信息页
 *
 * @author     Kslr
 * @copyright  2014 kslrwang@gmail.com
 * @version    0.3
 */

include 'config.php';
include APP_ROOT.'/include/core.php'; 
include APP_ROOT.'/include/template/header.php';

$info = get_shahinfo($_GET['magnetic']);
if (isset($info['error'])) {
  header("location: ".$siteconf['url']."?error=3");
  exit();
}

// 添加到数据库队列
// if ($message_queue['status'] === FALSE) {
//     $qsinfo = $info;
//     unset($qsinfo['list']);
//     $httpsqs = new httpsqs($message_queue['conf']['host'], $message_queue['conf']['port'], $message_queue['conf']['passwd'], $message_queue['conf']['charset']);
//     $httpsqs->put("bt", urlencode(json_encode($qsinfo))); 
// }

// 创建短地址
$dwz = create_dwz($siteconf['url'].'info.php?magnetic='.$_GET['magnetic'], $dwzconf);
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
    <div class="info">

    	<h2><?php echo $info['title']; ?></h2>

    	<div class="btinfo">
    		<p>文件大小：<?php echo $info['size']; ?></p>
    		<p>文件数：<?php echo $info['quantity']; ?></p>
        <p>Hash：<?php echo $_GET['magnetic']; ?></p>
    		<p>创建时间：<?php echo $info['cdate']; ?></p>
        <p>分享给好友：<a href="<?php echo $dwz; ?>"><?php echo $dwz; ?></a></p>
    	</div>
    	
    	<div class="link">
    		<p>磁力链接：</p>
    		<pre><?php echo $info['magnetic']; ?></pre>
        <p>（打开迅雷或者旋风，新建任务 复制上面磁力链 即可下载）</p>
    	</div>

    	<div class="filelist">
    		<?php 
    			echo $info['list']['0'].'<br>';
    		?>
    	</div>

    	<div class="dianbo">
            <button class="btn btn-primary" data-toggle="modal" data-target="#qr"><i class="glyphicon glyphicon-qrcode"></i></button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#bofang">网盘观看</button>
            <a  class="btn btn-primary" target="_blank" href="http://yun.dybeta.com/index.php#!u=<?php echo $info['magnetic']; ?>">在线点播{压缩包不能播放哦}</a>
    	</div>

        <div class="infoad">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- 结果信息 -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-7279075760253335"
                 data-ad-slot="3470334951"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>

    </div>
    
</div>

<!-- 百度网盘播放 -->
<div class="modal fade" id="bofang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">使用网盘下载</h4>
      </div>
      <div class="modal-body">
        提供一个百度云账户：<br><br>
        账号：dodc8ob9tahnko6w@outlook.com<br><br>
        密码：0mXt3OUvUKnKYT<br><br>
        如何使用：<a href="http://jingyan.baidu.com/article/c843ea0b7bba7b77931e4ad7.html">看这个</a><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>

<!-- QR -->
<div class="modal fade" id="qr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">QR Code</h4>
      </div>
      <div class="modal-body qr">
        <img src="https://chart.googleapis.com/chart?cht=qr&chs=280x280&choe=UTF-8&chld=L|2&chl=magnet:?xt=urn:btih:<?php echo $_GET['magnetic']; ?>&level=L&size=260">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>


<?php include APP_ROOT.'/include/template/footer.php'; ?>
