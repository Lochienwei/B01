<?php
$do = (!empty($_GET['do'])) ? $_GET['do'] : "home";
switch($do){
  case "title":
?>
<h4 class="cent">新增網站標題</h4>
<hr>
<form action="api.php?do=newData" method="post" enctype="multipart/form-data">
<table style="margin:auto;">
  <tr>
    <td style="text-align:right">網站標題圖片</td>
    <td><input type="file" name="file" id=""></td>
  </tr>
  <tr>
    <td style="text-align:right">網站標題文字</td>
    <td><input type="text" name="text" id=""></td>
  </tr>
  <tr>
    <input type="hidden" name="table" value="title">
    <td colspan="2" class="cent"><input type="submit" value="新增"><input type="reset" value="重罝"></td>
  </tr>
</table>
</form>
<?php
  break;
  case "ad":
  ?>
  <h4 class="cent">新增動態文字廣告</h4>
  <hr>
  <form action="api.php?do=newData" method="post" enctype="multipart/form-data">
  <table style="margin:auto;">
    <tr>
      <td style="text-align:right">動態文字廣告</td>
      <td><input type="text" name="text" id=""></td>
    </tr>
    <tr>
      <input type="hidden" name="table" value="ad">
      <td colspan="2" class="cent"><input type="submit" value="新增"><input type="reset" value="重罝"></td>
    </tr>
  </table>
  </form>
  <?php
  break;
  case "mvim":
  ?>
  <h4 class="cent">新增動畫圖片</h4>
  <hr>
  <form action="api.php?do=newData" method="post" enctype="multipart/form-data">
  <table style="margin:auto;">
    <tr>
      <td style="text-align:right">網站動畫圖片</td>
      <td><input type="file" name="file" id=""></td>
    </tr>
    <tr>
      <input type="hidden" name="table" value="mvim">
      <td colspan="2" class="cent"><input type="submit" value="新增"><input type="reset" value="重罝"></td>
    </tr>
  </table>
  </form>
  <?php
  break;
  case "image":
  ?>
  <h4 class="cent">新增校園映象圖片</h4>
  <hr>
  <form action="api.php?do=newData" method="post" enctype="multipart/form-data">
  <table style="margin:auto;">
    <tr>
      <td style="text-align:right">校園映象圖片</td>
      <td><input type="file" name="file" id=""></td>
    </tr>
    <tr>
      <input type="hidden" name="table" value="image">
      <td colspan="2" class="cent"><input type="submit" value="新增"><input type="reset" value="重罝"></td>
    </tr>
  </table>
  </form>
  <?php
  break;
  case "news":
  ?>
  <h4 class="cent">新增最新消息資料</h4>
  <hr>
  <form action="api.php?do=newData" method="post" enctype="multipart/form-data">
  <table style="margin:auto;">
    <tr>
      <td style="text-align:right">最新消息資料</td>
      <td><textarea name="text" cols="40" rows="10"></textarea></td>
    </tr>
    <tr>
      <input type="hidden" name="table" value="news">
      <td colspan="2" class="cent"><input type="submit" value="新增"><input type="reset" value="重罝"></td>
    </tr>
  </table>
  </form>
  <?php
  break;
  case "admin":
  ?>
  <h4 class="cent">新增管理者帳號</h4>
  <hr>
  <form action="api.php?do=newData" method="post" enctype="multipart/form-data">
  <table style="margin:auto;">
    <tr>
      <td style="text-align:right">帳號：</td>
      <td><input type="text" name="acc" id=""></td>
    </tr>
    <tr>
      <td style="text-align:right">密碼：</td>
      <td><input type="password" name="pw" id=""></td>
    </tr>
    <tr>
      <td style="text-align:right">確認密碼：</td>
      <td><input type="password" name="pw2" id=""></td>
    </tr>
    <tr>
      <input type="hidden" name="table" value="admin">
      <td colspan="2" class="cent"><input type="submit" value="新增"><input type="reset" value="重罝"></td>
    </tr>
  </table>
  </form>
  <?php
  break;
  case "menu":
  ?>
  <h4 class="cent">新增主選單</h4>
  <hr>
  <form action="api.php?do=newData" method="post" enctype="multipart/form-data">
  <table style="margin:auto;">
    <tr>
      <td style="text-align:right">主選單名稱：</td>
      <td><input type="text" name="text" id=""></td>
    </tr>
    <tr>
      <td style="text-align:right">選單連結網址：</td>
      <td><input type="text" name="href" id=""></td>
    </tr>

    <tr>
      <input type="hidden" name="table" value="menu">
      <td colspan="2" class="cent"><input type="submit" value="新增"><input type="reset" value="重罝"></td>
    </tr>
  </table>
  </form>
  <?php
  break;
  case "updateTitle":
  ?>
  <h4 class="cent">更新標題圖片</h4>
  <hr>
  <form action="api.php?do=updateImage" method="post" enctype="multipart/form-data">
  <table style="margin:auto;">
    <tr>
      <td style="text-align:right">網站標題圖片</td>
      <td><input type="file" name="file" id=""></td>
    </tr>
    <tr>
      <input type="hidden" name="id" value="<?=$_GET['id'];?>">
      <input type="hidden" name="table" value="title">
      <td colspan="2" class="cent"><input type="submit" value="更新"><input type="reset" value="重罝"></td>
    </tr>
  </table>
  </form>
  <?php
  break;
  case "updateMvim":
  ?>
  <h4 class="cent">更新動畫圖片</h4>
  <hr>
  <form action="api.php?do=updateImage" method="post" enctype="multipart/form-data">
  <table style="margin:auto;">
    <tr>
      <td style="text-align:right">動畫圖片</td>
      <td><input type="file" name="file" id=""></td>
    </tr>
    <tr>
      <input type="hidden" name="id" value="<?=$_GET['id'];?>">
      <input type="hidden" name="table" value="mvim">
      <td colspan="2" class="cent"><input type="submit" value="更新"><input type="reset" value="重罝"></td>
    </tr>
  </table>
  </form>
  <?php
  break;
  case "updateImage":
  ?>
  <h4 class="cent">更換校園映像圖片</h4>
  <hr>
  <form action="api.php?do=updateImage" method="post" enctype="multipart/form-data">
  <table style="margin:auto;">
    <tr>
      <td style="text-align:right">校園映像圖片</td>
      <td><input type="file" name="file" id=""></td>
    </tr>
    <tr>
      <input type="hidden" name="id" value="<?=$_GET['id'];?>">
      <input type="hidden" name="table" value="image">
      <td colspan="2" class="cent"><input type="submit" value="更新"><input type="reset" value="重罝"></td>
    </tr>
  </table>
  </form>
  <?php
  break;
  case "subMenu":
  ?>
  <h4 class="cent">編輯次選單</h4>
  <hr>
  <form action="api.php?do=editSub" method="post" enctype="multipart/form-data">
  <table style="margin:auto;" class="cent">
    <tr>
      <td>次選單名稱</td>
      <td>次選單連結網址</td>
      <td>刪除</td>
    </tr>
    <?php 
      include_once "base.php";
      //依據主選單的id來撈出次選單的內容
      $subs=all('menu',['parent'=>$_GET['id']]);
      foreach($subs as $s){
    ?>
    <tr>
      <td><input type="text" name="text[]" value="<?=$s['text'];?>"></td>
      <td><input type="text" name="href[]" value="<?=$s['href'];?>"></td>
      <td><input type="checkbox" name="del[]" value="<?=$s['id'];?>"></td>
      <input type="hidden" name="id[]" value="<?=$s['id'];?>">
    </tr>

    <?php
    }
    ?>
    <!--建立一個more的id做為插入文字串的識別區-->
    <tr id="more">
      <input type="hidden" name="table" value="menu">
      <input type="hidden" name="parent" value="<?=$_GET['id'];?>">
      <td colspan="2" class="cent">
        <input type="submit" value="修改確定">
        <input type="reset" value="重罝">
        <input type="button" value="更多次選單" onclick="moreSub()">
      </td>
    </tr>
  </table>
  </form>
  <script>
    //更多次選單的js函式
    function moreSub(){
      //建立要放入表格中的html標籤文字串
      let newTr=`<tr>
                   <td><input type="text" name="text2[]" id=""></td>
                   <td><input type="text" name="href2[]" id=""></td>
                 </tr>`

      //id more的標籤前放入文字串
      $("#more").before(newTr)

    }
  
  </script>
  <?php
  break;
}


?>