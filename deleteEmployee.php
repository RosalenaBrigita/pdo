<?php 

  include ('conn.php'); 

  $status = '';
  $result = '';
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['employeeNumber'])) {
          //query SQL
          $employeeNumber_upd = $_GET['employeeNumber'];
          $query = $conn->prepare("DELETE FROM employees WHERE employeeNumber = :employeeNumber ");
          //binding data
          $query->bindParam(':employeeNumber',$employeeNumber_upd);
          //eksekusi query
          if ($query->execute()) {
            $status = 'ok';
          }
          else{
            $status = 'err';
          }
          //redirect ke halaman lain
          header('Location: employee.php?status='.$status);
      }  
  }