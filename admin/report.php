.<?php   
 @include 'dbcon.php';
 ?>  
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>User Table</title>
     <link rel="stylesheet" href="css/style.css">
 </head>
 <body>
     <h1>Kisan-Agri-Mall</h1>
     <div class="user_table">
     <h2>User Reoprt</h2><br><br>
     <div class="back">
<a href="admin_dash.php"></a>
</div>
      <div class="container_table">  
      <table border="1">  
      <thead>
    <tr>
        <th>User Id</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Address</th>
        <th>Gender</th>
        <th>User Name</th>
        <th>Password</th>
        <th>Date</th>
        
       
    </tr>
  </thead> 
  <div class="container_rep">

<form action="" method="post">

<input type="text" placeholder="Search Items" name="search">
<button name="submit">Search</button><br><br>
</form>
<div class="cont">
    <?php
    if(isset($_POST['submit'])){
        $search=$_POST['search'];
        $conn = new mysqli('localhost', 'root', '', 'grocery');
        $sql = "select * from user where uid ='%$search%' or name like '%$search%' or mobile like '%$search%' or address1 like '%$search%' or gender like '%$search%' or username like '%$search%' or password like '%$search%' or Date like'%$search' ";  
        $result=mysqli_query($conn,$sql);
        if($result){
        if(mysqli_num_rows($result)>0){
           while( $row=mysqli_fetch_assoc($result)){
                echo ' 
                          <tr>
                          <td>'.$row['uid'].'</td>  
                          <td>'.$row['name'].'</td>  
                          <td>'.$row['mobile'].'</td>  
                          <td>'.$row['address1'].'</td>
                          <td>'.$row['gender'].'</td>
                          <td>'.$row['username'].'</td>
                          <td>'.$row['password'].'</td>
                          <td>'.$row['Date'].'</td>
                         
                          
</tr>
                          ';  
           }
                     } 
                     else{
                        echo "No Data Found";
                     } 
                    }
                }  
           ?>  
      </table>  
 </div>  
 </div>
            </div>
            </div>

 