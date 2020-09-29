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
          <form action="<?= site_url('tagihan/save_transaksi')?>" method="post">
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0" >
              <label for="santri">Nama Santri</label>
              <input type="text" class="form-control" id="nm_santri"  value="<?= $cekout['nama_santri']; ?>" name="nm_santri" readonly >
              <input type="hidden" class="form-control" id="santri"  value="<?= $cekout['id']; ?>" name="santri" readonly >
             </div>
            <div class="col-sm-6">
              <label for="tagihan">Nama Tagihan</label>
              <input type="text" class="form-control" readonly value="<?= $cekout['nama_tagihan']; ?>" >
              <input type="hidden" class="form-control" id="tagihan"  readonly value="<?= $cekout['nama_tagihan']; ?>" name="tagihan" >
            </div>
          </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0" >
              <label for="total">Total Tagihan</label>
              <input type="text" class="form-control"  readonly value="<?= 'Rp. '.number_format($cekout['total_tagihan'],false,false,'.'); ?>"  >
              <input type="hidden" class="form-control" id="total" readonly value="<?= $cekout['total_tagihan']; ?>" name="total" >
            </div>

            <div class="col-sm-6 mb-3 mb-sm-0" >
                <label for="tgl">Tanggal</label>
                <input type="text" class="form-control" id="tgl" readonly value="<?= $tanggal; ?>" name="tgl" >
              </div>
          </div>
            <div class="col-md-12 bg-light text-right">
              <a href="<?= site_url('tagihan/transaksi')?>" type="submit" class="btn btn-warning right-block" >Batal</a>
            <button type="submit" class="btn btn-primary right-block" >Bayar</button>
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
