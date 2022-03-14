<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        table {
            border-style: double;
            border-width: 3px;
            border-color: white;
        }

        table tr .text2 {
            text-align: right;
            font-size: 13px;
        }

        table tr .text {
            text-align: center;
            font-size: 13px;
        }

        table tr td {
            font-size: 13px;
        }
    </style>
</head>

<body onload="window.print()">
    <center>
        <table>
            <tr>
                <td><img src="<?= base_url('assetss/assets/images/') ?>logo.png" width="110" height="90"></td>
                <td>
                    <center>
                        <font size="4">CV. Lumeic Indonesia</font><br>
                        <font size="2">Jl. Cisaranten Kulon No.9</font><br>
                        <font size="2"><i>Kel. Cisaranten Kulon Kec. Arcamanik, Kota Bandung</i></font><br>
                        <font size="2"><i>Phone : 082216946222</i></font><br>
                        <font size="2"><i>e-mail : cv.lumeic2014@gmail.com</i></font>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <table width="625">
                <tr>
                    <td class="text2">Bandung, <?= date('d-m-Y') ?></td>
                </tr>
            </table>
        </table>
        <table>
            <tr class="text2">
                <td>Nomor</td>
                <td width="572">: <?= $pesanan->no_tagihan ?></td>
            </tr>
            <tr class="text2">
                <td>No. Pesanan</td>
                <td width="572">: <?= $pesanan->no_psn ?></td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td width="564">: Permohonan Pembayaran</td>
            </tr>
        </table>
        <br>
        <table width="625">
            <tr>
                <td>
                    <font size="2">Kpd yth.<br><?= $pesanan->nama_psn ?><br><?= $pesanan->alamat_psn ?></font>
                </td>
            </tr>
        </table>
        <br>
        <table width="625" border="1">
            <tr>
                <th align="left">Kode Barang</th>
                <th align="left">Nama Barang</th>
                <th align="left">Harga Satuan Barang</th>
                <th align="left">Jumlah Barang</th>
            </tr>
            <?php
            foreach ($pesanan_detail  as $key => $value) {
            ?>
                <tr>
                    <td><?php echo $value->kode_barang ?></td>
                    <td><?php echo $value->nama ?></td>
                    <td>Rp.<?php echo number_format($value->total) ?></td>
                    <td><?php echo $value->qty ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
        <table>
            <tr class="text2">
                <td>Total Harga</td>
                <td width="541">: Rp. <?php echo number_format($pesanan->total_harga) ?></b></td>
            </tr>
            <tr>
                <td>PPN</td>
                <td width="525">: Rp. <?php echo number_format($pesanan->ppn) ?></td>
            </tr>
            <tr>
                <td>Total Harga</td>
                <td width="525">: Rp. <?php echo number_format($pesanan->total_akhir) ?></td>
            </tr>
        </table>
        <table width="625">
            <tr>
                <td>
                    <font size="2">Ket. Pembayaran harap ditransfer ke : Bank Mandiri KCP Cicadas<br>A/n. CV. Lumeic Indonesia 132-00-1305008-4.</font>
                </td>
            </tr>
        </table>
        <br>
        </table>

        <br>
        <table width="625">
            <tr>
                <td width="430">Tanda Terima,<br><br><br><br></td>
                <td class="text" align="center">Hormat Kami<br><img src="<?= base_url('assetss/assets/images/') ?>cap.png" width="100" height="30"><br>Rintis Wahyudi, S.T</td>
            </tr>
        </table>
    </center>
</body>

</html>