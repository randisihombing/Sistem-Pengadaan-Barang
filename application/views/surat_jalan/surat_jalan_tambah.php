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
                    <a href="#">Surat Jalan</a>
                </li>
                <li class="active">Tambah Surat Jalan</li>
            </ul>
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Tambah Surat Jalan
                </h1>
            </div>
            <div class="page-body">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <form role="form" id="frmtbh">
                                    <div class="form-group">
                                        <label>No Pesanan *</label>
                                        <select class="form-control" id="no_psn" name="no_psn">
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
                                        <input class="form-control" value="" type="text" id="no_srt_jln" name="no_srt_jln">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" id="btnsimpan" class="btn btn-success btn-flat">Simpan</button>
                                        <button type="reset" class="btn btn-default btn-flat">Reset</button>
                                    </div>
                                </form>
                            </div>
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

<script type="text/javascript">
    $(document).ready(function() {
        $("#no_psn").focus().select();


        $("#btnsimpan").click(function() {
            $("#frmtbh").validate({
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url() ?>/surat_jalan/store",
                        dataType: "text",
                        data: $("#frmtbh").serialize(),
                        cache: false,
                        success: function(data) {
                            var header = data.split("\t");
                            switch (header[0]) {
                                case 'OK':
                                    Swal.fire("Success", "Berhasil", "success").then(function() {
                                        window.location.href = "<?php echo base_url(); ?>surat_jalan/tambah_surat_jalan";
                                    });
                                    break;
                                case 'errpes':
                                    Swal.fire("Gagal", "No Pesanan Harus Diisi", "error").then(function() {
                                        $("#no_psn").focus().select();
                                    });
                                    break;
                                case 'srtada':
                                    Swal.fire("Gagal", "Surat Jalan Sudah Ada", "error").then(function() {
                                        $("#no_srt_jln").focus().select();
                                    });
                                    break;
                                case 'pesada':
                                    Swal.fire("Gagal", "No Pesanan Sudah Ada", "error").then(function() {
                                        $("#no_psn").focus().select();
                                    });
                                    break;
                                case 'errsrt':
                                    Swal.fire("Gagal", "Surat Jalan Harus Diisi", "error").then(function() {
                                        $("#no_srt_jln").focus().select();
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


    $(document).ready(function() {
        calculate()
    })

});
</script>