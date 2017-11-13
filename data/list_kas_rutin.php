<?php
$con = mysqli_connect('localhost','root','','sikati');
?>
<!-- Exportable Table -->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
          Data Kas Rutin HMJ TI
        </h2>
      </div>

      <div class="body">
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#tambahKR">
              <i class="material-icons">add</i>
              <span>Tambah Data</span>
            </button>
          </div>
          <!--TOMBOL TAMBAH DATA KR-->

          <!--TABEL DATA KR-->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
              <thead>
                <tr>
                  <th class="text-center">Id</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Jumlah Bayar</th>
                  <th class="text-center">Tanggal</th>
                  <th class="text-center">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $qu = mysqli_query($con,"select * from list_kas_rutin");
                while ($has = mysqli_fetch_row($qu))
                {
                  ?>
                  <tr>
                    <td><?php echo $has[0]; ?></td>
                    <td><?php echo $has[1]; ?></td>
                    <td><?php echo $has[2]; ?></td>
                    <td><?php echo $has[3]; ?></td>
                    <td td style="text-align:center">
                      <!--TOMBOL EDIT DATA-->
                      <button type="button" class="btn btn-primary btn-xs waves-effect" data-toggle="modal" data-target="#editKR<?php echo $has[0]; ?>">
                        <i class="material-icons">edit</i>
                      </button>
                      <!--TOMBOL HAPUS DATA-->
                      <button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#hapusKR<?php echo $has[0]; ?>">
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
        <!--END TABEL DATA KR-->

      </div>

    </div>
  </div>
</div>
            <!-- #END# Exportable Table -->
