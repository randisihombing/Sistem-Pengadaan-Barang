<?php
$this->load->view('layout/header'); {
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
                        <a href="#">Data Laporan</a>
                    </li>
                    <li class="active">Laporan SPH</li>
                </ul>
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-10">
                    <div class="page-content">
                        <div class="page-header">
                            <h3>Laporan SPH</h3>
                        </div>
                        <div class="page-body">
                            <div class="box">
                                <div class="box-body">
                                    <div class="row">
                                        <form role="form" id="frmTbh" method="post" action="<?php echo base_url(); ?>laporan/sph" autocomplete="off">
                                            <div class="form-group">
                                                <label>Date:</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right date-picker" id="tgl_awal" name="tgl_awal" autocomplete="off" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Date range:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right date-picker" id="tgl_akhir" name="tgl_akhir" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <button type="submit" id="btnCari" class="btn btn-success">Simpan</button>
                                            <input type="hidden" name="xyz" id="xyz" value="2">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <?php
                        if (isset($_POST['tgl_awal'])) {
                            $tgl_awal = $_POST['tgl_awal'];
                            $tgl_akhir = $_POST['tgl_akhir'];
                            $tgl_awal = date("Y-m-d 00:00:00", strtotime($tgl_awal));
                            $tgl_akhir = date("Y-m-d 23:59:59", strtotime($tgl_akhir));
                            $xyz = $_POST['xyz'];
                            if ($xyz == 2) {
                        ?>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Nomor Pesanan</th>
                                                    <th>Nama Penerima</th>
                                                    <th>Tanggal Tagihan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = $this->db->query("SELECT * FROM sph WHERE created_date >= '$tgl_awal' AND created_date <= '$tgl_akhir'")->result();
                                                foreach ($query as $key => $value) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $value->no_pesanan ?></td>
                                                        <td><?php echo $value->nm_cust ?></td>
                                                        <td><?php echo $value->tanggal_surat ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <a class="btn btn-success" href="<?php echo base_url(); ?>laporan/cetak_sph?tgl_awal=<?php echo $_POST['tgl_awal'] ?>&tgl_akhir=<?php echo $_POST['tgl_akhir'] ?>" target="_blank">Print Preview</a>
                        <?php
                            }
                        }
                        ?>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
<?php
}
$this->load->view('layout/footer');
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.date-picker').datepicker({
                autoclose: true,
                todayHighlight: true
            })
            //show datepicker when clicking on the icon
            .next().on(ace.click_event, function() {
                $(this).prev().focus();
            });
    });
</script>