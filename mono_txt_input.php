<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MONOリスト（入力画面）</title>
</head>

<body>
  <form action="mono_txt_create.php" method="POST">
    <fieldset>
      <legend>MONOリスト（入力画面）</legend>
      <a href="mono_txt_read.php">一覧画面</a>
      <div>
        名前: <input type="text" name="name">
      </div>
      <div>
        登録日: <input type="date" name="date">
      </div>
      <div>
        分類: 
        <select name="classification">
          <option value="日用品">日用品</option>
          <option value="趣味">趣味</option>
          <option value="本・書籍">本・書籍</option>
          <option value="服">服</option>
          <option value="仕事道具">仕事道具</option>
          <option value="消耗品">消耗品</option>
          <option value="インテリア">インテリア</option>
          <option value="その他">その他</option>
        </select>
      </div>
      <div>
        頻度: 
        <select name="frequency">
          <option value="毎日使う">毎日使う</option>
          <option value="１ヶ月に１回使う">１ヶ月に１回使う</option>
          <option value="１年に１回使う">１年に１回使う</option>
          <option value="使っていない">使っていない</option>
        </select>
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>

    
  </form>

 

</body>

</html>