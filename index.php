<?php include_once "base.php";?>

<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0040)http://127.0.0.1/test/exercise/collage/? -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>卓越科技大學校園資訊系統</title>
	<link href="./css/css.css" rel="stylesheet" type="text/css">
	<script src="./js/jquery-1.9.1.min.js"></script>
	<script src="./js/js.js"></script>
</head>

<body>
	<div id="cover" style="display:none; ">
		<div id="coverr">
			<a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;"
				onclick="cl(&#39;#cover&#39;)">X</a>
			<div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
		</div>
	</div>
	<iframe style="display:none;" name="back" id="back"></iframe>
	<div id="main">
	<?php
    //取出標題圖片的資料
		$title=find("title",['sh'=>1]);
	?>
    <!--顯示標題區文字-->
		<a title="<?=$title['text'];?>" href="index.php">
      <!--顯示標題區圖片-->
			<div class="ti" style="background:url(&#39;./img/<?=$title['file'];?>&#39;); background-size:cover;"></div>
			<!--標題-->
		</a>
		<div id="ms">
			<div id="lf" style="float:left;">
				<div id="menuput" class="dbor">
					<!--主選單放此-->
					<span class="t botli">主選單區</span>
					<?php
            $menus=all("menu",['parent'=>0,'sh'=>1]);
            
            //利用迴圈逐一列出主選單的內容
						foreach($menus as $m){
              echo "<div class='mainmu'><a href='". $m['href'] ."'>" . $m['text'] . "</a>";
              
              //檢查是否有次選單
							$chksub=nums("menu",['parent'=>$m['id']]);
							if($chksub>0){
                //先在次選單外建立一個div容器
                echo "<div class='mw'>";
                //取出主選單下的次選單
                $subs=all("menu",['parent'=>$m['id']]);
                //利用迴圈列出所有的次選單
								foreach($subs as $s){
									echo "<div class='mainmu2'><a href='". $s['href'] ."'>" . $s['text'] . "</a></div>";
								}
								echo "</div>";
							}
							echo "</div>";
						}

				?>

				</div>
				<div class="dbor" style="margin:3px; width:95%; height:20%; line-height:100px;">
					<span class="t">進站總人數 :<?=find("total",1)['total'];?></span>
				</div>
			</div>
			<div class="di"
				style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
				<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
				<?php
						$marq=all("ad",['sh'=>1]);
						$str="";
						foreach($marq as $ma){
							$str=$str . "&nbsp;&nbsp;&nbsp;" . $ma['text'];
						}
						echo $str;
				?>
				</marquee>
				<?php
          //利用網址傳值(GET)的方式來決定主內容區要匯入那個檔案的內容
					$do = (!empty($_GET['do'])) ? $_GET['do'] : "home";
					switch ($do) {
							case "home":
									include "home.php";
									break;
							case "login":
									include "login.php";
									break;
							case "news":
									include "news.php";
									break;
					}

					?>
			</div>

			<div class="di di ad" style="height:540px; width:23%; padding:0px; margin-left:22px; float:left; ">
				<!--右邊-->
					<?php
          //利用session來決定首頁的按鈕文字內容及功能
				if(!empty($_SESSION['login'])){
					?>
				<button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;"
					onclick="lo(&#39;admin.php&#39;)">返回管理</button>
					<?php
				}else{
					?>
				<button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;"
					onclick="lo(&#39;?do=login&#39;)">管理登入</button>
					<?php
				}

					?>
				<div style="width:89%; height:480px;" class="dbor">
					<span class="t botli">校園映象區</span>
						<div class="btn" onclick="pp(1)"><img src="./icon/up.jpg" alt=""></div>
						<?php
              //撈出所有要顯示的圖片資料
							$img=all("image",['sh'=>1]);
							foreach($img as $key => $i){
                //建立圖片顯示需要的html容器及相關的內容，記得加上js控制用的class及id
								echo "<div class='img im' id='ssaa$key'>";
								echo "<img src='./img/".$i['file']."'>";
							  echo "</div>";
							}
						?>
						<div class="btn" onclick="pp(2)"><img src="./icon/dn.jpg" alt=""></div>
					<script>
						var nowpage = 0,
							num = <?=nums("image",['sh'=>1]);?>; //代入圖片的筆數
						function pp(x) {
							var s, t;
							if (x == 1 && nowpage - 1 >= 0) {
								nowpage--;
              }
              
              //記得修改原本的js程式內容
							if (x == 2 && (nowpage + 1) <= num*1 - 3) {
								nowpage++;
							}
							$(".im").hide()
							for (s = 0; s <= 2; s++) {
								t = s * 1 + nowpage * 1;
								$("#ssaa" + t).show()
							}
						}
						pp(1)
					</script>
				</div>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div
			style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
			<span class="t" style="line-height:123px;"><?=find("bottom",1)['bottom'];?></span>
		</div>
	</div>

</body>

</html>