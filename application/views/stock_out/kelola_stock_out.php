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
                <li class="active">Kelola Stock Out</li>
            </ul>
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Kelola Stock Out
                </h1>
            </div>
            <div class="page-body">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Quantity</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $data_brg) {
                                ?>
                                    <tr>
                                        <td><?php echo $data_brg->kode_nama ?></td>
                                        <td><?php echo $data_brg->barang_nama ?></td>
                                        <td><?php echo $data_brg->qty ?></td>
                                        <td class="text-center" width="160px">
                                            <button class="btn btn-warning btn-xs" id="detail1" data-toggle="modal" data-target="#modal-detail" data-id="<?php echo $data_brg->kode_nama ?>" data-barangnama="<?= $data_brg->barang_nama ?>" data-qty="<?= $data_brg->qty ?>" data-date="<?= $data_brg->created_date ?>" data-keterangan="<?= $data_brg->keterangan ?>" title="Lihat">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <button class="btn btn-danger btn-xs" id="btndel" data-id="<?= $data_brg->stock_id ?>" data-barang="<?= $data_brg->barang_id ?>" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Detail Stock</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th style="width:50%">Kode Barang</th>
                            <td><span id="kode_barang"></span></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Nama Barang</th>
                            <td><span id="nama_barang"></span></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Quantity</th>
                            <td><span id="qty"></span></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Tanggal</th>
                            <td><span id="date"></span></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Keterangan</th>
                            <td><span id="keterangan"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view('layout/footer');
?>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#detail1', function() {
            var id = $(this).data('id');
            var barangnama = $(this).data('barangnama');
            var qty = $(this).data('qty');
            var date = $(this).data('date');
            var keterangan = $(this).data('keterangan');
            $('#kode_barang').text(id);
            $('#nama_barang').text(barangnama);
            $('#qty').text(qty);
            $('#date').text(date);
            $('#keterangan').text(keterangan);
        });

        $(document).on('click', '#btndel', function() {
            var stock = $(this).attr("data-id");
            var barang = $(this).attr("data-barang");

            Swal.fire({
                title: "Apakah Anda Yakin Ingin Menghapus Data ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Hapus`
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url();  ?>stock/out_hapus",
                        dataType: "text",
                        data: {
                            stock: stock,
                            barang: barang
                        },
                        cache: false,
                        success: function(data) {
                            var header = data.split("\t");
                            switch (header[0]) {
                                case 'OK':
                                    setTimeout(function() {
                                        Swal.fire('Success', 'Berhasil', 'success').then(function() {
                                            window.location.href = "<?php echo base_url(); ?>stock/kelola_stock_out";
                                        });
                                    }, 1000);
                                    break;
                                default:
                                    setTimeout(function() {
                                        Swal.fire("Gagal", header[0], "error");
                                    }, 1000);
                            }
                        }
                    });
                }
            })
        });
    });
</script>