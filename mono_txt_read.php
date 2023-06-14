<?php
// データまとめ用の空文字変数
$str = " ";
$data = array();

// ファイルを開く（読み取り専用）
$file = fopen('data/mono.csv', 'r');
// ファイルをロック
flock($file, LOCK_EX);

// fgets()で1行ずつ取得→$lineに格納
if ($file) {
  while ($line = fgets($file)) {
    // 取得したデータを`$data`に追加する
    $str .="<tr><td>{$line}</td></tr>";
    $data[] = $line;
  }
}

// ロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);

//変数をjson形式にする
$json_array = json_encode($data);


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MONOリスト（一覧画面）</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <fieldset>
    <legend>MONOリスト（一覧画面）</legend>
    <a href="mono_txt_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th><?=$str?></th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </fieldset>
  <div class="graph">
    <div class="graph1">
      <p>分類グラフ</p>
      <canvas id="classificationChart"></canvas>
    </div>
    <div class="graph2">
      <p>分類全ての頻度割合</p>
      <canvas id="frequencyChart"></canvas>
    </div>
    
  </div>

  <!-- <div>
    <p>日用品>頻度割合</p>
    <canvas id="frequencyChart1"></canvas>
  <div> -->

  </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>

  <script>
    // phpのjsデータを変数に置き換える
  const js_array = <?= $json_array ?>;

  console.log(js_array);


  // 分類の円グラフ
  const classificationData = {}; // 分類ごとのデータをカウントするためのオブジェクト
  js_array.forEach(item => {
    const classification = item.split(" ")[2]; // CSVデータの3番目の要素が分類
    if (classification in classificationData) {
      classificationData[classification]++;
    } else {
      classificationData[classification] = 1;
    }
  });

  const classificationChartCanvas = document.getElementById('classificationChart').getContext('2d');
  new Chart(classificationChartCanvas, {
    type: 'pie',
    data: {
      labels: Object.keys(classificationData),
      datasets: [{
        data: Object.values(classificationData),
        backgroundColor: [
          'rgba(255, 99, 132, 0.7)',
          'rgba(54, 162, 235, 0.7)',
          'rgba(255, 206, 86, 0.7)',
          'rgba(102, 255, 0, 0.7)',
          'rgba(0, 12, 255, 0.7)',
          'rgba(255, 0, 0, 0.7)',
          // 他の色も追加することができます
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
      },
    }
  });


   // 頻度の円グラフ
    const frequencyData = {}; // 頻度ごとのデータをカウントするためのオブジェクト
    js_array.forEach(item => {
    const frequency = item.split(" ")[3]; // CSVデータの4番目の要素が頻度
    if (frequency in frequencyData) {
      frequencyData[frequency]++;
    } else {
    frequencyData[frequency] = 1;
    }
  });

const frequencyChartCanvas = document.getElementById('frequencyChart').getContext('2d');
new Chart(frequencyChartCanvas, {
  type: 'pie',
  data: {
    labels: Object.keys(frequencyData),
    datasets: [{
      data: Object.values(frequencyData),
      backgroundColor: [
        'rgba(255, 0, 0, 0.7)',
        'rgba(255, 136, 1, 0.7)',
        'rgba(102, 0, 255, 0.7)',
        // 他の色も追加することができます
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
    },
  }
});


// // 頻度の円グラフ（日用品のみ）
// const frequencyData = {}; // 頻度ごとのデータをカウントするためのオブジェクト
// js_array.forEach(item => {
//   const classification = item.split(" ")[2]; // CSVデータの3番目の要素が分類
//   const frequency = item.split(" ")[3]; // CSVデータの4番目の要素が頻度
//   if (classification === "日用品") {
//     if (frequency in frequencyData) {
//       frequencyData[frequency]++;
//     } else {
//       frequencyData[frequency] = 1;
//     }
//   }
// });

// const frequencyChartCanvas = document.getElementById('frequencyChart1').getContext('2d');
// new Chart(frequencyChartCanvas, {
//   type: 'pie',
//   data: {
//     labels: Object.keys(frequencyData),
//     datasets: [{
//       data: Object.values(frequencyData),
//       backgroundColor: [
//         'rgba(255, 99, 132, 0.7)',
//         'rgba(54, 162, 235, 0.7)',
//         'rgba(255, 206, 86, 0.7)',
//         // 他の色も追加することができます
//       ],
//       borderWidth: 1
//     }]
//   },
//   options: {
//     responsive: true,
//     plugins: {
//       legend: {
//         position: 'top',
//       },
//     },
//   }
// });


  </script>
</body>

</html>