<?php
$id = $_GET['id'];
$password = password_hash(1234, PASSWORD_DEFAULT);

$sql = $conn->query("UPDATE tb_user SET password = '$password' WHERE id_user = '$id'");
if ($sql) {
?>
  <script>
    setTimeout(function() {
      swal({
        title: 'Alhamdulillah',
        text: 'Password berhasil direset',
        icon: 'success',
        timer: 3000,
        button: false
      });
    }, 10);
    window.setTimeout(function() {
      window.location.replace('user');
    }, 3000);
  </script>
<?php
}

?>