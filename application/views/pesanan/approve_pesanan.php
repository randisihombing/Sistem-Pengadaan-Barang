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
                    <a href="#">Data Pesanan</a>
                </li>
                <li class="active">Approve Data Pesanan</li>
            </ul>
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Approve Data Pesanan
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
                                    <th>Nomor Pesanan</th>
                                    <th>Nama Pemesan</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($approve as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?php echo $value->kode_barang ?></td>
                                        <td><?php echo $value->nama ?></td>
                                        <td><?php echo $value->no_psn ?></td>
                                        <td><?php echo $value->nama_psn ?></td>
                                        <td>Rp. <?php echo number_format($value->harga) ?></td>
                                        <td><?php echo $value->qty ?></td>
                                        <td>Rp. <?php echo number_format($value->harga) ?></td>
                                        <td><?php echo $value->status ?></td>
                                        <td>
                                            <form method="post" action="<?php echo base_url('pesanan/proses_approve') ?>">
                                                <input type="hidden" name="pesanan_id" value="<?php echo $value->pesanan_id ?>">
                                                <button class="btn btn-success" id="btnApprove" data-id="<?php echo $value->pesanan_id ?>" title="Approve">
                                                    <i class="fa fa-check"> Approve </i>
                                                </button>
                                            </form>
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

<?php
$this->load->view('layout/footer');
?>

<script type="text/javascript">
    $(document).ready(function() {
        <? if ($this->input->get('status') == "OK") { ?>
            setTimeout(function() {
                swal.fire("Success", "Berhasil", "success").then(function() {
                    window.location.href = "<?= base_url(); ?>pesanan/approve";
                });
            }, 1000);
        <? } ?>
    });
</script>