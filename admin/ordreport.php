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
     <h2>Order Items Reoprt</h2><br><br>
     <div class="back">
<a href="admin_dash.php"></a>
</div>
      <div class="container_table">  
      <table border="1">  
      <thead>
    <tr>
        <th>Item ID</th>
        <th>Order_id</th>
        <th>Product_ID</th>
        <th>Quantity</th>
        <th>Amount</th>
        <th>Subtotal</th>
        
        
       
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
        $sql = "select * from order_items where item_id ='%$search%' or oid like '%$search%' or pid like '%$search%' or quantity like '%$search%' or amount like '%$search%'or subtotal like '%$search%' "; 
        $result=mysqli_query($conn,$sql);
        if($result){
        if(mysqli_num_rows($result)>0){
           while( $row=mysqli_fetch_assoc($result)){
                echo ' 
                          <tr>
                          <td>'.$row['item_id'].'</td>  
                          <td>'.$row['oid'].'</td>  
                          <td>'.$row['pid'].'</td>  
                          <td>'.$row['quantity'].'</td>  
                          <td>'.$row['amount'].'</td>
                          <td>'.$row['subtotal'].'</td>
    			          
                          
                         
                          
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

