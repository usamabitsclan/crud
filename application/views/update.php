<form action="" method="post" id="update" name="update">
  <input type="hidden" name="id" value="<?php echo $row['id']?>">
<div class="modal-body">
      	<div class="form-group">
      		<label>Name</label>
      		<input type="text" name="name" id="name" value="<?php echo $row['name']?>" class="form-control">
      		<p class="nameError"></p>
      	</div>
       <div class="form-group">
      		<label>Email</label>
      		<input type="text" name="email" id="email" value="<?php echo $row['email']?>" class="form-control">
      		<p class="colorError"></p>

      	</div>

       <div class="form-group">
      		<label>Password</label>
      		<input type="password" name="password" id="password" value="<?php echo $row['password']?>" class="form-control">
      		<p class="priceError"></p>

      	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
</form>
