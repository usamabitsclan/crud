<form action="" method="post" id="editing" name="edit">
  <input type="hidden" name="id" value="<?php echo $row['id']?>">
<div class="modal-body">
      	<div class="form-group">
      		<label>Name</label>
      		<input type="text" name="name" id="name" value="<?php echo $row['name']?>" class="form-control">
      		<p class="nameError"></p>
      	</div>
       <div class="form-group">
      		<label>Color</label>
      		<input type="text" name="color" id="color" value="<?php echo $row['color']?>" class="form-control">
      		<p class="colorError"></p>

      	</div>
       <div class="form-group">
      		<label>STATUS</label>
      		<select id="transmission" name="transmission" class="form-control">
      			<option value="Automatic" <?php echo ($row['transmission'] == "Approved") ?'selected': ''?>>Approved</option>
      			<option value="Manual" <?php echo ($row['transmission'] == "NotApproved") ?'selected': ''?>>Not Approved</option>

      			
      		</select>
      	</div>
       <div class="form-group">
      		<label>Price</label>
      		<input type="text" name="price" id="price" value="<?php echo $row['price']?>" class="form-control">
      		<p class="priceError"></p>

      	</div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
</form>