<?php include('dbconfig.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Post</title>
        <link rel="stylesheet" type="text/css" href="../css/plugins/bootstrap.mis.css">
        <link rel="stylesheet" type="text/css" href="../js/plugins/font-awesome.mis.css">
        <link rel="stylesheet" type="text/css" href="../css/ckeditor.css">
        <script src="../ckeditor/ckeditor.js" type="text/javascript"></script>
    </head>
    <body>
        <form action="add-postact.php" id="post" method="post">
            <div class="grid-container">
			    <div class="grid-width-100">
                <h3>Title:</h3>
                <input type="text" name="title" />
            </div>
            
            <div class="grid-container">
			    <div class="grid-width-100">
                <h3>Image Url:</h3>
                <input type="text" name="img" />
			</div>
            
			<div class="grid-container">
			    <div class="grid-width-100">
                <h3>Description</h3>
                <textarea class="ckeditor" name="content"></textarea>
			    </div>
			</div>
            <div class="grid-container">
			    <div class="grid-width-100">
                <h3>Full Content</h3>
                <textarea class="ckeditor" name="content1"></textarea>
			    </div>
			</div>
			<p>
		<label>&nbsp;</label>
		<button name="post" value="post">Post !</button>
	</p>
        </form>
        
    </body>
    
<script type="text/javascript">
	$("#post").on('submit',(function(e){
e.preventDefault();
$.ajax({
url: "add-postact.php",
type: "POST",
data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(data){
var result = data.trim();
if(result=='success'){
	
    swal("success", "successfully created!.", "success");
	setTimeout(function(){ location.replace("login.php"); }, 2000);
}else{
	swal("Failed", result, "error");
}	
},	

error: function(){} 	        
});

}));	
		
}); 
</script>

</html>
