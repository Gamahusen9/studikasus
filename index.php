<?php
require 'controller.php';
$students = query("SELECT * FROM students");
if (isset($_POST["submit"])) {
  header("Location: tambah.php");
}
if (isset($_POST["hapus"])) {
  header("Location: delete.php");
}
if (isset($_POST["ubah"])) {
  header("Location: update.php");
}
if (isset($_POST["lihat"])) {
  header("Location: tampil.php");
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DATA</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <style>
    #table{
      background-color: blueviolet;
      color: aqua;
    }
  </style>


</head>
<div class="card border border-1 border border-white shadow p-3 mb-5 bg-body-tertiary rounde" style="margin: 150px; padding:25px; width: 30rem;">
  <div class="card-body bg-white text-dark" id="table">



    <table class="mb-3 table border-3 border border-dark shadow p-3 mb-4 text-dark" border="2">
      <h1 align="center">Data Siswa</h1>
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Nis</th>
          <th scope="col">Rombel</th>
          <th scope="col">Rayon</th>
          <th scope="col">Status</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>

      <tbody class="mb-3">
        <?php $i = 1;  ?>
        <?php foreach ($students as $student) { ?>
          <tr>
            <td> <?= $i ?></td>
            <td> <?= $student["nama"] ?></td>
            <td> <?= $student["nis"] ?></td>
            <td> <?= $student["rombel"] ?></td>
            <td> <?= $student["rayon"] ?></td>
            <td> <?= $student["status"] ?></td>
            <td>
              <?php $student["id"] ?>
              <a class="btn btn-danger border-1 border border-white" href="delete.php?id=<?= $student["id"] ?>" onclick="return confirm('yakin data mau dihapus?')" role="button">HAPUS</a> |
              <a class="btn btn-info border-1 border border-white " href="update.php?id=<?= $student["id"] ?>" role="button">UBAH</a> |
              <a class="btn btn-warning border-1 border border-white " href="tampil.php?id=<?= $student["id"] ?>" role="button">LIHAT</a>
  </div>
  </td>
  </tr>
  <?php $i++ ?>
<?php } ?>
<div class="mb-3">
  <form action="" method="post">
    <button type="submit" class="btn btn-success" name="submit">Tambah Data</button>

</div>
</form>
</tbody>
</table>
</div>
</div>

</div>
</div>

<body>
</body>

</html>l