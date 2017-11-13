    <section class="content">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                          <div class="icon-and-text-button-demo">
                              <button type="button" class="btn btn-primary waves-effect">
                                  <i class="material-icons">add</i>
                                  <span>Tambah Data</span>
                              </button>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jumlah Bayar</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                      <?php
                                      $con=mysqli_connect('localhost','root','','sikati');
                                      $qu=mysqli_query($con,"select * from list_kas_rutin");
                                      while($has=mysqli_fetch_row($qu))
                                      {
                                        echo "
                                        <tr>
                                        <td>$has[1]</td>
                                        <td>$has[2]</td>
                                        <td>$has[3]</td>
                                        </tr>
                                        ";
                                      }
                                      ?>
                                      </tbody>
                                </table>
                            </div>
                          </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        
    </section>
