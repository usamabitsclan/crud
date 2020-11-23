<!DOCTYPE html>
<html>
<head>
	<title>AJAX CRUD</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/style.css">


</head>
<body>
	<div class="row">
          <div class="col-md-12">
            <?php
            $success =  $this->session->userdata('success');
            if ($success != '') {
              // code...
             ?>
             <div class="alert alert-success">
               <?php echo $success; ?>
             </div>
           <?php
           }
           ?>

           <?php
           $failure =  $this->session->userdata('failure');
           if ($failure != '') {
             // code...
            ?>
            <div class="alert alert-success">
              <?php echo $failure; ?>
            </div>
          <?php
          }
          ?>
          </div>
        </div>


	<div class="header">
		<div class="container">
			<h1 class="heading">ADMIN SIDE</h1>
		</div>
	</div>
	<div class="container">
		<div class="row pt-4">
			<div class="col-md-6">
				<h4>Car Model</h4>
			</div>
			<!-- <div class="col-md-6 text-right">
				<a href="javascript:void(0);" onclick="showModal()" class="btn btn-primary">Create</a>
			</div> -->
			<div class="col-md-12 pt-2	">
				<table class="table table-striped" id="carmodelList">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Color</th>
						<th>STATUS</th>
						<th>Price</th>
						<th>Created Date</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					<?php if(!empty($rows)){?>
						<?php foreach($rows as $row){ 
							$data['row'] = $row;
							$this->load->view('carrow',$data);
						}
						?>
					<?php } else {?>
							<tr>
								<td>Records not found</td>
							</tr>
					<?php }?>
				</table>
			</div>
		</div>
	</div>

	<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button> -->
<!-- //create model -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titlee"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      	<div id="response">
      		
      	</div>
       
    </div>
  </div>
</div>
<!-- Added Successfully modal -->
<div class="modal fade" id="ajaxResponse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      		<div class="modal-body">
      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

       
    </div>
  </div>
</div>

<!-- deleted Successfully modal -->
<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      		<div class="modal-body">
      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" onclick="deleteNow();">Yes</button>

      </div>

       
    </div>
  </div>
</div>
<script type="text/javascript">
	function showModal(){
		$("#create .modal-title").html("Create");
		//$("#create #title").html("create");
		//$("create .modal-title").html("edit");
		$("#create").modal("show");
		

		$.ajax({
			url:'<?php echo base_url().'index.php/CarModel/showCreateForm'?>',
			type:'POST',
			data:{},
			dataType:'json',
			success : function(response){
				console.log(response);
				$("#response").html(response["html"]);
			}
		}) 
	}
	$("body").on("submit","#createCar", function(e){
		//Prevent a submit button from submitting a form
		e.preventDefault();

		//alert();
		$.ajax({
			url:'<?php echo base_url().'index.php/CarModel/saveModel'?>',
			type:'POST',
			data:$(this).serializeArray(),
			dataType:'json',
			success : function(response){
				if (response['status'] == 0) {
					if (response["name"] != "") {
						$(".nameError").html(response["name"]).addClass('invalid-feedback  d-block');
						$("name").addClass('is-invalid');
						
					}
					else{

							$(".nameError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("name").addClass('is-invalid');

						}
					if (response["color"] != "") {
						$(".colorError").html(response["color"]).addClass('invalid-feedback  d-block');
						$("color").addClass('is-invalid');
						

					}
					else{

							$(".colorError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("name").addClass('is-invalid');

						}
					if (response["price"] != "") {
						$(".priceError").html(response["price"]).addClass('invalid-feedback  d-block');
						$("price").addClass('is-invalid');
						


						}
						else{

							$(".priceError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("name").addClass('is-invalid');

						}

						
					}
					else{
							$("#create").modal("hide");
							$("#ajaxResponse .modal-body").html(response["message"]);
							$("#ajaxResponse").modal("show");
							$(".nameError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("name").addClass('is-invalid');

							$(".colorError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("name").addClass('is-invalid');

							$(".priceError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("name").addClass('is-invalid');

							$("#carmodelList").append(response["row"]);
				}
				//console.log(response);
				//$("#response").html(response["html"]);
			}
		})
	});

	function showEditForm(id){
		//alert(id);
		$("#create .modal-title").html("Edit");
		//bcsf13a011

		$.ajax({
			url:'<?php echo base_url().'index.php/CarModel/getCarModel/'?>'+id,
			type:'POST',
			dataType:'json',
			success : function(response){
				$("#create #response").html(response["html"]);
				$("#create").modal("show");

			}
		});
	}


	$("body").on("submit","#editing", function(e){
		e.preventDefault();
		//alert();
		$.ajax({
			url:'<?php echo base_url().'index.php/CarModel/updateModel'?>',
			type:'POST',
			data:$(this).serializeArray(),
			dataType:'json',
			success : function(response){
				if (response['status'] == 0) {
					if (response["name"] != "") {
						$(".nameError").html(response["name"]).addClass('invalid-feedback  d-block');
						$("name").addClass('is-invalid');
						
					}
					else{

							$(".nameError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("name").addClass('is-invalid');

						}
					if (response["color"] != "") {
						$(".colorError").html(response["color"]).addClass('invalid-feedback  d-block');
						$("color").addClass('is-invalid');
						

					}
					else{

							$(".colorError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("name").addClass('is-invalid');

						}
					if (response["price"] != "") {
						$(".priceError").html(response["price"]).addClass('invalid-feedback  d-block');
						$("price").addClass('is-invalid');
						


						}
						else{

							$(".priceError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("name").addClass('is-invalid');

						}

						
					}
					else{
							$("#create").modal("hide");
							$("#ajaxResponse .modal-body").html(response["message"]);
							$("#ajaxResponse").modal("show");
							$(".nameError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("name").addClass('is-invalid');

							$(".colorError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("name").addClass('is-invalid');

							$(".priceError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("name").addClass('is-invalid');

							var id = response["row"]["id"];
							$("#row-"+id+" .modelName").html(response["row"]["name"]);
							$("#row-"+id+" .modelColor").html(response["row"]["color"]);
							$("#row-"+id+" .modelTransmission").html(response["row"]["transmission"]);
							$("#row-"+id+" .modelPrice").html(response["row"]["price"]);




				}



			}
				
				//console.log(response);
				//$("#response").html(response["html"]);
		
	});
	});

	function confirmDelete(id){
		//alert(id);
		$("#deletemodal").modal("show");
		$("#deletemodal .modal-body").html("Are you sure you want to delete #"+id+"th record ?");
		$("#deletemodal").data("id",id);

	}

	function deleteNow(){
		var id = $("#deletemodal").data('id');

		$.ajax({
			url:'<?php echo base_url().'index.php/CarModel/deleteModel/'?>'+id,
			type:'POST',
			data:$(this).serializeArray(),
			dataType:'json',
			success : function(response){
				if(response['status'] == 1){
					$("#deletemodal").modal("hide");	
					$("#ajaxResponse .modal-body").html(response["msg"]);
					$("#ajaxResponse").modal("show");
					setTimeout(function(){// wait for 5 secs(2)
           			location.reload(); // then reload the page.(3)
      				}, 5000);						
				}else{
					$("#deletemodal").modal("hide");	
					$("#ajaxResponse .modal-body").html(response["msg"]);
					$("#ajaxResponse").modal("show");
					setTimeout(function(){// wait for 5 secs(2)
           			location.reload(); // then reload the page.(3)
      				}, 5000);	
					

				}

			}


		});
	}

</script>
</body>
</html>