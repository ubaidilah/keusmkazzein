<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->



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
                <div class="card-body" onclick="toggler('ambil');">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Tagihan Santri</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="card shadow mb-4"  >
        <div class="card-body">
          <form action="" method="post">
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0" >
              <label for="santri">Nama Tagihan</label>
              <input type="text" class="form-control" autocomplete="off" placeholder="Masukkan Nama Tagihan" name="tagihan" >
            </div>
            <div class="col-sm-6">
              <label for="tgl">Total Tagihan</label>
              <input type="number" class="form-control" autocomplete="off"  placeholder="Total Tagihan" name="total" >
            </div>
          </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
  <div class="card shadow mb-4">
     <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Tagihan</h6>
    </div>
    <div class="card-body">
      <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">Tambah Uang Jajan</a> -->
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jumlah</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0;  ?>
            <?php foreach ($tagihan as $tag ) : ?>
              <?php $i++; ?>
            <tr>
              <th scope="row"><?= $i; ?></th>
              <td><?= $tag['nama_tagihan']; ?></td>
              <td><?= 'Rp. '.number_format($tag['total'],false,false,'.'); ?></td>
              <td>
                  <a href="<?= site_url('tagihan/billing/'.$tag['id'])?>" class="badge badge-success">Buat Tagihan</a>
                  <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $tag['id'];?>">Delete</a>
              </td>
            </tr>
          <?php  endforeach; ?>
          </tbody>
        </table>
      </div>
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
