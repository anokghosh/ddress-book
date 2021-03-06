<!DOCTYPE html>
<html lang="en">


<?php
        ob_start();
        session_start();
        if( !isset($_SESSION['username'])){
           
            header("Location: login.php");
               }

        include "include/dbconnection.php" ;
        include "export.php";
        include "allfunctions.php";
      

?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home | Address Book </title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/formelements.css">
    <link href="css/bookadmin.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
       <section>
          <?php  include "include/navbar.php" ; ?>

       </section>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-sm-12">
                       <?php include('search.php'); ?>
                     </div>
                 </div>    
                 <div class="row">
                         <div class="col-sm-6">
                         <?php $count=find_contact(); ?>
                            <h1 class="page-header"> <ol class="breadcrumb"> You have <?php echo $count; ?> contacts </ol>  </h1>
                         </div>
                         <div class="col-sm-6">
                             
                         <?php    

                         if(isset($_SESSION['user_id']))
                         {
                            $user_id=$_SESSION['user_id'];
                         }
                         
                     ?>
                                 <form class="" method="post" action="export.php">
                                    <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $user_id; ?>" >
                                     <button  name="export_contact" type="" class="btn btn-default">Export Contacts</button>
                                     </div>
                                 </form>
                                 <form class="" method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                     <button  name="import" type="sumbit" class="btn btn-default">Import Contacts</button>
                                     </div>
                                 </form>
                              
                                 
                                
                             
                         </div>
                 </div>
                 <div class="row">
                 <div class="col-sm-12">
                       <div style="height: 400px; overflow: auto;">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Full Name</th> 
                                <th>Mobile</th>
                                <th>Street Address</th>
                                <th>City</th>
                                <th>Details</th>
                                <th>Edit</th>
                                <th>Delete</th> 
                            </tr>
                            </thead>

                            <tbody>

                            <?php
                           
                            $user_id=$_SESSION['user_id'];
                            $query = "SELECT * from addresses where user_id='$user_id'";
                            $query_username_result = mysqli_query($connection,$query);
                           while( $row=mysqli_fetch_assoc($query_username_result)){ ?>
                                    <?php  $id=$row['id'];
                                           $full_name=$row['full_name'];
                                           $phone1=$row['phone1']; 
                                           $email=$row['email'];
                                           $street_address=$row['street_address'];
                                           $city=$row['city'];
                                   ?>
                          
                                <tr>
                                <td><?php   echo $full_name ; ?></td>
                                <td><?php   echo $phone1 ; ?></td>
                                <td><?php   echo $street_address ; ?></td>
                                <td><?php   echo  $city; ?></td>
                             
                              
                           
                              <?php echo  " <td><a   href='contactDetails.php?details_id={$row['id']}&user_id={$user_id}' class='btn btn-success' >Details</a></td>"; ?>

                                <?php echo  " <td><a   href='contactEdit.php?edit_id={$row['id']}&user_id={$user_id}' class='btn btn-success' >Edit</a></td>"; ?>
                                <?php echo  " <td><a  href='home.php?delete_id={$row['id']}' class='btn btn-danger' >Delete</a></td>"; ?>    
                                </tr>
                                         
                             <?php    }  ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                 </div>
                </div>
            </div>
                <!-- /.row -->
<!-- for deleting a contact-->

          <?php

            if(isset($_GET['delete_id']))
            {
                $delete_id=$_GET['delete_id'];
                $query="DELETE from addresses where id='$delete_id'";
                $query_result=mysqli_query($connection,$query);
                if($query_result)
                {
                    header("Location:home.php");
                }
                
            }    
             ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->




    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
