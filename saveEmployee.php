<?php 
include ('conn.php'); 

  $status = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeNumber = $_POST['employeeNumber'];
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $extension = $_POST['extension'];
    $email = $_POST['email'];
    $officeCode = $_POST['officeCode'];
    $reportsTo = isset($_POST['reportsTo']) ? $_POST['reportsTo'] : NULL;
    $jobTitle = $_POST['jobTitle'];

      //query with PDO
      $query = $conn->prepare("INSERT INTO employees 
      (employeeNumber, lastName, firstName, extension,email ,officeCode, reportsTo ,jobTitle) 
      VALUES(:employeeNumber, :lastName, :firstName, :extension, :email , :officeCode, :reportsTo , :jobTitle)"); 

      //binding data
      $query->bindParam(':employeeNumber',$employeeNumber);
      $query->bindParam(':lastName',$lastName);
      $query->bindParam(':firstName',$firstName);
      $query->bindParam(':extension',$extension);
      $query->bindParam(':email',$email);
      $query->bindParam(':officeCode',$officeCode);
      $query->bindParam(':reportsTo',$reportsTo);
      $query->bindParam(':jobTitle',$jobTitle);

      //eksekusi query
      if ($query->execute()) {
        $status = 'ok';
        echo"<script>alert ('Data Karyawan Berhasil disimpan')</script>";
        header ("refresh:0;employee.php");

      }
      else{
        $status = 'err';
        echo"<script>alert ('Data Tidak Berhasil disimpan')</script>";
        header ("refresh:0;employee.php");
      }
            
  }

?>