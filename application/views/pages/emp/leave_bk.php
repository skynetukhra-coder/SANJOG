<style>
td{padding:5px;}
</style>
<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div>
		<form>
			<div>
				<table border="1" align="center" style="width:50%">
					<tbody>
					

						<tr>
							<td class="col_1">Leave Type</td>
							<td align="center"><select id="title" name="title" class="form-control" required>
									<option data-value="0" value="">---- Select Title ----</option>
									<option data-value="1" value="Eearned leave">Eearned leave</option>
									<option data-value="3" value="Commuted Leave">Commuted Leave</option>
									<option data-value="4" value="Extra-Ordinary Leave">Extra-Ordinary Leave</option>
									<option data-value="5" value="Study Leve">Study Leve</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="col_1">Leave Form</td>
							<td align="center" class="col_2"><input type="text" name="date_from" data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" /></td>
						</tr>
						<tr>
							<td class="col_1">Leave To</td>
							<td align="center" class="col_2"><input type="text" name="date_from" data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" /></td>
						</tr>
						<tr>
							<td class="col_1">NO of Days</td>
							<td align="center" class="col_2"><input type="text" id="gender" name="gender" value="<?php //echo isset($data['gender']) ? $data['gender']: ''?>" class="form-control" ></td>
						</tr>
						<tr>
							<td class="col_1">Ground of Leave</td>
							<td align="center" class="col_2"><input type="text" id="gender" name="gender" value="<?php //echo isset($data['gender']) ? $data['gender']: ''?>" class="form-control" ></td>
						</tr>
						<tr>
							<td class="col_1">Address during Leave</td>
							<td align="center" class="col_2"><input type="text" id="gender" name="gender" value="<?php //echo isset($data['gender']) ? $data['gender']: ''?>" class="form-control" ></td>
						</tr>
						<tr>
							<td class="col_1">
								
							</td>
							<td align="center" class="col_2">
								<input type="reset" class="btn btn-primary" Value="CANCEL" />
								<span><<<<<<<    >>>>>></span>
								<input type="submit" class="btn btn-success" Value="UPDATE" />
							</td>
						</tr>
					</tbody>
				</table>
			</div>	
		</form>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo ADMIN_BASE_URL ?>administration/employee_edit/' + id;
    }
}
</script>