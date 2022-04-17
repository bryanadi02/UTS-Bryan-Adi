<?php

 $bk = array(
    array(
      "judul" => "Pemrograman Web dengan Laravel",
      "pengarang" => "Budi Sutejo",
      "tahun" => 2019
    ),
    array(
      "judul" => "Belajar Mandiri Python",
      "pengarang" => "Ahmad Arifin",
      "tahun" => 2010
    ),
    array(
      "judul" => "Microsoft Word untuk Penulisan Ilmiah",
      "pengarang" => "Edi Rahmadi",
      "tahun" => 2015
    )
  );
?>
<title>Soal 1 | Bryan Adi</title>
<style>
table, th, td {
  border: 1px solid white;
  border-collapse: collapse;
}
th, td {
  background-color: #96D4D4;
  padding-top: 10px;
  padding-bottom: 20px;
  padding-left: 30px;
  padding-right: 30px;
}
</style>
</head>
<body>

<h2>Bryan Adi Prakoso</h2>

<p>20050974058 / PTI 2020 B</p>

<table style="width:100%">
  <thead>
    <tr>
      <th style="text-align:center"> <scope="col">No</th>
      <th style="text-align:center"> <scope="col">Judul Buku</th>
      <th style="text-align:center"> <scope="col">Pengarang</th>
      <th style="text-align:center"> <scope="col">Tahun Terbit</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no =1;
    foreach($bk as $b){
      echo "<tr>";
      echo "<td>".$no."</td>
      <td> ".$b['judul']."</td>
      <td>".$b['pengarang']."</td>
      <td>".$b['tahun']."</td>";
      echo "</tr>";
      $no++;
    }
    ?>
  </tbody>
  
</table>

