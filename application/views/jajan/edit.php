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
          <form action="" method="post">
            <div class="form-group">
              <label for="santri">Nama Santri:</label>
              <select name="santri" id="santri" class="form-control select2">
                <option value="">Pilih Santri</option>
                <?php
                  foreach ($santri as $s) {
                    echo '<option value="'.$s['id'].'" '.(($s['id'] == $jajan['id_santri'])?'selected="selected"':"").'>'.$s['nama_santri'].'</option>';
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="debit">Saldo Akhir:</label>
              <input type="number" class="form-control" id="debit" placeholder="Enter debit" name="debit" value="<?= $jajan['debit']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
      <div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- <script>
$('#js-example-basic-single').select2()
</script> -->
