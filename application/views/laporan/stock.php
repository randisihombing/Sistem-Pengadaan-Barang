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
                        <a href="#">Rekap Stock</a>
                    </li>
                    <li class="active">Laporan Stock</li>
                </ul>
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-10">
                    <div class="page-content">
                        <div class="page-header">
                            Laporan Stock Barang
                        </div>
                        <div class="page-body">
                            <div class="box">
                                <div class="box-body">
                                    <div class="row">
                                        <form role="form" id="frmTbh" method="post" action="<?php echo base_url(); ?>laporan/stock" autocomplete="off">
                                            <div class="form-group">
                                                <label class="col-lg-4">Stock Barang</label>
                                                <div class="col-lg-8">
                                                    <select class="form-control" id="stock_barang" name="stock_barang">
                                                        <option value="semua">- Semua Stock Barang -</option>
                                                        <?php
                                                        foreach ($barang->result() as $key => $data_stock) {
                                                        ?>
                                                            <option value="<?php echo $data_stock->barang_id ?>"><?php echo $data_stock->nama ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
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
                        if (isset($_POST['stock_barang'])) {
                            $stock_barang = $_POST['stock_barang'];
                            $xyz = $_POST['xyz'];
                            if ($xyz == 2) {
                        ?>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Harga Barang</th>
                                                    <th>Stock Barang</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($stock_barang == "semua") {
                                                    $query = $this->db->query("SELECT * FROM barang")->result();
                                                } else {
                                                    $query = $this->db->query("SELECT * FROM barang WHERE barang_id = '$stock_barang'")->result();
                                                }
                                                foreach ($query as $key => $data) {
                                                ?>

                                                    <tr>
                                                        <td><?php echo $data->kode_barang ?></td>
                                                        <td><?php echo $data->nama ?></td>
                                                        <td>Rp. <?php echo number_format($data->harga) ?></td>
                                                        <td><?php echo round($data->stock, 2) ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <a class="btn btn-success" href="<?php echo base_url(); ?>laporan/cetak_stock?stock_barang=<?php echo $_POST['stock_barang'] ?>" target="_blank">Print Preview</a>
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
</body>

</html>