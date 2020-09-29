<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



  <div class="row">
    <div class="col-lg">
      <?php if (validation_errors()) :?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors();?>
        </div>
      <?php endif; ?>

        <?= $this->session->flashdata('message'); ?>

        <div class="container">
        <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
          <form action="<?= site_url('tabungan/save_transaksi')?>" method="post">
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0" >
              <label for="santri">Nama Santri</label>
              <input type="text" class="form-control" id="nm_santri"  value="<?= $cekout['nama_santri']; ?>" name="nm_santri" readonly >
              <input type="hidden" class="form-control" id="santri"  value="<?= $cekout['id']; ?>" name="santri" readonly >
             </div>
            <div class="col-sm-6">
              <label for="debit">Saldo Saat ini</label>
              <input type="text" class="form-control" readonly value="<?= 'Rp. '.number_format($cekout['debit'],false,false,'.'); ?>" >
              <input type="hidden" class="form-control" id="debit"  readonly value="<?= $cekout['debit']; ?>" name="debit" >
            </div>
          </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0" >
              <label for="kredit">Total Uang</label>
              <input type="text" class="form-control"  readonly value="<?= 'Rp. '.number_format($detail['kredit'],false,false,'.'); ?>"  >
              <input type="hidden" class="form-control" id="kredit" readonly value="<?= $detail['kredit']; ?>" name="kredit" >
            </div>
            <div class="col-sm-6">
              <label for="keterangan">Keterangan</label>
              <input type="text" class="form-control" name="keterangan" id="keterangan" value="<?=$detail['keterangan']?>" readonly >
            </div>
          </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0" >
                <label for="tgl">Tanggal</label>
                <input type="text" class="form-control" id="tgl" readonly value="<?=$detail['tgl']?>" name="tgl" >
              </div>
              <?php if ($detail['jenis'] == 2 ) { ?>
              <div class="col-sm-6 mb-3 mb-sm-0" >
                <label for="saldo_akhir">Saldo Akhir</label>
                <input type="text" class="form-control" readonly value="<?= 'Rp. '.number_format($cekout['debit']+$detail['kredit'],false,false,'.'); ?>" >
                <input type="hidden" class="form-control" id="saldo_akhir" readonly value="<?= $cekout['debit']+$detail['kredit']; ?>" name="saldo_akhir" >
              </div>
            <?php }else { ?>
                <div class="col-sm-6 mb-3 mb-sm-0" >
                  <label for="saldo_akhir">Saldo Akhir</label>
                  <input type="text" class="form-control" readonly value="<?= 'Rp. '.number_format($cekout['debit']-$detail['kredit'],false,false,'.'); ?>" >
                  <input type="hidden" class="form-control" id="saldo_akhir" readonly value="<?= $cekout['debit']-$detail['kredit']; ?>" name="saldo_akhir" >
                </div>
              <?php } ?>
              <input type="hidden" class="form-control" id="tipe" value="<?=$detail['tipe']?>" placeholder="Jumlah Uang yang diambil" name="tipe" >
              <input type="hidden" class="form-control" id="jenis" value="<?=$detail['jenis']?>" placeholder="Jumlah Uang yang diambil" name="jenis" >
            </div>
            <div class="col-md-12 bg-light text-right">
              <a href="<?= site_url('tabungan/transaksi')?>" type="submit" class="btn btn-warning right-block" >Batal</a>
            <button type="submit" class="btn btn-primary right-block" >Cash Out</button>
            </div>
          </form>
        </div>
      </div>
      <div>
    </div>
  </div>
</div>
</div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
