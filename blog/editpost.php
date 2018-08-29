<?php
include ('dbconfig.php');
// Initialize the session

 $id=$_REQUEST['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Post</title>
        <link rel="stylesheet" type="text/css" href="../css/plugins/bootstrap.mis.css">
        <link rel="stylesheet" type="text/css" href="../js/plugins/font-awesome.mis.css">
        <link rel="stylesheet" type="text/css" href="../css/ckeditor.css">
        <link rel="shortcut icon" href="../images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/shortcodes/shortcodes.css" />

<script src="../ckeditor/ckeditor.js" type="text/javascript"></script>

<style>
.button {
    margin-left: 600px;
    margin-top: 10px;
}
</style>

    </head>
    <body>
    <?php $result=mysqli_query($link,"Select * FROM blog where id='$id'");
while($row=mysqli_fetch_assoc($result)){
  ?>
        <form id="post">
            <div class="grid-container">
			    <div class="grid-width-100">
                <h3>Title:</h3>
                <input type="text" name="title" value='<?php echo $row['id'];?>'/>
            </div>
            
            <div class="grid-container">
			    <div class="grid-width-100">
                <h3>Image Url:</h3>
                <input type="text" name="img" value='<?php echo $row['img'];?>'/>
			</div>
            
			<div class="grid-container">
			    <div class="grid-width-100">
                <h3>Description</h3>
                <textarea cols="80" id="editor1" name="editor1" rows="10" ><?php echo $row['content']; ?></textarea>
			    </div>
			</div>
            <div class="grid-container">
			    <div class="grid-width-100">
                <h3>Full Content</h3>
                <textarea cols="80" id="editor2" name="editor2" rows="10" ><?php echo $row['content1']; ?></textarea>
			    </div>
			</div>
			<p>
		<label>&nbsp;</label>
		<button name="post" value="post" class="button" >Post !</button>
        <input type="hidden"  value='<?php echo $row['id'];?>' name="id">
            </p>
        </form>
<?php } ?>

<script>
		CKEDITOR.replace( 'editor1', {
			uiColor: '#CCEAEE'
		} );
        CKEDITOR.replace( 'editor2', {
			uiColor: '#CCEAEE'
		} );
	</script>
<script type="text/javascript">


$("#post").on('submit',(function(e){
e.preventDefault();
$.ajax({
url: "edit-postact.php",
type: "POST",
data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(data){
var result = data.trim();
if(result=='success'){
	
    swal("success", "successfully created!.", "success");
	setTimeout(function(){ location.replace("employees.php"); }, 2000);
}else{
	swal("Failed", result, "error");
}	
},	

error: function(){} 	        

});

}));

</script>

    </body>
</html>