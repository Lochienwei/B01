<div style="height:32px; display:block;"></div>
<!--正中央-->

<div style="width:100%; padding:2px; height:290px;">
  <div id="mwww" loop="true" style="width:100%; height:100%;">
    <div style="width:99%; height:100%; position:relative;" class="cent">沒有資料</div>
  </div>
</div>
<script>
  //記得先把這段script程式碼搬下來
  var lin = new Array();
      lin = <?php //建立一個給前端js使用的動畫圖片路徑陣列
                  $mvims = all('mvim', ['sh' => 1]);
                  $str = [];
                  foreach($mvims as $mv) {
                    $str[] = "./img/".$mv['file'];
                  }
                  echo "['".implode("','", $str)."']";
            ?> ;
           
  var now = 0;
  if (lin.length > 1) {
    setInterval("ww()", 3000);
    now = 1;
  }
  ww(); //先執行一次ww()程式把第一個動畫圖片放到網頁中
  function ww() {
    $("#mwww").html("<embed loop=true src='" + lin[now] + "' style='width:99%; height:100%;'></embed>")
    //$("#mwww").attr("src",lin[now])
    now++;
    if (now >= lin.length)
      now = 0;
  }
</script>
<div
  style="width:95%; padding:2px; height:190px; margin-top:10px; padding:5px 10px 5px 10px; border:#0C3 dashed 3px; position:relative;">
  <span class="t botli">最新消息區
    <?php
        $newsNum = nums("news", ['sh' => 1]);
        //判斷新聞資料的總筆數來決定是否要出現More的連結文字
        if ($newsNum > 5) {
   ?>
    <div style="position: absolute;right: 10px;top: 20px;"><a href='?do=news'>More...</a></div>
    <?php  }  ?>

  </span>
  <ul class="ssaa" style="list-style-type:decimal;">
    <?php
        //$news=all("news",['sh'=>1]);
        //撈出前五筆顯示的新聞資料
        $news = q("select * from news where sh='1' limit 5");
        foreach ($news as $n) {
        echo "<li>";

        //利用substr函式只取出前20個文字來顯示
        echo mb_substr($n['text'], 0, 20, 'utf8');

        //建立一個子元素all來存放全部的文字內容，預設這個子元素為不顯示
        echo "<div class='all' style='display:none'>";
        echo $n['text'];
        echo "</div>";
        echo "</li>";

        }
    ?>
  </ul>
  <div id="altt"
    style="position: absolute; width: 350px; min-height: 100px; background-color: rgb(255, 255, 204); top: 50px; left: 130px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
  </div>
  <script>
    $(".ssaa li").hover(
      function () {
        $("#altt").html("<pre>" + $(this).children(".all").html() + "</pre>")
        $("#altt").show()
      }
    )
    $(".ssaa li").mouseout(
      function () {
        $("#altt").hide()
      }
    )

    //消除hover閃爍的程式碼
    $("#altt").hover(
      function () {
        $("#altt").show();
      },
      function () {
        $("#altt").hide();
      }
    )
  </script>
</div>