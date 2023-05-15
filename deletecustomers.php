<?php
include ('koneksi.php');

$status = '';
$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['customerNumber'])) {

    //mengambil data customers yg akan dihapus
    $customerNumber_upd = $_GET['customerNumber'];
    $query = $koneksi->prepare("DELETE FROM customers WHERE customerNumber = :customerNumber ");
    //binding data
    $query->bindParam(':customerNumber',$customerNumber_upd);
    //eksekusi query
    if ($query->execute()) {
      $status = 'ok';
    }
    else{
      $status = 'err';
    }
          //redirect ke halaman lain
          header('Location: customers.php?status='.$status);
      }  
  }
  ?>