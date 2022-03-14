<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <img src="<?= base_url('assetss/assets/images/') ?>logo.png" alt="">
    <h3 style="text-align: right;">Bandung, <?= Date("d/m/Y", strtotime($sph->tanggal_surat)); ?> <br></h3>

    <h4 style="text-align: right;">Kepada Yth, <?= $sph->nm_cust ?><br> </h4>

    <h4 style="text-align: right;"> <?= $sph->alamat_cust ?> </h4>

    <h3>CV. Lumeic Indonesia</h3>
    <p>Jl. Cisaranten Kulon No.9</p>
    <p>Kel. Cisaranten Kulon Kec. Arcamanik, Kota Bandung</p>
    <p>Phone : 082216946222</p>
    <p>e-mail : cv.lumeic2014@gmail.com</p>

    <h3>NO SURAT PENAWARAN HARGA : <?= $sph->no_surat ?> </h3>

    <h4>Bersama ini kami ajukan penawaran harga atas pemesanan barang sesuai no pesanan : <?= $sph->no_pesanan ?> sebagai berikut</h4>

    <style>
        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
        }

        th {
            color: black;
        }

        img {
            width: 100px;
            position: fixed;
            top: 20px;
        }

        footer {
            text-align: right;
            color: black;
            margin-top: -53px;
        }
    </style>
</head>

<body onload="window.print()">
    <table style="width: 100%">
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th>Jumlah Barang</th>
        </tr>
        <?php
        foreach ($sph_detail  as $key => $value) {
        ?>
            <tr>
                <td><?php echo $value->kode_barang ?></td>
                <td><?php echo $value->nama ?></td>
                <td><?php echo $value->harga ?></td>
                <td><?php echo $value->qty ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>
<br>
<tr>
    <td width="100%"></td>
    <td>Tanda Terima,<br><br><br></td>
</tr>

<footer>
    <img src="<?= base_url('assetss/assets/images/') ?>cap.png" alt style="top: 561px;">
    <tr>
        <td>Hormat Kami,</td>
    </tr>
</footer>

</html>