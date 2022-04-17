<!DOCTYPE html>
<html lang="en">

<head>
<title>Soal 2 | Bryan Adi</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.50">

    <link rel="stylesheet" href="styles.css">
    
</head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: center;
  border-bottom: 1px solid #DDD;
}

tr:hover {background-color: #D6EEEE;}
</style>
</head>
<body>

<h2>Daftar Pakaian</h2>
<p>Bryan Adi | 20050974058</p>

    <table>

        <tr>
            
            <th>Gambar</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Ukuran</th>
            <th>Contact</th>
            <th>Warna</th>
        </tr>


        <?php

			$json_data = file_get_contents("products.json");
			$products = json_decode($json_data, true);
			if(count($products) != 0){
				foreach ($products as $product) {
					?>
        <tr>
            <td>
                <img src="<?php echo $product['gambar']; ?>" alt="">
            </td>
            <td>
                <?php echo $product['nama']; ?>
            </td>
            <td>
                <?php echo $product['harga']; ?>;
            </td>
            <td>
                <?php echo $product['ukuran']; ?>
            </td>
            <td>
                <?php echo $product['contact']; ?>
            </td>
            <td>
                <select name="warna" id="warna">
                    <option value="pilih warna">Pilih Warna</option>
                    <option value="merah">Merah</option>
                    <option value="kuning">Kuning</option>
                    <option value="hijau">Hijau</option>
                </select>
            </td>
        </tr>
        <?php
				}
			}
		?>
    </table>
</body>

</html>