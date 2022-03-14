<?php $no = 1;
if ($keranjang_pesanan->num_rows() > 0) {
    foreach ($keranjang_pesanan->result() as $c => $data) { ?>
        <tr>
            <td><?= $no++ ?>.</td>
            <td class="text-left"><?= $data->kode_barang ?></td>
            <td><?= $data->barang_nama ?></td>
            <td class="text-right"><?= $data->keranjang_harga ?></td>
            <td class="text-center"><?= $data->qty ?></td>
            <td class="text-right" id="total"><?= $data->total ?></td>
            <td class="text-center" width="160px">
                <button id="del_cart" data-keranjangid="<?= $data->keranjang_id ?>" class="btn btn-xs btn-danger">
                    <i class="fa fa-trash"> Delete</i>
                </button>
            </td>
        </tr>
<?php
    }
} else {
    echo '<tr>
                <td colspan="8" class="text-center">Tidak Ada Items</td>
            </tr>';
} ?>