<html>
<head>
  <title><?php echo $title; ?></title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <style>
          body
          {
               margin:0;
               padding:0;
               background-color:#f1f1f1;
          }
          .box
          {
               width:900px;
               padding:20px;
               background-color:#fff;
               border:1px solid #ccc;
               border-radius:5px;
               margin-top:10px;
          }
     </style>
</head>
<body>
     <div class="container">
          <h3 align="center"><?php echo $title; ?></h3><br />
          <div class="table-responsive">
               <br />
               <table id="user_data" class="table table-striped">
                 <div id="response">

                 </div>
                    <thead>
                         <tr>
                              <th width="35%">Name</th>
                              <th width="35%">Email</th>
                              <th width="10%">Password</th>
                              <th width="40%">User Role</th>
                              <th width="10%">Edit</th>
                              <th width="10%">Delete</th>
                         </tr>
                    </thead>
               </table>

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
          </div>
     </div>



<script type="text/javascript" language="javascript" >
$(document).ready(function(){
     var dataTable = $('#user_data').DataTable({
          "processing":true,
          "serverSide":true,
          "order":[],
          "ajax":{
               url:"<?php echo base_url() . 'index.php/ajaxCrudController/fetch_user'; ?>",
               type:"POST"
          },
          "columnDefs":[
               {
                    "targets":[0, 3, 4],
                    "orderable":false,
               },
          ],
     });
});

function update(id){
		//alert(id);
		 $("#create .modal-title").html("update");
		// //bcsf13a011
    //
		$.ajax({
			url:'<?php echo base_url().'index.php/ajaxCrudController/update/'?>'+id,
			type:'POST',
			dataType:'json',
			success : function(response){
        //alert(response);
				$("#response").html(response["html"]);
				$("#create").modal("show");
        //alert("hello");

			}
		});
	}

  $("body").on("submit","#update", function(e){
		e.preventDefault();
		//alert();
		$.ajax({
			url:'<?php echo base_url().'index.php/ajaxCrudController/updating'?>',
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
					if (response["email"] != "") {
						$(".colorError").html(response["email"]).addClass('invalid-feedback  d-block');
						$("email").addClass('is-invalid');


					}
					else{

							$(".colorError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("email").addClass('is-invalid');

						}
					if (response["password"] != "") {
						$(".priceError").html(response["password"]).addClass('invalid-feedback  d-block');
						$("password").addClass('is-invalid');



						}
						else{

							$(".priceError").html(response[""]).removeClass('invalid-feedback  d-block');
							$("password").addClass('is-invalid');

						}


					}
					else{
             location.reload();



				}



			}

				//console.log(response);
				//$("#response").html(response["html"]);

	});
	});

  function deletee(id){
		//var id = $("#deletemodal").data('id');

		$.ajax({
			url:'<?php echo base_url().'index.php/ajaxCrudController/delete/'?>'+id,
			type:'POST',
			data:$(this).serializeArray(),
			dataType:'json',
			success : function(response){

				if(response['status'] == 1){
          location.reload();
					$("#deletemodal").modal("hide");
					$("#ajaxResponse .modal-body").html(response["msg"]);
					$("#ajaxResponse").modal("show");
					setTimeout(function(){// wait for 5 secs(2)
           			location.reload(); // then reload the page.(3)
      				}, 5000);
				}else{
          location.reload();
					// $("#deletemodal").modal("hide");
					// $("#ajaxResponse .modal-body").html(response["msg"]);
					// $("#ajaxResponse").modal("show");
					// setTimeout(function(){// wait for 5 secs(2)
          //  			location.reload(); // then reload the page.(3)
      		// 		}, 5000);


				}

			}


		});
	}

</script>

</body>
</html>
