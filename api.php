<?php
include_once "base.php";

//利用網址傳值的方式(GET)來指定要執行的程式碼或功能
$do=(!empty($_GET['do']))?$_GET['do']:"";

switch($do){
  case "total":
    //用來更新訪客人數的程式碼
    $total=find("total",1);
    $total['total']=$_POST['total'];
    save("total",$total);

    to("admin.php","do=total");
  break;
  case "bottom":
    //用來更新頁尾版權文字的程式碼
    $bottom=find("bottom",1);
    $bottom['bottom']=$_POST['bottom'];
    save("bottom",$bottom);

    to("admin.php","do=bottom");
  break;
  case "newData":
    //新增資料的共用程式碼

    //先取得要更新資料表名稱
    $table=$_POST['table'];

    //先判斷有沒有檔案上傳
    if(!empty($_FILES['file']['tmp_name'])){

      //如果有檔案上傳，則將檔名先記入$data中
      $data['file']=$_FILES['file']['name'];

      //如果有檔案上傳，則將暫存目錄下的檔案移到指定的目錄下，並將檔名指定為原本的檔名
      move_uploaded_file($_FILES['file']['tmp_name'],"./img/" . $data['file']);
    }

    //依據資料表名稱來進行不同的資料收集(因為欄位名稱可能不同)
    switch($table){
      case "title":
        $data['text']=$_POST['text'];
        $data['sh']=0;
      break;
      case "mvim":
      case "image":
        $data['sh']=1;
      break;
      case "ad":
      case "news":
        $data['text']=$_POST['text'];
        $data['sh']=1;
      break;
      case "admin":
        $data['acc']=$_POST['acc'];
        $data['pw']=$_POST['pw'];
      break;
      case "menu":
        $data['text']=$_POST['text'];
        $data['href']=$_POST['href'];
        $data['sh']=1;
      break;
    }

    //收集完新增資料需要的陣列內容後，存入資料表
    save($table,$data);
    to("admin.php","do=$table");
  break;
  case "editData":

    //編輯資料共用程式碼
    $table=$_POST['table'];
    
    //依照表單傳來的id的筆數來決定要處理多少筆資料
    foreach($_POST['id'] as $key => $id){
        //先判斷該筆資料是否也同時是要被刪除的資料
        //如果id有在del的陣列中，那就直接刪除
        if(in_array($id,$_POST['del'])){
            //刪除該id的資料
            del($table,$id);

        }else{
          //更新資料前先取出該id的資料
          $data=find($table,$id);

          //依據資料表來決定要更新的資料內容
          switch($table){
            case "title":
              $data['text']=$_POST['text'][$key];
              $data['sh']=($_POST['sh']==$id)?1:0;
            break;
            case "mvim":
            case "image":
              $data['sh']=(in_array($id,$_POST['sh']))?1:0;
            break;
            case "ad":
            case "news":
              $data['text']=$_POST['text'][$key];
              $data['sh']=(in_array($id,$_POST['sh']))?1:0;
            break;
            case "admin":
              $data['acc']=$_POST['acc'][$key];
              $data['pw']=$_POST['pw'][$key];
            break;
            case "menu":
              $data['text']=$_POST['text'][$key];
              $data['href']=$_POST['href'][$key];
              $data['sh']=(in_array($id,$_POST['sh']))?1:0;;
            break;
          }
          //更新完資料內容後存入資料表
          save($table,$data);
        }

    }

    to("admin.php","do=$table");
  break;
  case "updateImage":
    //更新圖片及動畫的共用程式碼
    $table=$_POST['table'];
    $image=find($table,$_POST['id']);

    if(!empty($_FILES['file']['tmp_name'])){
      $image['file']=$_FILES['file']['name'];
      move_uploaded_file($_FILES['file']['tmp_name'],"./img/" . $image['file']);

    }

    save($table,$image);
    to("admin.php","do=$table");
  break;
  case "editSub":
    //編輯次選單的程式碼

    //先取得資料表名稱，或寫死成menu也可以
    $table=$_POST['table'];
    //取得主選單的id
    $parent=$_POST['parent'];

    if(!empty($_POST['id'])){
      //更新資料
      foreach($_POST['id'] as $key => $id){
        if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
            del($table,$id);
        }else{
          $sub=find("menu",$id);
          $sub['text']=$_POST['text'][$key];
          $sub['href']=$_POST['href'][$key];
          save("menu",$sub);
        }
      }
    }

    //依據有無text2欄位來決定是否要新增次選單資料
    if(!empty($_POST['text2'])){
      foreach($_POST['text2'] as $key => $newText){
        //進行次選單的資料收集
        $new['text']=$newText;
        $new['href']=$_POST['href2'][$key];  //取得次選單對應的連結網址資料
        $new['parent']=$parent;   //寫入主選單id
        $new['sh']=1;
        save("menu",$new);
      }
    }

    to("admin.php","do=menu");
  break;
  default:

  echo "非法入侵";


}


?>