


<tr id="row-<?php echo $row['id']?>">
								<td class="modelId"><?php echo $row['id']?></td>
								<td class="modelName"><?php echo $row['name']?></td>
								<td class="modelColor"><?php echo $row['color']?></td>
								<td class="modelTransmission"><?php echo $row['transmission']?></td>
								<td class="modelPrice"><?php echo $row['price']?></td>
								<td class="model"><?php echo $row['created_at']?></td>
								<td><a href="javascript:void(0);" onclick="showEditForm(<?php echo $row['id']?>);" class="btn btn-primary">EDIT</a></td>
								<td><a href="javascript:void(0);" class="btn btn-danger" onclick="confirmDelete(<?php echo $row['id']?>);"  >Delete</a></td>

</tr>