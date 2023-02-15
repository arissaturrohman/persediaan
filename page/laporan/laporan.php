<div class="card shadow mb-4 col-6">
  <div class="card-body">
    <form action="page/cetak/tes1.php" method="POST">
      <div class="form-row mb-3">
        <div class="col">
          <select onChange="coba(this)" class="form-control form-control-sm" id="jenis" name="jenis">
            <option value="0">Jenis Laporan</option>
            <option value="1">Laporan 1</option>
            <option value="2">Laporan 2</option>
            <option value="3">Laporan 3</option>
          </select>
        </div>
        <div class="col">
          <select class="form-control form-control-sm" id="smt" name="smt">
            <option selected>Semester</option>
            <option value="1">1 (Satu)</option>
            <option value="2">2 (Dua)</option>
          </select>
        </div>
      </div>
      <div class="form-row mb-3">
        <div class="col">
          <select class="form-control form-control-sm" id="trx" name="trx">
            <option selected>No Trx</option>
            <option value="1">001</option>
            <option value="2">002</option>
          </select>
        </div>
        <div class="col">
          <select class="form-control form-control-sm" id="brg" name="brg">
            <option selected>Pilih Barang</option>
            <option value="1">1 (Satu)</option>
            <option value="2">2 (Dua)</option>
          </select>
        </div>
      </div>
      <div class="form-row float-right">
        <button type="submit" id="jajal" class="btn btn-sm btn-info ">Pilih</button>
      </div>
  </div>
  </form>
</div>

<script>
  $(document).ready(function() {
    $("#jajal").click(function(e) {
      e.preventDefault();
      var jenis = document.getElementById('jenis').value;
      var jen = $(this).attr('jenis');
      window.open(jen, '_blank');
    });
  });
  // document.getElementById("form").submit();
  // const form = document.querySelector('form');
  // form.addEventListener('submit', (e) => {
  //   e.preventDefault();
  //   const fd = new FormData(form);
  //   const obj = Object.fromEntries(fd);

  //   const json = JSON.stringify(obj);
  //   localStorage.setItem('form', json);

  //   window.location.href = "page/cetak/tes1.php";
  // })
  // function jajal() {

  //   var jenis = document.getElementById("jenis").value;
  //   var smt = document.getElementById("smt").value;
  //   var trx = document.getElementById("trx").value;
  //   var brg = document.getElementById("brg").value;

  //   if(jenis == 1){

  //   }
  // }
</script>

<script>
  function coba(pilihan) {
    if (pilihan.value == 1) {
      document.getElementById('smt').disabled = false;
      document.getElementById('trx').disabled = true;
      document.getElementById('brg').disabled = true;
    }
    if (pilihan.value == 2) {
      document.getElementById('smt').disabled = true;
      document.getElementById('trx').disabled = false;
      document.getElementById('brg').disabled = true;
    }
    if (pilihan.value == 3) {
      document.getElementById('smt').disabled = true;
      document.getElementById('trx').disabled = true;
      document.getElementById('brg').disabled = false;
    }
    if (pilihan.value == 0) {
      document.getElementById('smt').disabled = false;
      document.getElementById('trx').disabled = false;
      document.getElementById('brg').disabled = false;
    }
  }
</script>