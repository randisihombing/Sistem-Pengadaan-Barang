<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <img src="<?= base_url('assetss/assets/images/') ?>logo.png" alt style="right: 0px;">

    <h3>CV. Lumeic Indonesia</h3>
    <p>Jl. Cisaranten Kulon No.9</p>
    <p>Kel. Cisaranten Kulon Kec. Arcamanik, Kota Bandung</p>
    <p>Phone : 082216946222</p>
    <p>e-mail : cv.lumeic2014@gmail.com</p>

    <h4 style="text-align: center;">LAPORAN STOCK BARANG</h4>

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
        if (isset($_GET['stock_barang'])) {
            $stock_barang = $_GET['stock_barang'];
        ?>
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan Barang</th>
                    <th>Stock Barang</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if ($stock_barang == "semua") {
                    $query = $this->db->query("SELECT * FROM barang")->result();
                } else {
                    $query = $this->db->query("SELECT * FROM barang WHERE barang_id = '$stock_barang'")->result();
                }
                foreach ($query as $key => $data) {
                ?>
                    <tr>
                        <td><?php echo $data->kode_barang ?></td>
                        <td><?php echo $data->nama ?></td>
                        <td>Rp. <?php echo number_format($data->harga) ?></td>
                        <td><?php echo $data->stock ?></td>
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