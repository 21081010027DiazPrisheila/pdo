<?php 
  include ('koneksi.php'); 

  $status = '';
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $customerNumber = $_POST['customerNumber'];
      $customerName = $_POST['customerName'];
      $contactLastName = $_POST['contactLastName'];
      $contactFirstName = $_POST['contactFirstName'];
      $phone = $_POST['phone'];
      $addressLine1 = $_POST['addressLine1'];
      $addressLine2 = $_POST['addressLine2'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $postalCode = $_POST['postalCode'];
      $country = $_POST['country'];
      $salesRepEmployeeNumber = $_POST['salesRepEmployeeNumber'];
      $creditLimit = $_POST['creditLimit'];
      
      //query with PDO
      $query = $koneksi->prepare("INSERT INTO customers (customerNumber, customerName, contactLastName, contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, country, salesRepEmployeeNumber, creditLimit)
       VALUES(:customerNumber, :customerName, :contactLastName, :contactFirstName, :phone, :addressLine1, :addressLine2, :city, :state, :postalCode, :country, :salesRepEmployeeNumber, :creditLimit)"); 

      //binding data
      $query->bindParam(':customerNumber',$customerNumber);
      $query->bindParam(':customerName',$customerName);
      $query->bindParam(':contactLastName',$contactLastName);
      $query->bindParam(':contactFirstName',$contactFirstName);
      $query->bindParam(':phone',$phone);
      $query->bindParam(':addressLine1',$addressLine1);
      $query->bindParam(':addressLine2',$addressLine2);
      $query->bindParam(':city',$city);
      $query->bindParam(':state',$state);
      $query->bindParam(':postalCode',$postalCode);
      $query->bindParam(':country',$country);
      $query->bindParam(':salesRepEmployeeNumber',$salesRepEmployeeNumber);
      $query->bindParam(':creditLimit',$creditLimit);

      //eksekusi query
      if ($query->execute()) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>ADD</title>
  </head>

  <body>
    <nav>
        <h2>Pemrograman Web</h2>
    </nav>

    <div>
      <div>
         <nav>
            <ul>
               <li>
                <a href="<?php echo "customers.php"; ?>">Data Customers</a>
              </li>
              <li>
                <a href="<?php echo "addcustomers.php"; ?>">Tambah Data</a>
              </li>
            </ul>
        </nav>

        <main role="main" >
          
          <?php 
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Customers berhasil disimpan</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Customers gagal disimpan</div>';
              }
           ?>

          <h3>Form Tambah Data Customers</h3>
          <form action="addcustomers.php" method="POST">
            
          <div>
              <label>customerNumber</label>
              <input type="text" placeholder="customerNumber" name="customerNumber" required="required">
            </div>
            <div>
              <label>customerName</label>
              <input type="text" placeholder="customerName" name="customerName" required="required">
            </div>
            <div>
              <label>contactLastName</label>
              <input type="text" placeholder="contactLastName" name="contactLastName" required="required">
            </div>
            <div>
              <label>contactFirstName</label>
              <input type="text" placeholder="contactFirstName" name="contactFirstName" required="required">
            </div>
            <div>
              <label>phone</label>
              <input type="text" placeholder="phone" name="phone" required="required">
            </div>
            <div>
              <label>addressLine1</label>
              <textarea name="addressLine1" required="required"></textarea>
            </div>
            <div>
              <label>addressLine2</label>
              <textarea name="addressLine2" required="required"></textarea>
            </div>
            <div>
              <label>city</label>
              <input type="text" placeholder="city" name="city" required="required">
            </div>
            <div>
              <label>state</label>
              <input type="text" placeholder="state" name="state" required="required">
            </div>
            <div>
              <label>postalCode</label>
              <input type="text" placeholder="postalCode" name="postalCode" required="required">
            </div>
            <div>
              <label>country</label>
              <input type="text" placeholder="country" name="country" required="required">
            </div>
            <div>
              <label>salesRepEmployeeNumber</label>
              <input type="text" placeholder="salesRepEmployeeNumber" name="salesRepEmployeeNumber" required="required">
            </div>
            <div>
              <label>creditLimit</label>
              <input type="text" placeholder="creditLimit" name="creditLimit" required="required">
            </div>
            
            <button type="submit">Simpan</button>
          </form>
        </main>
      </div>
    </div>
  </body>
</html>