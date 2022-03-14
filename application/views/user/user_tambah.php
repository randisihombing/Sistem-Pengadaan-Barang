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
                    <a href="#">User</a>
                </li>
                <li class="active">Tambah User</li>
            </ul>
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Tambah User
                </h1>
            </div>
            <div class="page-body">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <form role="form" id="frmtbh">
                                    <div class="form-group">
                                        <label>Nama Lengkap *</label>
                                        <input class="form-control" value="" type="text" id="nama" name="nama" pattern="[a-z A-Z]+">
                                    </div>
                                    <div class="form-group">
                                        <label>No Telpon *</label>
                                        <input class="form-control" value="" type="number" id="no_telp" name="no_telp">
                                    </div>
                                    <div class="form-group">
                                        <label>Username *</label>
                                        <input class="form-control" value="" id="username" type="text" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label>Password *</label>
                                        <input class="form-control" type="password" value="" id="password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password *</label>
                                        <input class="form-control" type="password" id="password2" name="password2">
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan *</label>
                                        <select class="form-control" name="level" id="level">
                                            <option value="">- Pilih -</option>
                                            <option value="admin">Admin</option>
                                            <option value="direktur">Direktur</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat *</label>
                                        <textarea class="form-control" type="text" id="alamat" name="alamat"></textarea>
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
        $("#btnsimpan").click(function() {
            $("#frmtbh").validate({
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url() ?>user/proses",
                        dataType: "text",
                        data: $("#frmtbh").serialize(),
                        cache: false,
                        success: function(data) {
                            var header = data.split("\t");
                            switch (header[0]) {
                                case 'OK':
                                    Swal.fire("Success", "Berhasil", "success").then(function() {
                                        window.location.href = "<?php echo base_url(); ?>user";
                                    });
                                    break;
                                case 'erruser':
                                    Swal.fire("Gagal", "Username Harus Diisi", "error").then(function() {
                                        $("#username").focus().select();
                                    });
                                    break;
                                case 'userudad':
                                    Swal.fire("Gagal", "Username Sudah Digunakan", "error").then(function() {
                                        $("#username").focus().select();
                                    });
                                    break;
                                case 'errnama':
                                    Swal.fire("Gagal", "Nama Harus Diisi", "error").then(function() {
                                        $("#nama").focus().select();
                                    });
                                    break;
                                case 'errpass':
                                    Swal.fire("Gagal", "Password harus diisi", "error").then(function() {
                                        $("#password").focus().select();
                                    });
                                    break;
                                case 'errpass2':
                                    Swal.fire("Gagal", "Konfirmasi Password harus diisi", "error").then(function() {
                                        $("#password2").focus().select();
                                    });
                                    break;
                                case 'erralamat':
                                    Swal.fire("Gagal", "Alamat harus diisi", "error").then(function() {
                                        $("#alamat").focus().select();
                                    });
                                case 'errlevel':
                                    Swal.fire("Gagal", "Jabatan harus diisi", "error").then(function() {
                                        $("#level").focus().select();
                                    });
                                case 'errtelp':
                                    Swal.fire("Gagal", "No Telpon harus diisi", "error").then(function() {
                                        $("#no_telp").focus().select();
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