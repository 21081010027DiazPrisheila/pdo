<?php 
  include ('koneksi.php'); 

  $status = '';
  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['productCode'])) {
          //query SQL
          $productCode_upd = $_GET['productCode'];
          $query = $koneksi->prepare("SELECT * FROM products WHERE productCode = :productCode");
          //binding data
          $query->bindParam(':productCode',$productCode_upd);
          //eksekusi query
          $query->execute(); 
      }  
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productCode = $_POST['productCode'];
        $productName = $_POST['productName'];
        $productLine = $_POST['productLine'];
        $productScale = $_POST['productScale'];
        $productVendor = $_POST['productVendor'];
        $productDescription = $_POST['productDescription'];
        $quantityInStock = $_POST['quantityInStock'];
        $buyPrice = $_POST['buyPrice'];
        $MSRP = $_POST['MSRP'];

      //query SQL
      $query = $koneksi->prepare("UPDATE products SET productName=:productName, 
      productLine=:productLine, productScale=:productScale, productVendor=:productVendor, 
      productDescription=:productDescription, quantityInStock=:quantityInStock, 
      buyPrice=:buyPrice, MSRP=:MSRP WHERE productCode=:productCode"); 

      //binding data
      $query->bindParam(':productCode',$productCode);
      $query->bindParam(':productName',$productName);
      $query->bindParam(':productLine',$productLine);
      $query->bindParam(':productScale',$productScale);
      $query->bindParam(':productVendor',$productVendor);
      $query->bindParam(':productDescription',$productDescription);
      $query->bindParam(':quantityInStock',$quantityInStock);
      $query->bindParam(':buyPrice',$buyPrice);
      $query->bindParam(':MSRP',$MSRP);

      //eksekusi query
      if ($query->execute()) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }

      //redirect ke halaman lain
      header('Location: products.php?status='.$status);
  }
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UPDATE PRODUCTS</title>
</head>
<body>
    <div class = "container" >
        <h2 align="center">DATA PRODUCTS</h2>
            <table style="width:100%" cellspacing="0">
            <tr class="atas">
                    <td class="dua">
                        <center> 
                          <p><a class="nav-link" href="<?php echo "addproducts.php"; ?>"><b>Menambah Data</b></a></p>   
                          <p><a class="nav-link" href="<?php echo "products.php"; ?>"><b>Data Products</b></a></p>
                        </center>    
                    </td>
                </tr>

                <tr class="akhir">
                    <td colspan="3">
                        <h2>UPDATE PRODUCTS</h2>
                            <form action="updateproducts.php" method="POST">
                            <?php while($data = $query->fetch(PDO::FETCH_ASSOC)): ?>
                                <div>
                                    <label>Product Code</label>
                                    <input type="text" class="form-control" placeholder="Product Code" name="productCode" value="<?php echo $data['productCode']; ?>" required="required" readonly>        
                                </div>

                                <div>
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" placeholder="Product Name" name="productName" value="<?php echo $data['productName']; ?>" required="required">
                                </div>

                                <div>
                                    <label>Product Line</label>
                                    <input type="text" class="form-control" placeholder="Product Line" name="productLine" value="<?php echo $data['productLine']; ?>" required="required">
                                </div>

                                <div>
                                    <label>Product Scale</label>
                                    <input type="text" class="form-control" placeholder="Product Scale" name="productScale" value="<?php echo $data['productScale']; ?>" required="required">
                                </div>

                                <div>
                                    <label>Product Vendor</label>
                                    <input type="text" class="form-control" placeholder="Product Vendor" name="productVendor" value="<?php echo $data['productVendor']; ?>" required="required">
                                </div>

                                <div>
                                    <label>Product Description</label>
                                    <input type="text" class="form-control" placeholder="Product Description" name="productDescription" value="<?php echo $data['productDescription']; ?>" required="required">
                                </div>

                                <div>
                                    <label>Quantity In Stock</label>
                                    <input type="text" class="form-control" placeholder="Quantity In Stock" name="quantityInStock" value="<?php echo $data['quantityInStock']; ?>" required="required">
                                </div>

                                <div>
                                    <label>Buy Price</label>
                                    <input type="text" class="form-control" placeholder="Buy Price" name="buyPrice" value="<?php echo $data['buyPrice']; ?>" required="required">
                                </div>

                                <div>
                                    <label>MSRP</label>
                                    <input type="text" class="form-control" placeholder="MSRP" name="MSRP" value="<?php echo $data['MSRP']; ?>" required="required">        
                                </div>

                                <button type="submit">Update</button>
                                <?php endwhile; ?>
                            </form>
                    </td>
            </tr>
</body>
</html>