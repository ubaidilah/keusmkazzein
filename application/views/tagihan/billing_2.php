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
          <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body" onclick="toggler('ambil');">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Buat Billing By Kelas</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body" onclick="toggler('tambah');">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Buat Billing By Siswa</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="card shadow mb-4" id="ambil" style="display:none;" >
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Buat Billing santri Berdasarkan Kelas</h6>
        </div>
        <div class="card-body">
          <form action="" method="post">
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0" >
              <label for="kelas">Kelas </label>
              <select name="kelas" id="kelas" class="form-control select2">
                <option value="">Pilih Kelas</option>
                <?php foreach ($kelas as $k) : ?>
                  <option value="<?= $k['id_kelas'];?>"><?= $k['nama_kelas'];?></option>
                <?php endforeach; ?>
              </select>
              <input type="hidden" name="kode" value="1">
            </div>
          </div>
            <button type="submit" class="btn btn-primary" >Submit</button>
          </form>
        </div>
      </div>

      <div class="card shadow mb-4" id="tambah" style="display:none;" >
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat Billing santri Berdasarkan Nama Nama</h6>
      </div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0" >
            <label for="santri">Nama Santri</label>
            <select name="santri[]" id="santri" class="form-control select2" multiple="multiple">
              <option value="">Cari Santri</option>
              <?php foreach ($santri as $s) : ?>
                <option value="<?= $s['id'];?>"><?= $s['nama_santri'];?></option>
              <?php endforeach; ?>
            </select>
            <input type="hidden" name="kode" value="2">
          </div>
        </div>
          <button type="submit" class="btn btn-primary" >Submit</button>
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
