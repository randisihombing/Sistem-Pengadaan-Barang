<?php
$this->load->view('layout/header');
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Pesanan</a>
                </li>
                <li class="active">Tambah Pesanan</li>
            </ul>
        </div>

        <div class="page-content">
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table width="100%">
                                    <tr>
                                        <td style="vertical-align:top">
                                            <label for="">Tanggal Surat</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="date" id="tgl_surat" value="<?= date('Y-m-d') ?>" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top; width:30%">
                                            <label for="">No. Surat</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" id="no_surat" value="" class="form-control" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top; width:30%">
                                            <label for="">Barang</label>
                                        </td>
                                        <td>
                                            <div class="form-group input-group">

                                                <input type="hidden" id="barang_id">
                                                <input type="hidden" id="harga">
                                                <input type="hidden" id="stock">
                                                <input type="hidden" id="qty_cart">
                                                <input type="text" id="kode_barang" class="form-control" autofocus readonly>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-barang">
                                                        <i class="ace-icon fa fa-search icon-on-right"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table width="100%">
                                    <tr>
                                        <td style="vertical-align:top">
                                            <label for="">Penerima</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" id="penerima" value="" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top">
                                            <label for="">Alamat</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" id="alamat" value="" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top; width:30%">
                                            <label for="qty">Quantity</label>
                                        </td>
                                        <td>
                                            <div class="form-group input-group">
                                                <input type="number" id="qty" value="1" min="1" class="form-control" required>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-info btn-sm btn-primary" id="add_cart">
                                                        <i class="fa fa-cart-plus"> Tambah</i>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box box-widget">
                            <div class="box-body">
                                <div align="right">
                                    <h4>No. Pesanan <b><span id="no_pesanan"><?= $no_pesanan ?></span></b></h4>
                                    <h1><b><span id="grand_total2" style="font-size:50pt">0</span></b></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-widget">
                            <div class="box-body table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cart-table">
                                        <?php $this->view('pesanan/keranjang_pesanan') ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table width="100%">
                                    <tr>
                                        <td style="vertical-align:top; width:30%">
                                            <label for="sub_total">Sub Total</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" id="sub_total" value="" class="form-control" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top">
                                            <label for="diskon">PPN</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" id="ppn" value="" min="0" class="form-control" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top">
                                            <label for="">Grand Total</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" id="grand_total" class="form-control" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div>
                            <button id="proses_pesanan" class="btn btn-flat btn-sm btn-success">
                                <i class="fa fa-paper-plane-o"> Bayar</i>
                            </button>
                            <button id="batal_pesan" class="btn btn-flat btn-sm btn-warning">
                                <i class="fa fa-refresh"> Batal</i>
                            </button><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('layout/footer');
?>
<!-- Modal Tambah Barang -->
<div class="modal fade" id="modal-barang">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Masukan Barang</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered tabel-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barang as $b => $data) { ?>
                            <tr>
                                <td><?= $data->kode_barang ?></td>
                                <td><?= $data->nama ?></td>
                                <td class="text-right"><?= $data->harga ?></td>
                                <td class="text-right"><?= $data->stock ?></td>
                                <td class="text-right">
                                    <button class="btn btn-xs btn-info" id="select" data-id="<?= $data->barang_id ?>" data-kode_barang="<?= $data->kode_barang ?>" data-harga="<?= $data->harga ?>" data-stock="<?= $data->stock ?>">
                                        <i class="fa fa-check"> Pilih</i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#select', function() {
        $('#barang_id').val($(this).data('id'))
        $('#kode_barang').val($(this).data('kode_barang'))
        $('#harga').val($(this).data('harga'))
        $('#stock').val($(this).data('stock'))
        $('#modal-barang').modal('hide')

        get_cart_qty($(this).data('kode_barang'))
    })

    function get_cart_qty(kode_barang) {
        $('#cart-table tr').each(function() {
            var qty_cart = $("#cart-table td.barcode:contains('" + kode_barang + "')").parent().find("td").eq(4).html()
            if (qty_cart != null) {
                $('#qty_cart').val(qty_cart)
            } else(
                $('#qty_cart').val(0)
            )
        })
    }

    $(document).on('click', '#add_cart', function() {
        var barang_id = $('#barang_id').val()
        var harga = $('#harga').val()
        var stock = $('#stock').val()
        var qty = $('#qty').val()
        var qty_cart = $('#qty_cart').val()

        if (barang_id == '') {
            alert('Product Belum Dipilih')
            $('#kode_barang').focus()
        } else if (stock < 1 || parseInt(stock) < (parseInt(qty_cart) + parseInt(qty))) {
            alert('Stock Tidak Mencukupi')
            $('#stock').focus('')
        } else if (qty < 1) {
            alert('Jumlah Barang Minimal 1')
            $('#qty').focus('')
        } else {
            $.ajax({
                type: 'POST',
                url: '<?= site_url('pesanan/proses') ?>',
                data: {
                    'add_cart': true,
                    'barang_id': barang_id,
                    'harga': harga,
                    'qty': qty
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        $('#cart-table').load('<?= site_url('pesanan/keranjang') ?>', function() {
                            calculate()
                        })
                        $('#barang_id').val('')
                        $('#kode_barang').val('')
                        $('#qty').val(1)
                        $('#kode_barang').focus('')
                    } else {
                        alert('Gagal Tambah Item Ke Keranjang')
                    }
                }
            })
        }
    })

    $(document).on('click', '#del_cart', function() {
        if (confirm('Apakah Anda Yakin ?')) {
            var keranjang_id = $(this).data('keranjangid')
            $.ajax({
                type: 'POST',
                url: '<?= site_url('pesanan/cart_del') ?>',
                data: {
                    'keranjang_id': keranjang_id
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        $('#cart-table').load('<?= site_url('pesanan/keranjang') ?>', function() {
                            calculate()
                        })
                    } else {
                        alert('Gagal Hapus Item')
                    }
                }
            })
        }
    })

    $(document).on('click', '#proses_pesanan', function() {
        var no_surat = $('#no_surat').val()
        var alamat = $('#alamat').val()
        var penerima = $('#penerima').val()
        var subtotal = $('#sub_total').val()
        var ppn = $('#ppn').val()
        var grandtotal = $('#grand_total').val()
        var tgl_surat = $('#tgl_surat').val()

        if (confirm('Yakin Proses Pesanan Ini ?')) {
            $.ajax({
                type: 'POST',
                url: '<?= site_url('pesanan/proses') ?>',
                data: {
                    'proses_pesanan': true,
                    'no_surat': no_surat,
                    'alamat': alamat,
                    'penerima': penerima,
                    'subtotal': subtotal,
                    'ppn': ppn,
                    'grandtotal': grandtotal,
                    'tgl_surat': tgl_surat
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        alert('Transaksi Berhasil')
                        // window.open('<?= site_url('pesanan/cetak/') ?>' + result.kasir_id, '_blank')
                    } else {
                        alert('Transaksi Gagal')
                    }
                    location.href = '<?= site_url('pesanan/tambah_pesanan') ?>'
                }
            })
        }
    })

    $(document).on('click', '#batal_pesanan', function() {
        if (confirm('Apakah Anda Yakin ?')) {
            $.ajax({
                type: 'POST',
                url: '<?= site_url('pesanan/cart_del') ?>',
                data: {
                    'batal_pesanan': true
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        $('#cart-table').load('<?= site_url('pesanan/keranjang') ?>', function() {
                            calculate()
                        })
                    }
                }
            })
            $('#kode_barang').val('')
            $('#kode_barang').focus()
        }
    })

    function calculate() {
        var subtotal = 0;
        $('#cart-table tr').each(function() {
            subtotal += parseInt($(this).find('#total').text())
        })
        isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

        var ppn = subtotal * (0.1)
        var grand_total = subtotal + ppn
        if (isNaN(grand_total)) {
            $('#grand_total').val(0)
            $('#grand_total2').text(0)
        } else {
            $('#grand_total').val(grand_total)
            $('#grand_total2').text(grand_total)
        }
        if (isNaN(ppn)) {
            $('#ppn').val(0)
        } else {
            $('#ppn').val(ppn)
        }
    }


    $(document).ready(function() {
        calculate()
    })
</script>