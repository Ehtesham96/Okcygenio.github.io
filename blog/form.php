<?php include('dbconfig.php');
$id=$_GET['id'];
 ?>
 <html>
 <head>
<link rel="stylesheet" type="text/css" href="../css/ckeditor.css">
<script src="../ckeditor/ckeditor.js" type="text/javascript"></script>
 </head>
 <body>
 
                             <form class="col-sm-6" id="post" enctype="multipart/form-data">
							 <?php
$queryFetch=mysqli_query($link,"SELECT * FROM blog WHERE id='$id'");
if(mysqli_num_rows($queryFetch)){
    while($row=mysqli_fetch_assoc($queryFetch)){
?>
                              <div class="form-group">
							  <small class="req text-danger">* </small>
                                 <label>Title</label>
								 
                                 <input type="text" id="title" name="title" class="form-control" value="<?php echo $row['title']; ?>">
                              </div>
                              <div class="form-group">
							  
                                 <label>Image</label>
                                 <input type="text" id="img" name="img" class="form-control" value="<?php echo $row['img']; ?>">
                              </div>
                              <div class="form-group">
							  <small class="req text-danger">* </small>
                                 <label>Description</label>
                               <!--  <textarea class="ckeditor" name="content" value='<?php echo $row['content']; ?>'></textarea>-->
								 <textarea cols="80" id="editor1" name="editor1" rows="10" ><?php echo $row['content']; ?></textarea>

                              </div>
                              <div class="form-group">
							  <small class="req text-danger">* </small>
                                 <label>Full Content</label>
                                 <textarea cols="80" id="editor2" name="editor2" rows="10" ><?php echo $row['content1']; ?></textarea>
                              </div>
							  <div></div>
                              <div class="reset-button">
							  	 <button class="btn btn-success" type="submit">update</button>
                                 
								<!-- <a href="#" class="btn btn-success" type="submit">Save</a>
								 <button class="btn btn-success" type="submit">Save</button>-->
                              </div>
							  <?php
	
    }
}	
?>	
                           </form>
 

      
   </body>


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
</html>