<?php
include ('dbconfig.php');
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="author" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Welcome</title>

<!-- Favicon -->
<link rel="shortcut icon" href="../images/favicon.ico" />

<!-- font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
 
<!-- Plugins -->
<link rel="stylesheet" type="text/css" href="../css/plugins-css.css" />

<!-- Typography -->
<link rel="stylesheet" type="text/css" href="../css/typography.css" />

<!-- Shortcodes -->
<link rel="stylesheet" type="text/css" href="../css/shortcodes/shortcodes.css" />

<!-- Style -->
<link rel="stylesheet" type="text/css" href="../css/style.css" />

<!-- Responsive -->
<link rel="stylesheet" type="text/css" href="../css/responsive.css" /> 

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

 
<style>
        body{ font: 14px sans-serif; text-align: center; }
</style>
 
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo ucwords($_SESSION["username"]); ?></b>. Welcome to Okcygenio Blog.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="button small">Reset Your Password</a>
        <a href="logout.php" class="button small">Sign Out of Your Account</a>
    </p>

<?php
$result = mysqli_query($link,"Select * FROM blog ORDER BY id DESC"); ?>

<table id="blogtable">
<tr>
<th>Id</th>
<th>Image</th>
<th>Title</th>
<th>Action</th>
</tr>
<?php
while($row = mysqli_fetch_array($result))
{ ?>
<tr>
<td><?php echo $row['id'];?></td>
<td><?php echo $row['img'];?></td>
<td><?php echo $row['title'];?></td>
<td><a href="editpost.php?id=<?php echo $row['id'];?>"><i class="far fa-edit"></i></a>
<a class="btn" onclick="actionDelete('<?php echo $row['id']; ?>')" title="Delete" ><i class="fa fa-eye"></i></a></td>
</tr>
<?php } ?>
</table>

<section>
    <div style="padding-top:20px;">
    <a href="addpost.php" class="button">Add Post</a>
    </div>
</section>

<script >

function actionDelete(id){
   // alert("sfsd");
swal({
    title: "Are you sure?",
    text: "You will not be able to recover this imaginary file!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false
}, function () {
    $.ajax({
    url: 'delete-post.php',
    type: 'POST',
    data: { 
    'id': id,
  },
    success: function (response) {
        
        swal("Deleted!", "Your imaginary file has been deleted.", "success");
        setTimeout(function(){ location.reload() }, 2000);
    }
});
    
    
});

}

</script>

		<script src="../js/sweetalert/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../js/sweetalert/sweetalert.min.css" />
        <script type="text/javascript" src="../js/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" src="../css/plugins/bootstrap.min.js"></script>

</body>
</html>
