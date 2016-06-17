
<?php 

include 'head.php';
include 'includes/connect.php';
// user should be logged in to view this page
session_start();


// this page shows invoice for user's reservation
// this page will submit user's reservation to the reservation table on db
// using the user's choices from previous pages, we display a receipt to the user

// user should be logged in to view this page
if( isset($_SESSION['user_id'])){
	
	}
	else{                             
		echo '<b>you need to login or signup to access this page</b><br>';
		
		echo '<META HTTP-EQUIV="Refresh" Content="1 ;URL=index.php">';
        header("refresh:3;url=signup.php");
		die();
        
	}



if (!$conn) { 
    die("Connection failed: " . mysqli_connect_error());
    echo '<META HTTP-EQUIV="Refresh" Content="3; URL=index.php">';
}

if(isset($_POST["pay"]))
{           
    
    
if (!$conn) { 
    die("Connection failed: " . mysqli_connect_error());
    echo '<META HTTP-EQUIV="Refresh" Content="3; URL=index.php">';
}

    
    
    $confirm_code = "CASK" . (rand(1000,9999));
    
    $resvlocation = $_SESSION['resvlocation'];
    $resvDate = $_SESSION['resvDate'];
    $resvTime = $_SESSION['resvTime'];
    $retDate = $_SESSION['retDate'];
    $retTime = $_SESSION['retTime'];
    $returnLocation = $_SESSION['returnLocation'];
    $vehicle_ID = $_SESSION['vehicle_choice'];
    $vehicle_price_rate = $_SESSION['res_Price'];
    $res_img = $_SESSION['res_img'];
   
    
    // submit reservation to database
    $sql_resv = $conn->query("INSERT INTO reservation (`user_id`, `resv_vehicle_id`, `pick_location`, `return_location`, `pick_date`, `return_date`, `pick_time`, `return_time`, `confirmation_code`) VALUES('$user_ID', '$vehicle_ID', '$resvlocation', '$returnLocation', '$resvDate', '$retDate', '$resvTime', '$retTime', '$confirm_code')");
    
    
    echo 
    if($sql_resv){
        echo "worked!";
    }
    else{
        echo "not working!";
    }
    
    
    
    
    /*
     $_SESSION['res_vehicle'] = $row['year'] . " " . $row['make'] . " " . $row['model'];
            $_SESSION['res_Type'] = $row['type'];
            $_SESSION['res_Price'] = $row['price'];
            $_SESSION['res_Desc'] = $row['description'];
            $_SESSION['res_img'] = $row['pic_link'];
            
            */
    ?>



<div class="container">
  <form class="form-horizontal" role="form" method="post" action="invoice.php">
    <fieldset>
      <legend>Your Reservation is Completed - CONFIRMATION CODE: #<?php echo $confirm_code; ?></legend> 
      <div class="form-group">
        <label class="col-sm-3 control-label" for="card-holder-name">Name:</label>
        <div class="col-sm-9">
            
            <?php
            echo "<i><h4>" . $User_fname . " " . $User_lname. "</h4></i>";
            ?>
            
        </div>
      </div>
        
      <div class="form-group">
        <label class="col-sm-3 control-label" for="card-number">Vehicle and Locations:</label>
        <div class="col-sm-9">
            
            <?php
            echo "<i><h4>" . $_SESSION['res_vehicle'] . "</h4></i><br>";
            echo "<i><h4> Pick-up location: " . $resvlocation . "</h4></i><br>";
            echo "<i><h4> Return location: " . $returnLocation . "</h4></i><br>";
            ?>            
        </div> 
      </div>
        
        
      <div class="form-group">
        <label class="col-sm-3 control-label" for="expiry-month">Pickup Date and Time:</label>
        <div class="col-sm-9">
          <div class="row">
              
             <?php
            echo "<i><h4>" . $resvDate . "<br>" . $resvTime ."</h4></i>";
            ?>
          </div>
        </div>
      </div>
        
        <div class="form-group">
                <label class="col-sm-3 control-label" for="cvv">Drop-up Date and Time:</label>
        <div class="col-sm-9">
          <div class="row">

            <?php
            echo "<i><h4>" . $retDate . "<br>" . $retTime ."</h4></i>";
            ?>   
          </div>
        </div>
      </div>
        
        <legend></legend>
        
             <div class="form-group">
                <label class="col-sm-3 control-label" for="cvv">Price</label>
        <div class="col-sm-9">
          <div class="row">

            <?php
            $tax = ($vehicle_price_rate * 0.10);
            $after_tax = ($vehicle_price_rate + $tax);
            echo "<i><h4> Vehicle daily rate: $" .$vehicle_price_rate. "<br>"
                . "Total = $".$after_tax."</h4></i>";
            ?>
          </div>
        </div>
      </div>

                    <?php include 'includes/print.php'; ?>

        <img class="img-responsive" src="<?php echo $res_img; ?>">
<?php
        
}
else{
        ?>
         <div class="alert alert-warning">
         <h4 class="Rform">An error occured...Redirecting!</h4> 
        </div>
        <?php
        header("refresh:3;url=index.php");   
}
        
        
?>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
Please keep this invoice for your records.          
        </div>
      </div>
    </fieldset>
  </form>
</div>










<?php
mysqli_close($conn);

include 'footer.php';

?>