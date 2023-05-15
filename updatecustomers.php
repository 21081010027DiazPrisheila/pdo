<?php 
  include ('koneksi.php'); 

  $status = '';
  
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['customerNumber'])) {
          //query SQL
          $customerNumber_upd = $_GET['customerNumber'];
          $query = $koneksi->prepare("SELECT * FROM customers WHERE customerNumber = :customerNumber");
          //binding data
          $query->bindParam(':customerNumber',$customerNumber_upd);
          //eksekusi query
          $query->execute(); 
      }  
  }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerNumber= $_POST['customerNumber'];
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
    
    //query SQL
    $query = $koneksi->prepare("UPDATE customers SET customerName=:customerName, contactLastName=:contactLastName, contactFirstName=:contactFirstName, 
    phone=:phone, addressLine1=:addressLine1, addressLine2=:addressLine2, city=:city, state=:state, postalCode=:postalCode, country=:country, salesRepEmployeeNumber=:salesRepEmployeeNumber,
    creditLimit=:creditLimit
    WHERE customerNumber=:customerNumber"); 

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

//redirect ke halaman lain
header('Location: customers.php?status='.$status);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UPDATE CUSTOMERS</title>
</head>
<body>
    <div class = "container" >
        <h2 align="center">UPDATE CUSTOMERS</h2>
            <table style="width:100%" cellspacing="0">
                <tr class="atas">
                    <td class="dua">
                        <center> 
                          <p><a class="nav-link" href="<?php echo "addcustomers.php"; ?>"><b>Menambah Data</b></a></p>   
                          <p><a class="nav-link" href="<?php echo "customers.php"; ?>"><b>Data customers</b></a></p>
                        </center>    
                    </td>
                </tr>

                <tr class="akhir">
                    <td colspan="3">
                        <h2 style="margin: 30px 0 30px 0;">Update Data Customers</h2>
                        <form action="updatecustomers.php" method="POST">
                        <?php while($data = $query->fetch(PDO::FETCH_ASSOC)): ?>
                          <div class="form-group">
                            <label>customerNumber</label>
                            <input type="text" class="form-control" placeholder="customerNumber" name="customerNumber" value="<?php echo $data['customerNumber'];  ?>" required="required" readonly>
                          </div>
                          <div class="form-group">
                            <label>customerName</label>
                            <input type="text" class="form-control" placeholder="customerName" name="customerName" value="<?php echo $data['customerName'];  ?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>contactLastName</label>
                            <input type="text" class="form-control" placeholder="contactLastName" name="contactLastName" value="<?php echo $data['contactLastName'];  ?>" required="required" >
                          </div>
                          <div class="form-group">
                            <label>contactFirstName</label>
                            <input type="text" class="form-control" placeholder="contactFirstName" name="contactFirstName" value="<?php echo $data['contactFirstName'];  ?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>phone</label>
                            <input type="text" class="form-control" placeholder="phone" name="phone" value="<?php echo $data['phone'];  ?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>addressLine1</label>
                            <input type="text" class="form-control" placeholder="addressLine1" name="addressLine1" value="<?php echo $data['addressLine1'];  ?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>addressLine2</label>
                            <input type="text" class="form-control" placeholder="addressLine2" name="addressLine2" value="<?php echo $data['addressLine2'];  ?>" required="required" >
                          </div>
                          <div class="form-group">
                            <label>city</label>
                            <input type="text" class="form-control" placeholder="city" name="city" value="<?php echo $data['city'];  ?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>state</label>
                            <input type="text" class="form-control" placeholder="state" name="state" value="<?php echo $data['state'];  ?>" required="required" >
                          </div>
                          <div class="form-group">
                            <label>postalCode</label>
                            <input type="text" class="form-control" placeholder="postalCode" name="postalCode" value="<?php echo $data['postalCode'];  ?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>country</label>
                            <input type="text" class="form-control" placeholder="country" name="country" value="<?php echo $data['country'];  ?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>salesRepEmployeeNumber</label>
                            <input type="text" class="form-control" placeholder="salesRepEmployeeNumber" name="salesRepEmployeeNumber" value="<?php echo $data['salesRepEmployeeNumber'];  ?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>creditLimit</label>
                            <input type="text" class="form-control" placeholder="creditLimit" name="creditLimit" value="<?php echo $data['creditLimit'];  ?>" required="required">
                          </div>
                          <button type="submit" class="btn btn-primary">Update</button>
                          <?php endwhile ?>
                        </form>

                      </main>
                    </div>
                  </div>
                  </main>
                    </td>
                </tr>
            </table>
    </div>
</body>
</html>