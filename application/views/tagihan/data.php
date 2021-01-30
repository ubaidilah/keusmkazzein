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
              <th>Nama Santri</th>
              <th>Kelas</th>
              <th>Jurusan</th>
              <th>Nama Tagihan</th>
              <th>Total Tagihan</th>
              <th>Status</th>
              <th>Admin</th>
              <!-- <th>Action</th> -->
            </tr>
          </thead>
          <tbody>
            <?php $i = 0;  ?>
            <?php foreach ($data_tagihan as $tag ) : ?>
              <?php $i++; ?>
            <tr>
              <th scope="row"><?= $i; ?></th>
              <td><?= $tag['nama_santri']; ?></td>
              <td><?= $tag['nama_kelas']; ?></td>
              <td><?= $tag['nama_jurusan']; ?></td>
              <td><?= $tag['nama_tagihan']; ?></td>
              <?php if ($tag['jenis'] == 1 ) {?>
              <td><?= 'Rp. '.number_format($tag['total_tagihan'],false,false,'.'); ?></td>
              <?php } else { ?>
              <td><?= 'Rp. '.number_format($tag['total'],false,false,'.'); ?></td><?php } ?>
              <td><?php if ($tag['is_status'] == 1) { ?>
                <span class="badge badge-success">Lunas</span>
              <?php }else {?> <span class="badge badge-danger">Belum Bayar</span> <?php } ?>
              </td>
              <td><?= $tag['name']; ?></td>
            <!--   <td>
                  <a href="<?= site_url('tagihan/billing/'.$tag['id'])?>" class="badge badge-success">Buat Tagihan</a>
                  <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $tag['id'];?>">Delete</a>
              </td> -->
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
