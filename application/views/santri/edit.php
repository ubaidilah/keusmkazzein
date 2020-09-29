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
              <label for="santri">Nama Santri<span style="color:red;">*</span></label>
              <input type="text" class="form-control" id="nama" placeholder="Enter nama" name="nama" value="<?= $santri['nama_santri']; ?>">
            </div>
            <div class="form-group">
              <label for="debit">NIS</label>
              <input type="number" class="form-control" id="nis" placeholder="Enter nis" name="nis" value="<?= $santri['nis']; ?>">
            </div>
            <div class="form-group">
              <label for="kelas">Jenis Kelamin<span style="color:red;">*</span></label>
              <select name="jk" id="jk" class="form-control select2">

                <option value="L" <?php if ($santri['jk'] == 'L') echo 'selected'; ?>>Laki - Laki</option>
                <option value="P" <?php if ($santri['jk'] == 'P') echo 'selected'; ?>>Perempuan</option>

              </select>
            </div>
            <div class="form-group">
              <label for="kelas">Kelas<span style="color:red;">*</span></label>
              <select name="kelas" id="kelas" class="form-control select2">
                <option value="">Pilih Kelas</option>
                <?php
                  foreach ($kelas as $k) {
                    echo '<option value="'.$k['id_kelas'].'" '.(($k['id_kelas'] == $santri['kd_kelas'])?'selected="selected"':"").'>'.$k['nama_kelas'].'</option>';
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="jurusan">Jurusan<span style="color:red;">*</span></label>
              <select name="jurusan" id="jurusan" class="form-control select2">
                <option value="">Pilih Jurusan</option>
                <?php
                  foreach ($jurusan as $j) {
                    echo '<option value="'.$j['id_jurusan'].'" '.(($j['id_jurusan'] == $santri['kd_jurusan'])?'selected="selected"':"").'>'.$j['nama_jurusan'].' || '.$j['singkatan'].'</option>';
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="program">Program<span style="color:red;">*</span></label>
              <select name="program" id="program" class="form-control select2">
                <option value="">Pilih Program</option>
                <?php
                  foreach ($program as $p) {
                    echo '<option value="'.$p['id'].'" '.(($p['id'] == $santri['kd_program'])?'selected="selected"':"").'>'.$p['nama_program'].'</option>';
                  }
                ?>
              </select>
            </div>
            <div class="form-group">

              <a href="<?= site_url('santri')?>" type="submit" class="btn btn-warning right-block" >Batal</a>
            <button type="submit" class="btn btn-primary right-block">Simpan</button>
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
<!-- <script>
$('#js-example-basic-single').select2()
</script> -->
