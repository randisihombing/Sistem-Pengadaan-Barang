<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <img src="<?= base_url('assetss/assets/images/') ?>logo.png" alt style="right: 0px; ">

    <h3>CV. Lumeic Indonesia</h3>
    <p>Jl. Cisaranten Kulon No.9</p>
    <p>Kel. Cisaranten Kulon Kec. Arcamanik, Kota Bandung</p>
    <p>Phone : 082216946222</p>
    <p>e-mail : cv.lumeic2014@gmail.com</p>

    <h4 style="text-align: center;">LAPORAN TAGIHAN</h4>

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
            <th>Nomor Pemesanan</th>
            <th>Nama Penerima</th>
            <th>Harga Satuan Barang</th>
            <th>Qty</th>
            <th>Total Harga Barang</th>
            <th>Tanggal Tagihan</th>
        </tr>
        <tbody>
        <?php
            foreach ($pesanan_approve as $key => $value) {
        ?>
            <tr>
                <td><?php echo $value->kode_barang ?></td>
                <td><?php echo $value->nama ?></td>
                <td><?php echo $value->no_psn ?></td>
                <td><?php echo $value->nama_psn ?></td>
                <td>Rp. <?php echo number_format($value->harga) ?></td>
                <td><?php echo $value->qty ?></td>
                <td>Rp. <?php echo number_format($value->total) ?></td>
                <td><?php echo $value->tgl_psn ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
    </table>
    <table>
        <tr class="text2">
            <td>Total Harga</td>
            <td width="541">: Rp. <?php echo number_format($sum )  ?></b></td>
        </tr>
    </table>
</body>
</html>