</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; Kecamatan Gajah 2019 - <?= date('Y'); ?></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal Barang -->
<div class="modal fade" id="kodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="dataTable" width="100%">
          <thead>
            <tr>
              <th width="20%">Kode Barang</th>
              <th>Nama Barang</th>
              <th>Satuan</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sql = $conn->query("SELECT * FROM tb_barang");
            while ($data = $sql->fetch_assoc()) {

            ?>
              <tr>
                <td><?= $data['kode_barang']; ?></td>
                <td><?= $data['nama_barang']; ?></td>
                <td><?= $data['satuan_barang']; ?></td>
                <td>
                  <button class="btn btn-sm btn-info" id="beli" data-kode="<?= $data['kode_barang']; ?>" data-barang="<?= $data['nama_barang']; ?>" data-satuan="<?= $data['satuan_barang']; ?>">
                    <i class=" fas fa-check"></i>
                  </button>
                  </span>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<!-- Modal Pengeluaran -->
<div class="modal fade" id="keluarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="tableKeluar" width="100%">
          <thead>
            <tr>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Satuan</th>
              <th>Jumlah</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sql = $conn->query("SELECT * FROM tb_pembelian WHERE volume > 0");
            while ($data = $sql->fetch_assoc()) {

            ?>
              <tr>
                <td><?= $data['kode_barang']; ?></td>
                <?php
                $kode_barang = $data['kode_barang'];
                $barang = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$kode_barang'");
                $data_barang = $barang->fetch_assoc();

                ?>
                <td><?= $data_barang['nama_barang']; ?></td>
                <td><?= $data_barang['satuan_barang']; ?></td>
                <td><?= $data['volume']; ?></td>

                <td>
                  <button class="btn btn-sm btn-info" id="keluar" data-idbeli="<?= $data['id_pembelian']; ?>" data-kode="<?= $data['kode_barang']; ?>" data-barang="<?= $data_barang['nama_barang']; ?>" data-satuan="<?= $data_barang['satuan_barang']; ?>" data-harga="<?= $data['harga_satuan']; ?>" data-stok="<?= $data['volume']; ?>">
                    <i class=" fas fa-check"></i>
                  </button>
                  </span>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<!-- Modal Saldo Awal -->
<div class="modal fade" id="saldoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="tableKeluar" width="100%">
          <thead>
            <tr>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Satuan</th>
              <th>Jumlah</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sql = $conn->query("SELECT * FROM tb_pembelian WHERE volume > 0");
            while ($data = $sql->fetch_assoc()) {

            ?>
              <tr>
                <td><?= $data['kode_barang']; ?></td>
                <?php
                $kode_barang = $data['kode_barang'];
                $barang = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$kode_barang'");
                $data_barang = $barang->fetch_assoc();

                ?>
                <td><?= $data_barang['nama_barang']; ?></td>
                <td><?= $data_barang['satuan_barang']; ?></td>
                <td><?= $data['volume']; ?></td>

                <td>
                  <button class="btn btn-sm btn-info" id="saldo" data-idbeli="<?= $data['id_pembelian']; ?>" data-kode="<?= $data['kode_barang']; ?>" data-barang="<?= $data_barang['nama_barang']; ?>" data-satuan="<?= $data_barang['satuan_barang']; ?>" data-harga="<?= $data['harga_satuan']; ?>" data-volume="<?= $data['volume']; ?>">
                    <i class=" fas fa-check"></i>
                  </button>
                  </span>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Import Saldo Awal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="tableKeluar" width="100%">
          <thead>
            <tr>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Satuan</th>
              <th>Jumlah</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sql = $conn->query("SELECT * FROM tb_saldo_awal WHERE volume > 0");
            while ($data = $sql->fetch_assoc()) {

            ?>
              <tr>
                <td><?= $data['kode_barang']; ?></td>
                <?php
                $kode_barang = $data['kode_barang'];
                $barang = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$kode_barang'");
                $data_barang = $barang->fetch_assoc();

                ?>
                <td><?= $data_barang['nama_barang']; ?></td>
                <td><?= $data_barang['satuan_barang']; ?></td>
                <td><?= $data['volume']; ?></td>

                <td>
                  <button class="btn btn-sm btn-info" id="import" data-idbeli="<?= $data['id_pembelian']; ?>" data-kode="<?= $data['kode_barang']; ?>" data-barang="<?= $data_barang['nama_barang']; ?>" data-satuan="<?= $data_barang['satuan_barang']; ?>" data-harga="<?= $data['harga_satuan']; ?>" data-volume="<?= $data['volume']; ?>">
                    <i class=" fas fa-check"></i>
                  </button>
                  </span>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script>
<script src="assets/vendor/jquery/autocomplete.min.js"></script>
<script src="assets/vendor/jquery/jquery.ui.js"></script>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="assets/js/demo/datatables-demo.js"></script>


<!-- Sweetalert tambah -->
<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != "") {
?>
  <script>
    setTimeout(function() {
      swal({
        title: "<?= $_SESSION['status']; ?>",
        text: "<?= $_SESSION['desc']; ?>",
        icon: "success",
        timer: 3000,
        button: false
      });
    }, 10);
    window.setTimeout(function() {
      window.location.replace("<?= $_SESSION['link'] ?>");
    }, 3000);
  </script>
<?php
  unset($_SESSION['status']);
}
?>

<!-- Sweetalert Hapus -->
<script>
  $(document).ready(function() {

    $('.delete').click(function(e) {
      e.preventDefault();
      var deleteid = $(this).attr("href");
      swal({
          title: "Yakin hapus?",
          text: "Data tidak bisa dikembalikan!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

            document.location.href = deleteid;
          }
        });
      return false;
    });

  });
</script>

<script>
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  });
</script>

<!-- Autocomplete -->
<script>
  $(document).ready(function() {
    $("#kode").autocomplete({
      source: 'autocomplete.php'
    });
  });
</script>

<script>
  $(document).ready(function() {
    $("#kode").change(function() {
      let kode = $('#kode').val();
      $.ajax({
        method: "GET",
        url: "autofill.php",
        // dataType: "JSON",
        data: {
          kode: kode
        }
      }).done(function(data) {
        // let obj = JSON.parse(data);
        $('#nama_barang').val(obj.nama_barang);
        $('#satuan_barang').val(obj.satuan_barang);

      });
    })
  });
</script>

<!-- Fungsi Kali -->
<script>
  function kali() {
    var volume = document.getElementById('volume').value;
    var harga = document.getElementById('harga_satuan').value;
    var result = parseInt(volume) * parseInt(harga);
    if (!isNaN(result)) {
      document.getElementById('jumlah_harga').value = result;
    }
  }
</script>

<!-- Autoload Barang -->
<script>
  $(document).ready(function() {
    $(document).on('click', '#beli', function() {
      var kode_barang = $(this).data('kode');
      var nama_barang = $(this).data('barang');
      var satuan_barang = $(this).data('satuan');
      $('#kode').val(kode_barang);
      $('#nama_barang').val(nama_barang);
      $('#satuan_barang').val(satuan_barang);
      $('#kodeModal').modal('hide');
    })
  })
</script>

<!-- Autoload Pengeluaran -->
<script>
  $(document).ready(function() {
    $(document).on('click', '#keluar', function() {
      var idbeli = $(this).data('idbeli');
      var kode_barang = $(this).data('kode');
      var nama_barang = $(this).data('barang');
      var satuan_barang = $(this).data('satuan');
      var harga_satuan = $(this).data('harga');
      var volume = $(this).data('stok');
      $('#id_pembelian').val(idbeli);
      $('#kode').val(kode_barang);
      $('#nama_barang').val(nama_barang);
      $('#satuan_barang').val(satuan_barang);
      $('#harga_satuan').val(harga_satuan);
      $('#stok').val(volume);
      $('#keluarModal').modal('hide');
    })
  })
</script>

<!-- Autoload Saldo Awal -->
<script>
  $(document).ready(function() {
    $(document).on('click', '#saldo', function() {
      var idbeli = $(this).data('idbeli');
      var kode_barang = $(this).data('kode');
      var nama_barang = $(this).data('barang');
      var satuan_barang = $(this).data('satuan');
      var harga_satuan = $(this).data('harga');
      var volume = $(this).data('volume');
      $('#id_pembelian').val(idbeli);
      $('#kode').val(kode_barang);
      $('#nama_barang').val(nama_barang);
      $('#satuan_barang').val(satuan_barang);
      $('#harga_satuan').val(harga_satuan);
      $('#volume').val(volume);
      $('#saldoModal').modal('hide');
    })
  })
</script>

<!-- Autoload Import Saldo Awal -->
<script>
  $(document).ready(function() {
    $(document).on('click', '#import', function() {
      var idbeli = $(this).data('idbeli');
      var kode_barang = $(this).data('kode');
      var nama_barang = $(this).data('barang');
      var satuan_barang = $(this).data('satuan');
      var harga_satuan = $(this).data('harga');
      var volume = $(this).data('volume');
      $('#id_pembelian').val(idbeli);
      $('#kode').val(kode_barang);
      $('#nama_barang').val(nama_barang);
      $('#satuan_barang').val(satuan_barang);
      $('#harga_satuan').val(harga_satuan);
      $('#volume').val(volume);
      $('#importModal').modal('hide');
    })
  })
</script>

<script>
  $('#tableKeluar').DataTable({
    ordering: true,
    info: true,
  });
</script>

<script>
  $('#tambahData').DataTable({
    ordering: false,
    info: false,
    searching: false,
    paging: false,
  });
</script>

<script>
  $('#customFile').on('change', function() {
    // Ambil nama file 
    let fileName = $(this).val().split('\\').pop();
    // Ubah "Choose a file" label sesuai dengan nama file yag akan diupload
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });
</script>

</body>

</html>