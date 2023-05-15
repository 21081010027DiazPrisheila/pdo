<?php 
  include ('koneksi.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>

    <div >
      <div >
        <nav >
            <ul class="pemweb">
                <li class="pemweb"><a>Pemrograman Web</a></li>
          
                <li class="navi"><a href="<?php echo "customers.php"; ?>">Data Customers</a></li>
                <li class="navi"><a href="<?php echo "products.php"; ?>">Data Products</a></li>
                <li class="navi"><a href="<?php echo "addproducts.php"; ?>">Tambah Data</a></li>
              </li>
            </ul>
        </nav>

        <main role="main" >
          <?php 
            //mengecek apakah proses update dan delete sukses/gagal
            if (@$_GET['status']!==NULL) {
              $status = $_GET['status'];
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Products berhasil di-update</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Products gagal di-update</div>';
              }

            }
           ?>
          <h2 align="center">PRODUCTS</h2>
            <table border="1" align="center">
              <thead>
              <tr>
                  <th>productCode</th>
                  <th>productName</th>
                  <th>productLine</th>
                  <th>productScale</th>
                  <th>productVendor</th>
                  <th>productDescription</th>
                  <th>quantityInStock</th>
                  <th>buyPrice</th>
                  <th>MSRP</th>
                  <th>akses</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  //proses menampilkan data dari database dengan PDO:
                  //siapkan query SQL
                  $query = "SELECT * FROM products";
                  //eksekusi query
                  $result = $koneksi->query($query);

                 ?>

                 <?php while($data = $result->fetch(PDO::FETCH_ASSOC) ): ?>
                  <tr>
                    <td><?php echo $data['productCode'];  ?></td>
                    <td><?php echo $data['productName'];  ?></td>
                    <td><?php echo $data['productLine'];  ?></td>
                    <td><?php echo $data['productScale'];  ?></td>
                    <td><?php echo $data['productVendor'];  ?></td>
                    <td><?php echo $data['productDescription'];  ?></td>
                    <td><?php echo $data['quantityInStock'];  ?></td>
                    <td><?php echo $data['buyPrice'];  ?></td>
                    <td><?php echo $data['MSRP'];  ?></td>
                    <td>
                      <a href="<?php echo "updateproducts.php?productCode=".$data['productCode']; ?>" class="btn btn-outline-warning btn-sm"> Update</a>
                      &nbsp;&nbsp;
                      <a href="<?php echo "deleteproducts.php?productCode=".$data['productCode']; ?>" class="btn btn-outline-danger btn-sm"> Delete</a>
                    </td>
                  </tr>
                 <?php endwhile ?>
              </tbody>
            </table>
        </main>
      </div>
    </div>
  </body>
</html>