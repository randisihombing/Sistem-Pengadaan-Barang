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
                    <a href="#">Stock</a>
                </li>
                <li class="active">Tambah Stock Out</li>
            </ul>
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Tambah Stock Out
                </h1>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <form role="form" id="frmtbh">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input class="form-control" type="date" value="<?= date('Y-m-d') ?>" name="tanggal" required>
                            </div>
                            <div>
                                <label>Kode Barang</label>
                            </div>
                            <div class="form-group input-group">
                                <input type="hidden" name="barang_id" id="barang_id">
                                <input type="text" id="kode_barang" name="kode_barang" class="form-control" autofocus readonly>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-barang">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="nama_unit">Nama Barang</label>
                                        <input type="text" name="nama" id="nama" value="-" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="stock">Stock</label>
                                        <input type="text" name="stock" id="stock" value="-" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input class="form-control" type="text" value="" id="keterangan" name="keterangan">
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input class="form-control" type="number" value="" id="qty" name="qty" min="1">
                            </div>

                            <div class="form-group">
                                <button type="submit" id="btnsave" class="btn btn-success btn-flat">Simpan</button>
                                <button type="reset" class="btn btn-default btn-flat">Reset</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$this->load->view('layout/footer');
?>

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
                        <?php
                        $barang = $this->db->query("select * from barang")->result();
                        foreach ($barang as $b => $data) { ?>
                            <tr>
                                <td><?= $data->kode_barang ?></td>
                                <td><?= $data->nama ?></td>
                                <td class="text-right"><?= $data->harga ?></td>
                                <td class="text-right"><?= $data->stock ?></td>
                                <td class="text-right">
                                    <button class="btn btn-xs btn-info" id="select" data-id="<?= $data->barang_id ?>" data-kode_barang="<?= $data->kode_barang ?>" data-nama=" <?= $data->nama ?>" data-stock="<?= $data->stock ?>">
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

<script type="text/javascript">
    $(document).on('click', '#select', function() {
        $('#barang_id').val($(this).data('id'))
        $('#kode_barang').val($(this).data('kode_barang'))
        $('#nama').val($(this).data('nama'))
        $('#harga').val($(this).data('harga'))
        $('#stock').val($(this).data('stock'))
        $('#modal-barang').modal('hide')
    })
    $(document).ready(function() {
        $("#btnsave").click(function() {
            $("#frmtbh").validate({
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url() ?>/stock/store_out",
                        dataType: "text",
                        data: $("#frmtbh").serialize(),
                        cache: false,
                        success: function(data) {
                            var header = data.split("\t");
                            switch (header[0]) {
                                case 'OK':
                                    Swal.fire("Success", "Berhasil", "success").then(function() {
                                        window.location.href = "<?php echo base_url(); ?>stock/tambah_stock_out";
                                    });
                                    break;
                                case 'errkode':
                                    Swal.fire("Gagal", "Barang Harus Diisi", "error").then(function() {
                                        $("#kode_barang").focus().select();
                                    });
                                    break;
                                case 'errket':
                                    Swal.fire("Gagal", "Keterangan Harus Diisi", "error").then(function() {
                                        $("#keterangan").focus().select();
                                    });
                                    break;
                                case 'errqty':
                                    Swal.fire("Gagal", "Quantity Harus Diisi", "error").then(function() {
                                        $("#qty").focus().select();
                                    });
                                    break;
                                default:
                                    Swal.fire("Gagal", header[0], "error");
                            }
                        }
                    });
                }
            });
        });
    });
</script>