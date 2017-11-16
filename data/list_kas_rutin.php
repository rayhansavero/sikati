<?php
$con = mysqli_connect('localhost','root','','sikati');
?>

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
                  <th class="text-center">Nama</th>
                  <th class="text-center">Total Pembayaran</th>
                  <th class="text-center">Detail Pembayaran</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $qu = mysqli_query($con,"select * from list_kas_rutin");
                while ($has = mysqli_fetch_row($qu))
                {
                  ?>
                  <tr>
                    <td><?php echo $has[1]; ?></td>
                    <td>Rp <?php echo $has[3]; ?></td>
                    <td td style="text-align:center">
                      <!--TOMBOL DETAIL DATA-->
                      <button type="button" class="btn btn-primary btn-xs waves-effect" data-toggle="modal" data-target="#detailKR<?php echo $has[1]; ?>">
                        <i class="material-icons">description</i>
                      </button>
                      <!--MODAL DETAIL DATA-->
                      <div class="modal fade" id="detailKR<?php echo $has[1]; ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog " role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Detail Pembayaran <?php echo $has[1]; ?></h4>
                            </div>
                            <div class="modal-body">
                              <!--form action="" method="POST" role="form"-->
                              <div class="col-md-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                  </span>
                                  <div class="form-line">
                                    <input type="text" class="form-control" name="tanggal" value="<?php echo $has[2]; ?>">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="material-icons">attach_money</i>
                                  </span>
                                  <div class="form-line">
                                    <input type="text" class="form-control" name="bayar" value="Rp <?php echo $has[3]; ?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                            <!--/form-->
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL EDIT DATA PENGURUS-->
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
