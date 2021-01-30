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
          <div class="row">
          <div class="col-xl-12 col-md-12 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body" >
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Transaksi Pembayaran Tagihan</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="card shadow mb-4" >
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Buat Billing santri Berdasarkan Kelas</h6>
        </div>
        <div class="card-body">
          <form action="cekout" method="post">
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0" >
              <label for="santri">Nama Santri</label>
              <select name="santri" id="santri" class="form-control select2">
                <option value="">Pilih Santri</option>
                <?php foreach ($santri as $t) : ?>
                  <option value="<?= $t['id'];?>"><?= $t['nama_santri'];?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0" >
              <label for="tagihan">Jenis Tagihan</label>
              <select name="tagihan" id="tagihan" class="form-control select2">
                <?php foreach ($jenis_tagihan as $jt) : ?>
                  <option value="<?= $jt['id'];?>"><?= $jt['nama_tagihan'];?></option>
                <?php endforeach; ?>
              </select>
              <!-- <input type="hidden" name="kode" value="1"> -->
            </div>
          </div>
           <div class="form-group row">
              <div class="col-sm-6">
              <label for="tgl">Tanggal</label>
              <span class="fas fa-calendar-alt"></span>
              <input type="text" autocomplete="off" class="form-control" value="<?= date('Y-m-d'); ?>" id="datepicker" placeholder="Tanggal mengambil Uang" name="tgl" >
            </div>
           </div>
            <button type="submit" class="btn btn-primary" >Cek Tagihan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>

function toggler(divId) {
    $("#" + divId).toggle();
}
//
// function myFunction() {
//   var x = document.getElementById("ambil");
//   if (x.style.display === "none") {
//     x.style.display = "block";
//   } else {
//     x.style.display = "none";
//   }
// }
// function smFunction() {
//   var y = document.getElementById("tambah");
//   if (y.style.display === "none") {
//     y.style.display = "block";
//   } else {
//     y.style.display = "none";
//   }
// }

</script>
