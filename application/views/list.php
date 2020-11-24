<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CRUD</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css';?>">
  </head>
  <body>
    <div class="navbar navbar-dark bg-dark">
      <div class="container">
        <a href="#" class="navbar-brand">CRUD APPLICATION - View Users</a>
      </div>
    </div>
    <div class="container" style="padding-top: 10px;">

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

      <div class="row">
        <div class="col-md-8">
          <div class="row">
            <div class="col-6"><h3>View User</h3></div>
              <div class="col-6"> <a href="<?php echo base_url().'index.php/user/create' ?>" class="btn btn-primary">Register</a></div>

          </div>

        </div>
      </div>

      <hr>
      <div class="row">
        <div class="col-md-8">
          <table class="table table-striped">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th width="70">Edit</th>
              <th width="100">Delete</th>
            </tr>
            <?php if(!empty($users)) {foreach($users as $user) { ?>
            <tr>
              <td><?php echo $user['id'] ?></td>
              <td><?php echo $user['name'] ?></td>
              <td><?php echo $user['email'] ?></td>
              <td>
                <a href="<?php echo base_url().'index.php/user/edit/'.$user['id'] ?>" class="btn btn-primary">Edit</a>
              </td>
              <td>
                <a href="<?php echo base_url().'index.php/user/delete/'.$user['id'] ?>" class="btn btn-danger">Delete</a>
              </td>
            </tr>
          <?php  } } else { ?>
            <tr>
              <td colspan="5">Records not found</td>
            </tr>
          <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
