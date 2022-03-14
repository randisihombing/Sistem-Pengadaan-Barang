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

    <h4 style="text-align: center;">LAPORAN SPH</h4>

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
        <?php
        if (isset($_GET['tgl_awal'])) {
            $tgl_awal = $_GET['tgl_awal'];
            $tgl_akhir = $_GET['tgl_akhir'];
            $tgl_awal = date("Y-m-d 00:00:00", strtotime($tgl_awal));
            $tgl_akhir = date("Y-m-d 23:59:59", strtotime($tgl_akhir));
        ?>
            <tr>
                <th>Nomor Pemesanan</th>
                <th>Nama Penerima</th>
                <th>Tanggal Tagihan</th>
            </tr>
            <tbody>
                <?php
                $query = $this->db->query("SELECT * FROM sph WHERE created_date >= '$tgl_awal' AND created_date <= '$tgl_akhir'")->result();
                foreach ($query as $key => $value) {
                ?>
                    <tr>
                        <td><?php echo $value->no_pesanan ?></td>
                        <td><?php echo $value->nm_cust ?></td>
                        <td><?php echo $value->tanggal_surat ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        <?php
        }
        ?>
    </table>
</body>

</html>