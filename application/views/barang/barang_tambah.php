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
                    <a href="#">Barang</a>
                </li>
                <li class="active">Tambah Barang</li>
            </ul>
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Tambah Barang
                </h1>
            </div>
            <div class="page-body">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <form role="form" id="frmtbh">
                                    <div class="form-group">
                                        <label>Kode Barang *</label>
                                        <input class="form-control" value="" type="text" id="kode_brg" name="kode_brg">
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori Barang*</label>
                                        <div class="form-select">
                                            <select class="form-control" id="kode_kat" name="kode_kat">
                                                <option value="">- Pilih Kategori Barang -</option>
                                                <?php
                                                $kategori = $this->db->query("select * from kategori")->result();
                                                foreach ($kategori as $data_kat) {
                                                ?>
                                                    <option value="<?php echo $data_kat->kode_kat ?>"><?php echo $data_kat->kode_kat ?> - <?php echo $data_kat->nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Barang *</label>
                                        <input class="form-control" value="" type="text" id="nama" name="nama">
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Barang *</label>
                                        <input class="form-control" value="" type="text" id="harga" name="harga">
                                    </div>
                                    <div class="form-group">
                                        <label>Stock *</label>
                                        <input class="form-control" value="0" type="text" id="stock" name="stock" readonly>
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
        $("#kode_brg").focus().select();


        $("#btnsimpan").click(function() {
            $("#frmtbh").validate({
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url() ?>/barang/store",
                        dataType: "text",
                        data: $("#frmtbh").serialize(),
                        cache: false,
                        success: function(data) {
                            var header = data.split("\t");
                            switch (header[0]) {
                                case 'OK':
                                    Swal.fire("Success", "Berhasil", "success").then(function() {
                                        window.location.href = "<?php echo base_url(); ?>barang/tambah_barang";
                                    });
                                    break;
                                case 'errbrg':
                                    Swal.fire("Gagal", "Kode Barang Harus Diisi", "error").then(function() {
                                        $("#kode_brg").focus().select();
                                    });
                                    break;
                                case 'errkat':
                                    Swal.fire("Gagal", "Kategori Harus Diisi", "error").then(function() {
                                        $("#kode_kat").focus().select();
                                    });
                                    break;
                                case 'brgada':
                                    Swal.fire("Gagal", "Kode Barang Sudah Ada", "error").then(function() {
                                        $("#kode_brg").focus().select();
                                    });
                                    break;
                                case 'errnama':
                                    Swal.fire("Gagal", "Nama Barang Harus Diisi", "error").then(function() {
                                        $("#nama").focus().select();
                                    });
                                    break;
                                case 'namaada':
                                    Swal.fire("Gagal", "Nama Barang Sudah Ada", "error").then(
                                        function() {
                                            $("#nama").focus().select();
                                        });
                                    break;
                                case 'errhrg':
                                    Swal.fire("Gagal", "Harga Harus Diisi", "error").then(function() {
                                        $("#harga").focus().select();
                                    });
                                    break;
                                case 'errstock':
                                    Swal.fire("Gagal", "Quantity Harus Diisi", "error").then(function() {
                                        $("#stock").focus().select();
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