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
     <h2>Admin Reoprt</h2><br><br>
     <div class="back">
<a href="admin_dash.php"></a>
</div>
      <div class="container_table">  
      <table border="1">  
      <thead>
    <tr>
        <th>Admin_ID</th>
        <th>Name</th>
        <th>Email Id</th>
        <th>Display Password</th>
        
        
        
       
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
        $sql = "select * from admin where aid ='%$search%' or name like '%$search%' or email like '%$search%' or password like '%$search%' "; 
        $result=mysqli_query($conn,$sql);
        if($result){
        if(mysqli_num_rows($result)>0){
           while( $row=mysqli_fetch_assoc($result)){
                echo ' 
                          <tr>
                          <td>'.$row['aid'].'</td>  
                          <td>'.$row['name'].'</td>  
                          <td>'.$row['email'].'</td>  
                          <td>'.$row['password'].'</td>  
                          
    			          
                          
                         
                          
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

