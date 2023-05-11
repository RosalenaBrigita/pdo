<?php 
include ('conn.php'); 

  $status = '';

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

      //query with PDO
      $query = $conn->prepare("INSERT INTO products 
      (productCode, productName, productLine, productScale, productVendor 
      ,productDescription, quantityInStock ,buyPrice ,MSRP ) 
      VALUES(:productCode, :productName, :productLine, :productScale, :productVendor 
      , :productDescription, :quantityInStock , :buyPrice, :MSRP)"); 

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
        echo"<script>alert ('Data Produk Berhasil disimpan')</script>";
        header ("refresh:0;product.php");

      }
      else{
        $status = 'err';
        echo"<script>alert ('Data Tidak Berhasil disimpan')</script>";
        header ("refresh:0;product.php");
      }
            
  }

?>