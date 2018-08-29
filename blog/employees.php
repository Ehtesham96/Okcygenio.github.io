<?php
include "header.php";
include "dbconfig.php";
?>
<style>
.grid-norecords{
	text-align:center;
	border:1px solid #80808052; 
	color: red; 
	font-size:18px;
	font-weight: 600;
}
</style>
<style>
div.pagination {
    font-family: "Lucida Sans", Geneva, Verdana, sans-serif;
    padding:20px;
    margin:7px;
}

div.pagination a {
    margin: 2px;
    padding: 0.5em 0.64em 0.43em 0.64em;
    background-color: #ee4e4e;
    text-decoration: none;
    color: #fff;
}
div.pagination a:hover, div.pagination a:active {
    padding: 0.5em 0.64em 0.43em 0.64em;
    margin: 2px;
    background-color: #de1818;
    color: #fff;
}
div.pagination span.current {
    padding: 0.5em 0.64em 0.43em 0.64em;
    margin: 2px;
    background-color: #f6efcc;
    color: #6d643c;
}
div.pagination span.disabled {
    display:none;
}
</style>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Employee</h4>
						</div>
						<div class="col-xs-8 text-right m-b-20">
							<a href="add-employee.php" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> Add Employee</a>
							<!--<div class="view-icons">
								<a href="employees.html" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
								<a href="employees-list.html" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
							</div>-->
						</div>
					</div>
					<div class="row filter-row">
                           <div class="col-sm-12 ">  
								<div class="form-group form-focus">
									<label class="control-label">Employee</label>
									<input type="text" class="form-control floating" id="keywords" onkeyup="searchFilter()"/>
									<select id="sortBy" class="" onchange="searchFilter()">
        <option value="">Sort By</option>
        <option value="asc">Ascending</option>
        <option value="desc">Descending</option>
    </select>
								</div>
                           </div>

					   
                    </div>
					
					<div class="row staff-grid-row">

<div class="post-wrapper">
  
    <div id="posts_content">
    <?php
    //Include Pagination class file
    include('pagination.php');
    
    //Include database configuration file
    include('dbconfig.php');
    
    $limit = 12;
    
    //Get the total number of rows
    $queryNum = mysqli_query($con,"Select COUNT(*) staffid FROM tblstaff where active=1 ORDER BY datecreated DESC");
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['staffid'];
    
    //Initialize Pagination class and create object
    $pagConfig = array('baseURL'=>'getdata.php', 'totalRows'=>$rowCount, 'perPage'=>$limit, 'contentDiv'=>'posts_content');
    $pagination =  new Pagination($pagConfig);
    
    //Get rows
	
    $query = mysqli_query($con,"SELECT * FROM tblstaff ORDER BY staffid DESC LIMIT $limit");
    
    if($rowCount > 0){ ?>
        <div class="posts_list clearfix">
        <?php
            while($row = $query->fetch_assoc()){ 
                $staffid = $row['staffid'];
				$id = $row['role'] ;
        ?>						   
						<div class="col-md-4 col-sm-4 col-xs-6 col-lg-3">
						
							<div class="profile-widget">
							
								<div class="profile-img">
							
									<a href="view-employee.php?staffid=<?php echo $row['staffid']; ?>"><img class="avatar" src="assets/img/users/	<?php echo $row['profile_image'] ; ?>"></a>
								</div>
								<div class="dropdown profile-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<ul class="dropdown-menu pull-right">
										<!--<li><a href="#" data-toggle="modal" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>-->
										<li><a  class="btn btn-add btn-sm" href="update-employee.php?staffid=<?php echo $row['staffid']; ?>"><i class="fa fa-pencil m-r-5"> </i> Edit</a></li>
										<!--<li><a  class="btn btn-add btn-sm" href=""><i class="fa fa-pencil m-r-5"> </i> Edit</a></li>-->
										<!--<li><a href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>-->
										<li><a class="btn btn-danger btn-sm" onclick="actionDelete('<?php echo $row['staffid']; ?>')" title="Delete" ><i class="fa fa-trash-o"></i> Delete</a></li>
									</ul>
								</div>
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="view-employee.php?staffid=<?php echo $row['staffid']; ?>"><?php echo $row['firstname'] ; ?></a></h4>
								 <?php	
  $result1=mysqli_query($con,"Select name FROM tblroles  where roleid='".$id."'" );  
						  if($row1=mysqli_fetch_array($result1)){ ?>
								<div class="small text-muted"><?php echo $row1['name'] ; ?></div>
								<?php }?>
							</div>
							 
						</div>
						
<?php } ?>

        </div>
     <div class="text-right"><?php echo $pagination->createLinks(); ?></div>   
    <?php }else{ echo '<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"><div class="form-control grid-norecords">No records found!</div></div>'; } ?>
    </div>
</div>						
						 <input type="hidden" name="staffid" value="<?php echo $row['staffid'] ; ?>">
					</div>
                </div>
				
			
            </div>
			
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
		<script src="assets/plugins/sweetalert/sweetalert.min.js"></script>

<script>

	function actionDelete(staffid){
		//alert("sfsd");
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
        url: 'delete-employee.php',
        type: 'POST',
        data: { 
        'staffid': staffid,
      },
        success: function (response) {
			
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
			setTimeout(function(){ location.reload() }, 2000);
        }
    });
		
        
    });

}

	</script>
	<script>
function searchFilter(page_num) {

    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'getdata.php',
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#posts_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>
    </body>


</html>