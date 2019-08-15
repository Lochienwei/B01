<?php

$dsn = "mysql:host=localhost;charset=utf8;dbname=db01";
$pdo = new PDO($dsn, "root", "");
session_start();

/************************************************
 * 利用SESSION來記錄來訪者的連線狀況，沒有這個session
 * 表示使用者是新的連線，因此在訪客紀錄上加1，如果有
 * 這個session，表示使用者己經連線過網站了，那麼
 * 訪客紀錄就不加1。
 * 當使用者關閉瀏灠器再重新連線網站時，會產生新的連線
 * 紀錄，此時session不存在，因此會視為是新的訪客。
 ************************************************/
if (empty($_SESSION['total'])) {
 $total = find("total", 1);
 $total['total'] = $total['total'] + 1;
 save("total", $total);
 $_SESSION['total'] = $total['total'];
}


/***************************************************
 * 查詢指定條件資料的函式，參數需要table名稱及條件陣列
 * 如果條件陣列非陣列形態的話，則預設為資料id
 * 此函式預設只會回傳單筆資料，如果條件陣列可能會有多條
 * 結果資料時，則只回傳第一筆資料
 ***************************************************/
function find($table, $def)
{
 global $pdo;
 if (is_array($def)) {
  foreach ($def as $key => $val) {
   $str[] = sprintf("`%s`='%s'", $key, $val);
  }
  $sql = "select * from $table where " . implode(" && ", $str) . "";
 } else {
  $sql = "select * from $table where id='$def'";
 }
 return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
 
}

/***************************************************
 * 新增及更新資料通用函式
 * 以有無id值來判斷是要做新增還是更新的動作
 * 預設會先以find()拿到指定id的資料後，進行內容的修改再
 * 做更新進資料庫的動作
 * 利用array_keys()來取出陣列中的key值陣列
 * 利用implode()來組合陣列
 ***************************************************/
function save($table, $data)
{

 global $pdo;
 if (!empty($data['id'])) {
  //update
  echo "update";
  foreach ($data as $key => $val) {
   if ($key != 'id') {
    $str[] = sprintf("%s='%s'", $key, $val);
   }
  }
  $sql = "update $table set " . implode(" , ", $str) . " where id='" . $data['id'] . "'";
 } else {
  //insert

  $tmp = array_keys($data);
  $sql = "insert into $table(`" . implode("`,`", $tmp) . "`) values('" . implode("','", $data) . "')";
  
 }
 //echo $sql;
 return $pdo->exec($sql);
}

/***************************************************
 * 頁面導向專用函式
 * 需帶入兩個參數，路徑檔名及路徑參數
 ***************************************************/
function to($page, $param)
{
 if (empty($param)) {
  header("location:$page");
 } else {
  header("location:$page?$param");
 }
}

/***************************************************
 * 刪除資料專用函式
 * 需帶入兩個參數，資料表名及刪除的條件
 * 當刪除的條件為數值時，表示刪除指定id的資料
 ***************************************************/
function del($table, $def)
{
 global $pdo;
 if (is_array($def)) {
  foreach ($def as $key => $val) {
   $str[] = sprintf("`%s`='%s'", $key, $val);
  }
  $sql = "delete from $table where " . implode(" && ", $str) . "";
 } else {
  $sql = "delete from $table where id='$def'";
 }
 return $pdo->exec($sql);
}

/***************************************************
 * 通用query函式
 * 簡化pdo的指令
 * 一律以fetchAll()的方式取資料
 ***************************************************/
function q($str)
{
 global $pdo;
 return $pdo->query($str)->fetchAll();
}

/***************************************************
 * 查詢資料的函式
 * 參數需要table名稱及條件，條件以陣列形式呈現
 * 陣列長度為0時表示要取得資料表的全部資料
 * 陣列內有元素時表示只取得符合條件的資料
 * 陣列的形式為['欄位名'=>'值']
 * 多個條件時，預設以&&連結。
 ***************************************************/
function all($table, $def)
{
 global $pdo;
 if (count($def) > 0) {
  foreach ($def as $key => $val) {
   $str[] = sprintf("`%s`='%s'", $key, $val);
  }
  $sql = "select * from $table where " . implode(" && ", $str) . "";
 } else {
  $sql = "select * from $table";
 }
 return $pdo->query($sql)->fetchAll();
}

/***************************************************
 * 計算資料筆數的函式
 * 參數需要table名稱及條件，條件以陣列形式呈現
 * 陣列長為0時表示要計算table全部的筆數
 * 陣列內有元素時表示計算符合條件的資料筆數
 * 陣列的形式為['欄位名'=>'值']
 * 多個條件時，預設以&&連結。
 ***************************************************/
function nums($table, $def)
{
 global $pdo;
 if (count($def) > 0) {
  foreach ($def as $key => $val) {
   $str[] = sprintf("`%s`='%s'", $key, $val);
  }
  $sql = "select count(*) from $table where " . implode(" && ", $str) . "";
 } else {
  $sql = "select count(*) from $table";
 }
 return $pdo->query($sql)->fetchColumn();
}