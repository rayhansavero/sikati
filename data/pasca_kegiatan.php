<?php
$con = mysqli_connect('localhost','root','','sikati');
?>

<!--FORM DAFTAR KEGIATAN-->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
          <h2>Keuangan Pasca Kegiatan</h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-md-6">
              <b>Nama Kegiatan</b>
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">event</i>
                  </span>
                  <select class="form-control show-tick">
                    <option value="">-- Pilih Kegiatan --</option>
                    <option value=""></option>
                  </select>
              </div>
          </div>
          <div class="col-md-3">
              <b>Tanggal Kegiatan</b>
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">date_range</i>
                  </span>
                  <div class="form-line">
                      <input type="text" class="form-control" placeholder="tanggal kegiatan" disabled>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--TABEL KEGIATAN-->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
          <h2>Tabel Kegiatan</h2>
      </div>
      <div class="body">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
          <thead>
            <tr>
              <th class="text-center">Id</th>
              <th class="text-center">Uraian</th>
              <th class="text-center">Debet</th>
              <th class="text-center">Kredit</th>
              <th class="text-center">Jumlah</th>
              <th class="text-center">Keterangan</th>
              <th class="text-center">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $qu = mysqli_query($con,"select * from proses_kegiatan");
            while ($has = mysqli_fetch_row($qu))
            {
              ?>
              <tr>
                <td><?php echo $has[0]; ?></td>
                <td><?php echo $has[2]; ?></td>
                <td><?php echo $has[3]; ?></td>
                <td><?php echo $has[4]; ?></td>
                <td><?php echo $has[5]; ?></td>
                <td><?php echo $has[6]; ?></td>
                <td td style="text-align:center">
                  <!--TOMBOL EDIT DATA-->
                  <button type="button" class="btn btn-primary btn-xs waves-effect" data-toggle="modal" data-target="#editPraKeg<?php echo $has[0]; ?>">
                    <i class="material-icons">edit</i>
                  </button>
                  <!--TOMBOL HAPUS DATA-->
                  <button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#hapusPraKeg<?php echo $has[0]; ?>">
                    <i class="material-icons">delete</i>
                  </button>

                </td>
              </tr>
              <?php
              ;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
