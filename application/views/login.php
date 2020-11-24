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
        <a href="#" class="navbar-brand">BITSCLAN APPLICATION</a>
      </div>
    </div>
    <div class="container" style="padding-top: 10px;">
      <h3>LOG IN</h3>
      <hr>
      <form method="post" name="LOGINUSER" action="<?php echo base_url().'index.php/user/canlogin';?>" >

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
        <div class="col-md-6">
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php set_value('email');?>" class="form-control">
            <?php echo form_error('email');?>

          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" value="<?php set_value('password');?>" class="form-control">
            <?php echo form_error('password');?>
          </div>
          <div class="form-group">
            <button class="btn btn-primary">LOG IN</button>
            <a href="<?php echo base_url().'index.php/user/index'; ?>" class="btn-secondary btn">Cancel</a>

          </div>
        </div>
     </div>
     <div class="row">
       <div class="col-md-8">
         <div class="row">
           <div class="col-6"><p>New Here ? Register YourSelf...</p></div>
             <div class="col-6"> <a href="<?php echo base_url().'index.php/user/create' ?>" class="btn btn-primary">Register</a></div>

         </div>

       </div>
     </div>
   </div>
</form>

  </body>
</html>
