<?php
require_once 'php/connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
}else{
  $filter = $_SESSION['username'];
  $query=mysqli_query($conn,"SELECT * FROM users WHERE User_ID='$filter'")or die(mysqli_error());
  $row1=mysqli_fetch_array($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Donation System - Donor Module</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
</head>
        <style type="text/css">
        
          table{
    align-items: center;
  }

   th, tr, td{
    padding: 10px 10px;
  }
    </style>

<script type="text/javascript">
  function viewProf() {
  document.getElementById('profile').style.display = "block";
  document.getElementById('Home').style.display = "none";
  }
    function closeProf() {
  document.getElementById('profile').style.display = "none";
  document.getElementById('Home').style.display = "block";
  }
</script>

            <script type="text/javascript">
function printData1()
{
   var divToPrint=document.getElementById("printTable1");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData1();
})  
</script>

            <script type="text/javascript">
function printData2()
{
   var divToPrint=document.getElementById("printTable2");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData2();
})  
</script>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid d-none d-lg-block">
        <div class="row align-items-center py-4 px-xl-5">
            <div class="col-lg-3">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0" style="font-size: 32px;"><span class="text-primary">Donation</span>Central</h1>
                </a>
            </div>
            <div class="col-lg-3 text-right">
                <div class="d-inline-flex align-items-center">
                    <i class="fa fa-2x fa-map-marker-alt text-primary mr-3"></i>
                    <div class="text-left">
                        <h6 class="font-weight-semi-bold mb-1">Our Office</h6>
                        <small>Nairobi, KE.</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-right">
                <div class="d-inline-flex align-items-center">
                    <i class="fa fa-2x fa-envelope text-primary mr-3"></i>
                    <div class="text-left">
                        <h6 class="font-weight-semi-bold mb-1">Email Us</h6>
                        <small>donation.central@gmail.com</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-right">
                <div class="d-inline-flex align-items-center">
                    <i class="fa fa-2x fa-phone text-primary mr-3"></i>
                    <div class="text-left">
                        <h6 class="font-weight-semi-bold mb-1">Call Us</h6>
                        <small>+254 712 3456789</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0" style="font-size: 32px;"><span class="text-primary">Donation</span>Central</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav py-0">
                            <a href="#" class="nav-item nav-link active">Home</a>
                            <a href="#data" class="nav-item nav-link">Database</a>
                            <a href="#" onclick="viewProf();" class="nav-item nav-link">My Profile</a>
                            <a href="#contact" class="nav-item nav-link">Contact</a>
                        </div>
                        <a class="btn btn-primary py-2 px-4 ml-auto d-none d-lg-block" href="php/logout.php">Logout</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- My Profile Start -->
    <div class="container-fluid py-5" id="profile" style="display: none;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="img/<?php echo $row1['Profile_Picture']; ?>" alt="">
                </div>
                <div class="col-lg-7">
                    <div class="card border-0">
                        <div class="card-header bg-light text-center p-4">
                            <h1 class="m-0">My Profile</h1>
                        </div>
                        <div class="card-body rounded-bottom bg-primary p-5">
                            <form action="php/functions.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" class="form-control border-0 p-4" name="fname" value="<?php echo $row1['Fullname']; ?>" placeholder="Your Fullname" required="required" />
                                    <input type="hidden" value="<?php echo $row1['User_ID']; ?>" name="mod">
                                </div>
                                <div class="form-group">
                                    <input type="text" minlength="13" name="phone" value="<?php echo $row1['Phone_Number']; ?>" class="form-control border-0 p-4" placeholder="Your Phone Number" required="required" />
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" value="<?php echo $row1['Email_Address']; ?>" class="form-control border-0 p-4" placeholder="Your Email Address" required="required" />
                                </div>
                                <div class="form-group">
                                    <label style="color: white;">Profile Picture:</label>
                                    <br>
                                    <input type="file" name="image" accept=".jpg, .png, .jpeg" class="form-control border-0 p-4" required="required" />
                                </div>
                                <div class="form-group" style="color: white;">
                                    <input type="password" name="password" id="pass" class="form-control border-0 p-4" placeholder="Your Password" required="required" />
                                    <br>
                                    <input type="checkbox" onclick="showPass();"> Show Password
                                </div>
                                <div class="form-group" style="color: white;">
                                    <input type="password" name="cpassword" id="pass1" class="form-control border-0 p-4" placeholder="Confirm Your Password" required="required" />
                                    <br>
                                    <input type="checkbox" onclick="showPass1();"> Show Password
                                </div>
<!--                                 <div class="form-group">
                                    <select class="custom-select border-0 px-4" style="height: 47px;">
                                        <option selected>Select a course</option>
                                        <option value="1">Course 1</option>
                                        <option value="2">Course 1</option>
                                        <option value="3">Course 1</option>
                                    </select>
                                </div> -->
                                <div>
                                    <button class="btn btn-dark btn-block border-0 py-3" type="submit" name="upu">Update My Profile</button>
                                    <br>

                                </div>
                            </form>
                            <button class="btn btn-dark btn-block border-0 py-3" onclick="closeProf();">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- My Profile End -->

<div id="Home">

    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#header-carousel" data-slide-to="1"></li>
                <li data-target="#header-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active" style="min-height: 300px;">
                    <img class="position-relative w-100" src="img/c1.jpg" style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Empower Charities</h5>
                            <h1 class="display-3 text-white mb-md-4">Welcome <?php echo $row1['User_Type']; ?>, <?php echo $row1['Fullname']; ?>!</h1>
                            <a href="#mod" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">My Module</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="min-height: 300px;">
                    <img class="position-relative w-100" src="img/c2.jpg" style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Efficient Delivery</h5>
                            <h1 class="display-3 text-white mb-md-4">Welcome <?php echo $row1['User_Type']; ?>, <?php echo $row1['Fullname']; ?>!</h1>
                            <a href="#data" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">View Database</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="min-height: 300px;">
                    <img class="position-relative w-100" src="img/c3.jpg" style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Transparent Process</h5>
                            <h1 class="display-3 text-white mb-md-4">Welcome <?php echo $row1['User_Type']; ?>, <?php echo $row1['Fullname']; ?>!</h1>
                            <a href="#contact" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Database Start -->
    <div class="container-fluid py-5" id="data">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h1>List of Charity Centers</h1>
            </div>
            <div class="row justify-content-center">
                              <div class="col-lg-8">
            <input type="text" class="form-control input-sm" id="myInput" onkeyup="searchList();" placeholder="Search By Location..."/>
               <br>
<table id="printTable1">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Charity Center ID</th>
<th style="text-align: left;
  padding: 8px;">Owner Details</th>
  <th style="text-align: left;
  padding: 8px;">Name</th>
  <th style="text-align: left;
  padding: 8px;">Location</th>  
 <th style="text-align: left;
  padding: 8px;"></th>
</tr>

<?php
$sql = "SELECT charities.Charity_ID, charities.User_ID, charities.Location, charities.Long, charities.Lat, charities.Name, charities.Description, charities.Image, users.Fullname, users.Phone_Number, users.Email_Address FROM charities JOIN users ON charities.User_ID = users.User_ID";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
<tr>
<td><?php echo($row["Charity_ID"]); ?></td>
<td><?php echo($row["Fullname"]); ?> contact on <a href="mailto:<?php echo($row["Email_Address"]); ?>"><?php echo($row["Email_Address"]); ?></a> or <?php echo($row["Phone_Number"]); ?>.</td>
<td><?php echo($row["Name"]); ?></td>
<td><?php echo($row["Location"]); ?></td>
<td><button id="delbtn" class="btn btn-primary py-3 px-5" onclick="return confirm('Are you sure that you want to view this charity center?')?window.location.href='php/functions.php?action=viewC&id=<?php echo($row["Charity_ID"]); ?>':true;" title='View Charity Center'>View</button></td>
</tr>
<?php
}
} else { echo "No results"; }
?>

</table> 
<br>
<br>
<button class="btn btn-dark btn-block border-0 py-3" onclick="printData1();">Print Report</button>
<br>
                </div>
            </div>
        </div>
        <div class="container py-5">
            <div class="text-center mb-5">
                <h1>List of Donations</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
<table id="printTable2">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Donation ID</th>
<th style="text-align: left;
  padding: 8px;">Driver ID</th>
  <th style="text-align: left;
  padding: 8px;">Charity Center ID</th>
 <th style="text-align: left;
  padding: 8px;">Description</th>
  <th style="text-align: left;
  padding: 8px;">Image</th>
<th style="text-align: left;
  padding: 8px;">Type</th>
  <th style="text-align: left;
  padding: 8px;">Quantity</th>
 <th style="text-align: left;
  padding: 8px;">Status</th>
   <th style="text-align: left;
  padding: 8px;">Message</th>
  <th style="text-align: left;
  padding: 8px;"></th>
   <th style="text-align: left; padding: 8px;"></th>
</tr>

<?php
$sql = "
    SELECT 
        donations.Donation_ID, 
        donations.Description, 
        donations.Message, 
        donations.Type, 
        donations.Image, 
        donations.User_ID, 
        donations.Quantity, 
        donations.Status, 
        donations.Driver_ID, 
        donations.Charity_ID, 
        donor.User_ID AS Donor_ID,
        donor.Fullname AS Donor_Fullname, 
        donor.Email_Address AS Donor_Email, 
        donor.Phone_Number AS Donor_Phone, 
        driver.User_ID AS Driver_ID,
        driver.Fullname AS Driver_Fullname, 
        driver.Email_Address AS Driver_Email, 
        driver.Phone_Number AS Driver_Phone
    FROM donations 
    JOIN users AS donor ON donor.User_ID = donations.User_ID 
    LEFT JOIN users AS driver ON driver.User_ID = donations.Driver_ID 
    WHERE donations.User_ID = '$filter'
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
?>
        <tr>
            <td><?php echo($row["Donation_ID"]); ?></td>
            <?php
if($row["Driver_ID"] != 0){
?>
            <td><?php echo($row["Driver_Fullname"]); ?> contact on <a href="mailto:<?php echo($row["Driver_Email"]); ?>"><?php echo($row["Driver_Email"]); ?></a> or <?php echo($row["Driver_Phone"]); ?>.</td>
<?php
}else{
?>
<td>Pending Acceptance.</td>
<?php
}
?>
            <td><?php echo($row["Charity_ID"]); ?></td>
            <td><?php echo($row["Description"]); ?></td>
            <td><img src="img/<?php echo($row["Image"]); ?>" style="width: 150px;" alt></td>
            <td><?php echo($row["Type"]); ?></td>
            <td><?php echo($row["Quantity"]); ?></td>
            <td><?php echo($row["Status"]); ?></td>
            <td><?php echo($row["Message"]); ?></td>
                        <?php
if($row['Status'] == "Active"){
?>
<td><button id="delbtn1" class="btn btn-primary py-3 px-5" onclick="return confirm('Are you sure that you want to cancel this donation?')?window.location.href='php/functions.php?action=cancelD&id=<?php echo($row["Donation_ID"]); ?>':true;" title='Cancel Donation'>Cancel</button></td>
<?php
}else if($row['Status'] == "Accepted"){
?>
<td></td>
<?php
}else{
?>
<td></td>
<?php
}
?>
</tr>
<?php
}
} else { echo "No results"; }
?>

</table> 
<br>
<br>
<button class="btn btn-dark btn-block border-0 py-3" onclick="printData2();">Print Report</button>
<br>
                </div>
            </div>
        </div>
        <div class="container py-5">
            <div class="text-center mb-5">
                <h1>My Donation Statistics</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
            <div id="printChart">
                          <div class="card mt-4">
            <div class="card-body">
              <div class="chart-container pie-chart">
                <canvas id="pie_chart"></canvas>
              </div>
            </div>
          </div>
            </div>  
                </div>
            </div>
        </div>
    </div>
    <!-- Database End -->

</div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5 px-sm-3 px-lg-5" style="margin-top: 90px;" id="contact">
        <div class="row pt-5">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Get In Touch</h5>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>Nairobi, KE</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+254 712 3456789</p>
                        <p><i class="fa fa-envelope mr-2"></i>donation.central@gmail.com</p>
                        <div class="d-flex justify-content-start mt-4">
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-light btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Important Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-white mb-2" href="#data"><i class="fa fa-angle-right mr-2"></i>Database</a>
                            <a class="text-white mb-2" href="#mod"><i class="fa fa-angle-right mr-2"></i>My Module</a>
                            <a class="text-white mb-2" href="#" onclick="viewProf();"><i class="fa fa-angle-right mr-2"></i>My Profile</a>
                            <a class="text-white" href="php/logout.php"><i class="fa fa-angle-right mr-2"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-12 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a href="#">Donation Central</a>. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Javascript -->
    <script src="js/main.js"></script>

    <script type="text/javascript">
                function hideError() {
            var error = document.getElementById("ep");
            var error1 = document.getElementById("ep1");
                error.style.display = "none";
                error1.style.display = "none";                        
        }
        function showPass() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
        function showPass1() {
  var x = document.getElementById("pass1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function searchList() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("printTable1");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

 <script type="text/javascript">
      $(document).ready(function(){

        makechart();

      function makechart()
  {
    $.ajax({
      url:"php/data.php",
      method:"POST",
      data:{action:'fetch2'},
      dataType:"JSON",
      success:function(data)
      {
        var language = [];
        var total = [];
        var color = [];

        for(var count = 0; count < data.length; count++)
        {
          language.push(data[count].language);
          total.push(data[count].total);
          color.push(data[count].color);
        }

        var chart_data = {
          labels:language,
          datasets:[
            {
              label:'Vote',
              backgroundColor:color,
              color:'#fff',
              data:total
            }
          ]
        };

        var options = {
          responsive:true,
          scales:{
            yAxes:[{
              ticks:{
                min:0
              }
            }]
          }
        };

     var group_chart1 = $('#pie_chart');

        var graph1 = new Chart(group_chart1, {
          type:"pie",
          data:chart_data
        });
      }
    })
  }

});

    </script>

</body>

</html>