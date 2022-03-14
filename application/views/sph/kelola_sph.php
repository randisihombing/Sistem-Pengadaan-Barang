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
                    <a href="#">SPH</a>
                </li>
                <li class="active">Kelola SPH</li>
            </ul>
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Kelola SPH
                </h1>
            </div>
            <div class="page-body">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. Pesanan</th>
                                    <th>Customer</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($row->result() as $key => $data) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data->no_pesanan ?></td>
                                        <td><?php echo $data->nm_cust ?></td>
                                        <td><?php echo indo_date($data->tanggal_surat) ?></td>
                                        <td class="text-center" width="160px">
                                            <button id="detail" data-target="#modal-detail" data-toggle="modal" class="btn btn-default btn-xs" data-no_pesanan="<?= $data->no_pesanan ?>" data-no_surat="<?= $data->no_surat ?>" data-tanggal_surat="<?= indo_date($data->tanggal_surat) ?>" data-time="<?= substr($data->sph_created, 11, 5) ?>" data-customer="<?= $data->nm_cust ?>" data-sphid="<?= $data->sph_id ?>"><i class="fa fa-eye"></i>
                                            </button>
                                            <button class="btn btn-danger btn-xs" id="btndel" data-id="<?php echo $data->no_pesanan ?>" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <!-- <a href="<?= site_url('sph/cetak/' . $data->sph_id); ?>" target="_blank" class="btn btn-success btn-xs ">
                                                <i class="fa fa-print"></i>
                                            </a> -->

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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">SPH Detail</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th style="width:20%">No. Pesanan</th>
                            <td style="width:30%"><span id="no_pesanan"></span></td>
                            <th style="width:20%">Customer</th>
                            <td style="width:30%"><span id="cust"></span></td>
                        </tr>
                        <tr>
                            <th>No. Surat</th>
                            <td><span id="no_surat"></alspan>
                            </td>
                            <th>Tanggal Surat</th>
                            <td><span id="tanggal_surat"></span></td>
                        </tr>
                        <tr>
                            <th>Barang</th>
                            <td colspan="3"><span id="barang"></span></td>
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

        $(document).on('click', '#btndel', function() {
            var no_pesanan = $(this).attr("data-id");

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
                        url: "<?php echo base_url();  ?>sph/delete",
                        dataType: "text",
                        data: {
                            no_pesanan: no_pesanan
                        },
                        cache: false,
                        success: function(data) {
                            var header = data.split("\t");
                            switch (header[0]) {
                                case 'OK':
                                    setTimeout(function() {
                                        Swal.fire('Success', 'Berhasil', 'success').then(function() {
                                            window.location.href = "<?php echo base_url(); ?>sph/kelola_sph";
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

        $(document).on('click', '#detail', function() {
            $('#no_pesanan').text($(this).data('no_pesanan'))
            $('#cust').text($(this).data('customer'))
            $('#no_surat').text($(this).data('no_surat'))
            $('#tanggal_surat').text($(this).data('tanggal_surat') + ' ' + $(this).data('time'))

            var barang = '<table class="table no-margin">'
            barang += '<tr><th>Nama Barang</th><th>Price</th><th>Qty</th></tr>'
            $.getJSON('<?= site_url('sph/sph_produk/') ?>' + $(this).data('sphid'), function(data) {
                $.each(data, function(key, val) {
                    barang += '<tr><td>' + val.nama + '</td><td>' + val.harga + '</td><td>' + val.qty + '</td><td>'
                })
                barang += '</table>'
                $('#barang').html(barang)
            })
        })
    });
</script>