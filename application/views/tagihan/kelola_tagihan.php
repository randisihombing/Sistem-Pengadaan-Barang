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
                    <a href="#">Tagihan</a>
                </li>
                <li class="active">Kelola Tagihan</li>
            </ul>
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Kelola Tagihan
                </h1>
            </div>
            <div class="page-body">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No Pesanan</th>
                                    <th>No Tagihan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data as $data_tag) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?php echo $data_tag->no_tagihan ?></td>
                                        <td><?php echo $data_tag->no_psn ?></td>
                                        <td class="text-center" width="160px">
                                            <button class="btn btn-warning btn-xs" id="btnedit" data-id="<?php echo $data_tag->no_tagihan ?>" title="Atur">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button class="btn btn-danger btn-xs" id="btndel" data-id="<?php echo $data_tag->no_tagihan ?>" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <a class="btn btn-primary btn-xs" href="<?= site_url('tagihan/cetak/' . $data_tag->pesanan_id) ?>"><i class="fa fa-print"></i></a>
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

<!-- Modal -->
<div class="modal fade" id="modal-Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalCenterTitle">Form Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="frmUbh">
                    <div class="form-group">
                        <label>No Pesanan *</label>
                        <select class="form-control" id="no_psn" name="no_psn" readonly>
                            <option value="">- Pilih No Pesanan -</option>
                            <?php
                            $pesanan = $this->db->query("SELECT * FROM pesanan")->result();
                            foreach ($pesanan as $data_psn) {
                            ?>
                                <option value="<?php echo $data_psn->pesanan_id ?>"><?php echo $data_psn->no_psn ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No Surat Jalan *</label>
                        <input class="form-control" value="" type="text" id="no_tagihan" name="no_tagihan">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnsave">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view('layout/footer');
?>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#btnedit', function() {
            var no_tagihan = $(this).attr("data-id");

            $.ajax({
                type: "post",
                url: "<?php echo base_url();  ?>tagihan/cari",
                dataType: "json",
                data: {
                    no_tagihan: no_tagihan
                },
                cache: false,
                success: function(data) {
                    $('#no_psn').val(data[0].pesanan_id);
                    $('#no_tagihan').val(data[0].no_tagihan);
                    $('#modal-Edit').modal('show');
                    setTimeout(function() {
                        $("#no_tagihan").focus().select();
                        $('#no_psn').attr("disabled", true)
                    }, 1000);
                }
            });
        });
        $(document).on('click', '#btnsave', function() {
            var no_psn = $("[name=no_psn]").val();
            var no_tagihan = $("[name=no_tagihan]").val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url() ?>/tagihan/update",
                dataType: "text",
                data: {
                    no_psn: no_psn,
                    no_tagihan: no_tagihan
                },
                cache: false,
                success: function(data) {
                    var header = data.split("\t");
                    switch (header[0]) {
                        case 'OK':
                            Swal.fire("Success", "Berhasil", "success").then(function() {
                                window.location.href = "<?php echo base_url(); ?>/tagihan/kelola_tagihan";
                            });
                            break;
                        case 'srtada':
                            Swal.fire("Gagal", "Surat Jalan Sudah Ada", "error").then(function() {
                                $("#no_tagihan").focus().select();
                            });
                            break;
                        case 'tagada':
                            Swal.fire("Gagal", "Nomor Tagihan Sudah Ada", "error").then(function() {
                                $("#no_tagihan").focus().select();
                            });
                            break;
                        case 'errsrt':
                            Swal.fire("Gagal", "Surat Jalan Harus Diisi", "error").then(function() {
                                $("#no_tagihan").focus().select();
                            });
                            break;
                        default:
                            Swal.fire("Gagal", header[0], "error");
                    }
                }
            });
        });

        $(document).on('click', '#btndel', function() {
            var no_tagihan = $(this).attr("data-id");

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
                        url: "<?php echo base_url();  ?>tagihan/delete",
                        dataType: "text",
                        data: {
                            no_tagihan: no_tagihan
                        },
                        cache: false,
                        success: function(data) {
                            var header = data.split("\t");
                            switch (header[0]) {
                                case 'OK':
                                    setTimeout(function() {
                                        Swal.fire('Success', 'Berhasil', 'success').then(function() {
                                            window.location.href = "<?php echo base_url(); ?>tagihan/kelola_tagihan";
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