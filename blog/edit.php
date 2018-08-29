<?php 
require_once('../includes/config.php');
/**
 * @author	brengsekerz <brengsekerz@gmail.com>
 * 
 * This is demo for editing content using CKEditor and KCFinder
 */
 if(!$user->is_logged_in()){ header('Location: login.php'); }?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Edit Post</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
  </head>
  <body>
  <div id="wrapper">

	<?php include('menu.php');?>
	<p><a href="./">Blog Admin Index</a></p>

	<h2>Edit Post</h2>
	<?php 


	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);
		

		//very basic validation
	if($postID ==''){
			$error[] = 'This post is missing a valid id!.';
		}

		if($postTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if($postDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($postCont ==''){
			$error[] = 'Please enter the content.';
		}

		if(!isset($error)){

			try {

				//insert into database
				//$stmt = $db->prepare('UPDATE blog_posts SET postTitle = :title, postDesc = :content, postCont = :content1, postDate = :postDate WHERE postID = :postID') ;
				
								
				//$stmt->execute(array(
				//	':postTitle' => $title,
				//	':postDesc' => $content,
				//    ':postCont' => $content1,
				//	':postDate' => date('Y-m-d H:i:s')
			
					
				//));
				$stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID') ;
				$stmt->execute(array(
					':postTitle' => $postTitle,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postID' => $postID
				));

				//redirect to index page
				header('Location: index.php?action=updated');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}
try {

			$stmt = $db->prepare('SELECT postID, postTitle, postDesc, postCont,postDate FROM blog_posts WHERE postID = :postID') ;
			$stmt->execute(array(':postID' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
?>
<title>Content Editor</title>
<!--<form action='' method="post">
<input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

	<p>
		<label>Title:</label><br/>
		<input type="text" name="title" value='<?php echo $row['postTitle'];?>' />
	</p>
	<p>
		<label>Desc:</label><br/>
		<textarea name="content" id="content"><?php echo $row['postDesc'];?></textarea>
	</p>
    <p>
		<label>Content:</label><br/>
		<textarea name="content1" id="content1"><?php echo $row['postCont'];?></textarea>
	</p>
	<p>
		<label>&nbsp;</label>
		
		<p><input type='submit' name='submit' value='Update'></p>
	</p>
</form>-->
<form action='' method='post'>
		<input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

		<p><label>Title</label><br />
		<input type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'></p>

		<p><label>Description</label><br />
		<textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc'];?></textarea></p>

		<p><label>Content</label><br />
		<textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea></p>

		<p><input type='submit' name='submit' value='Update'></p>

	</form>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	CKEDITOR_BASEPATH = 'ckeditor';

	var editor = CKEDITOR.replace('postDesc', {
    	filebrowserBrowseUrl: "kcfinder/browse.php?type=files"
	});
	var editor = CKEDITOR.replace('postCont', {
    	filebrowserBrowseUrl: "kcfinder/browse.php?type=files"
	});
</script>

</div>

</body>
</html>	