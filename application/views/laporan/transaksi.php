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
                        <a href="#">Rekap Tagihan</a>
                    </li>
                    <li class="active">Laporan Tagihan</li>
                </ul>
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-10">
                    <div class="page-content">
                        <div class="page-header">
                            Laporan Tagihan
                        </div>
                        <div class="page-body">
                            <div class="box">
                                <div class="box-body">
                                    <div class="row">
                                        <form role="form" id="frmTbh" method="post" action="<?php echo base_url(); ?>laporan/transaksi">
                                            <div class="form-group">
                                                <label class="col-lg-4">Tanggal Awal</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control date-picker" id="tgl_awal" name="tgl_awal" type="text" data-date-format="dd-mm-yyyy" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4">Tanggal Akhir</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control date-picker" id="tgl_akhir" name="tgl_akhir" type="text" data-date-format="dd-mm-yyyy" />
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
                                                    <th>Nama Barang</th>
                                                    <th>Nama Penerima</th>
                                                    <th>Harga Satuan Barang</th>
                                                    <th>Qty</th>
                                                    <th>Total Harga Barang(termasuk PPN)</th>
                                                    <th>Tanggal Tagihan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = $this->db->query("SELECT o.*, o.no_psn, b.nama, o.nama_psn, v.harga, v.qty, v.total 
                                                    FROM pesanan o JOIN pesanan_detail v ON o.pesanan_id = v.pesanan_id 
                                                    JOIN barang b ON v.barang_id = b.barang_id 
                                                    WHERE  o.created_date >= '$tgl_awal' AND o.created_date <= '$tgl_akhir'")->result();
                                                foreach ($query as $key => $value) {
                                                ?>

                                                    <tr>
                                                        <td><?php echo $value->no_psn ?></td>
                                                        <td><?php echo $value->nama ?></td>
                                                        <td><?php echo $value->nama_psn ?></td>
                                                        <td>Rp. <?php echo number_format($value->harga) ?></td>
                                                        <td><?php echo $value->qty ?></td>
                                                        <td>Rp. <?php echo number_format($value->total) ?></td>
                                                        <td><?php echo $value->tgl_psn ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <a class="btn btn-success" href="<?php echo base_url(); ?>laporan/cetak_transaksi?tgl_awal=<?php echo $_POST['tgl_awal'] ?>&tgl_akhir=<?php echo $_POST['tgl_akhir'] ?>" target="_blank">Print Preview</a>
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
</body>

</html>