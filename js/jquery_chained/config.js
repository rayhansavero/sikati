$(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
  // Kita sembunyikan dulu untuk loadingnya
  $("#loading").hide();
  
  $("#th_pengurusan").change(function(){ // Ketika user mengganti atau memilih data provinsi
    $("#list_pengurus").hide(); // Sembunyikan dulu combobox kota nya
    $("#loading").show(); // Tampilkan loadingnya
  
    $.ajax({
      type: "POST", // Method pengiriman data bisa dengan GET atau POST
      url: "option_pengurus.php", // Isi dengan url/path file php yang dituju
      data: {th_pengurusan : $("#th_pengurusan").val()}, // data yang akan dikirim ke file yang dituju
      dataType: "json",
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){ // Ketika proses pengiriman berhasil
        $("#loading").hide(); // Sembunyikan loadingnya
        // set isi dari combobox kota
        // lalu munculkan kembali combobox kotanya
        $("#list_pengurus").html(response.data_list_pengurus).show();
      },
      error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
        alert(thrownError); // Munculkan alert error
      }
    });
    });
});