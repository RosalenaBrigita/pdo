<?php 
include ('conn.php'); 

  $status = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerNumber = $_POST['customerNumber'];
    $customerName = $_POST['customerName'];
    $contactLastName = $_POST['contactLastName'];
    $contactFirstName = $_POST['contactFirstName'];
    $phone = $_POST['phone'];
    $addressLine1 = $_POST['addressLine1'];
    $addressLine2 = isset($_POST['addressLine2']) ? $_POST['addressLine2'] : NULL;
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $country = $_POST['country'];
    $salesRepEmployeeNumber = $_POST['salesRepEmployeeNumber'];
    $creditLimit = $_POST['creditLimit'];
      
      //query with PDO
      $query = $conn->prepare("INSERT INTO customers 
      (customerNumber, customerName, contactLastName, contactFirstName,phone ,addressLine1 
      ,addressLine2 ,city, state, postalCode, country, salesRepEmployeeNumber, creditLimit) 
      VALUES(:customerNumber, :customerName, :contactLastName, :contactFirstName, :phone , :addressLine1 
      , :addressLine2 , :city , :state, :postalCode, :country, :salesRepEmployeeNumber, :creditLimit)"); 

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
      $query->bindParam(':creditLimit',$postalCode);

      //eksekusi query
      if ($query->execute()) {
        $status = 'ok';
        echo"<script>alert ('Data Pelanggan Berhasil disimpan')</script>";
        header ("refresh:0;customer.php");
      }
      else{
        $status = 'err';
        echo"<script>alert ('Data Tidak Berhasil disimpan')</script>";
        header ("refresh:0;customer.php");
      }
            
  }

?>