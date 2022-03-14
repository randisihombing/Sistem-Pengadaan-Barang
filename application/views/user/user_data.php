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
                <li class="active">Data User</li>
            </ul>
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Data User
                </h1>
            </div>
            <div class="page-body">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>No. Telpon</th>
                                    <th>Alamat</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data as $du) { ?>
                                    <tr>
                                        <td style="width:5%;"><?= $no++ ?></td>
                                        <td><?= $du->username ?></td>
                                        <td><?= $du->nama ?></td>
                                        <td><?= $du->telp ?></td>
                                        <td><?= $du->alamat ?></td>
                                        <td><?= ucfirst($du->role) ?></td>
                                        <td class="text-center" width="160px">
                                            <button class="btn btn-warning btn-xs" id="btnedit" data-id="<?php echo $du->username ?>" title="Atur">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button class="btn btn-danger btn-xs" id="btndel" data-id="<?php echo $du->username ?>" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                        <label>Username</label>
                        <input class="form-control" id="username" name="username" placeholder="Masukan Username" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama User</label>
                        <input class="form-control" id="nama" name="nama" placeholder="Masukan Nama User">
                    </div>
                    <div class="form-group">
                        <label>No Telpon</label>
                        <input class="form-control" id="no_telp" name="no_telp" placeholder="Masukan No Telpon User">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat User">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password">
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" id="level" name="level">
                            <option value="">-- Pilih Level --</option>
                            <option value="admin">Admin</option>
                            <option value="direktur">Direktur</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="aktif">Aktif</option>
                            <option value="tidak">Tidak</option>
                        </select>
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
            var username = $(this).attr("data-id");

            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>user/cari",
                dataType: "json",
                data: {
                    username: username
                },
                cache: false,
                success: function(data) {
                    $('[name=username]').val(data[0].username);
                    $('[name=nama]').val(data[0].nama);
                    $('[name=no_telp]').val(data[0].telp);
                    $('[name=level]').val(data[0].role);
                    $('[name=alamat]').val(data[0].alamat);
                    $('[name=status]').val(data[0].status);
                    $('#modal-Edit').modal('show');
                    setTimeout(function() {
                        $("#nama").focus().select();
                    }, 1000);
                }
            });
        });

        $(document).on('click', '#btnsave', function() {
            var username = $("[name=username]").val();
            var password = $("[name=password]").val();
            var nama = $("#nama").val();
            var no_telp = $("#no_telp").val();
            var level = $("#level").val();
            var alamat = $("#alamat").val();
            var status = $("[name=status]").val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url() ?>user/update",
                dataType: "text",
                data: {
                    username: username,
                    nama: nama,
                    no_telp: no_telp,
                    level: level,
                    alamat: alamat,
                    status: status,
                    password: password
                },
                cache: false,
                success: function(data) {
                    var header = data.split("\t");
                    switch (header[0]) {
                        case 'OK':
                            Swal.fire("Success", "Berhasil", "success").then(function() {
                                window.location.href = "<?php echo base_url(); ?>user";
                            });
                            break;
                        case 'errnama':
                            Swal.fire("Gagal", "Nama User Harus Diisi", "error").then(function() {
                                $("#nama").focus().select();
                            });
                            break;
                        case 'errtelp':
                            Swal.fire("Gagal", "No Telpon Harus Diisi", "error").then(function() {
                                $("#no_telp").focus().select();
                            });
                            break;
                        case 'erralamat':
                            Swal.fire("Gagal", "Alamat Harus Diisi", "error").then(function() {
                                $("#alamat").focus().select();
                            });
                            break;
                        default:
                            Swal.fire("Gagal", header[0], "error");
                    }
                }
            });
        });

        $(document).on('click', '#btndel', function() {
            var username = $(this).attr("data-id");

            Swal.fire({
                    title: "Apakah Anda Yakin Ingin Menghapus Data ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Hapus`
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "post",
                            url: "<?php echo base_url(); ?>user/delete",
                            dataType: "text",
                            data: {
                                username: username
                            },
                            cache: false,
                            success: function(data) {
                                var header = data.split("\t");
                                switch (header[0]) {
                                    case 'OK':
                                        setTimeout(function() {
                                            Swal.fire("Success", "Berhasil", "success").then(function() {
                                                window.location.href = "<?php echo base_url(); ?>user";
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
                });
        });
    });
</script>