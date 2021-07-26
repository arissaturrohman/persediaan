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
  $(function() {
    $("#kode").autocomplete({
      source: 'autocomplete.php'
    });
  });
</script>

<!-- Autofill -->
<script>
  function autofill() {
    var kode = $("#kode").val();
    $.ajax({
      url: "autofill.php",
      data: "kode=" + kode,
    }).success(function(data) {
      var json = data,
        obj = JSON.parse(json);
      $("#nama_barang").val(obj.nama_barang);
      $("#satuan_barang").val(obj.satuan_barang);
    });
  }
</script>

</body>

</html>