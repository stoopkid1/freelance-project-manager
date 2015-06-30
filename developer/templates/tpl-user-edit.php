<?php $user_details = $fpm->getUserById($user_id); ?>		
		<form class="form-horizontal" role="form">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">First Name</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="create-first-name" value="<?php print $user_details['first_name']; ?>" type="text">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Last Name</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="create-last-name" value="<?php print $user_details['last_name']; ?>" type="text">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Phone Number</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="create-phone-number" value="<?php print $user_details['phone']; ?>" type="phone">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">E-Mail</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="create-first-name" value="<?php print $user_details['email']; ?>" type="text">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Type</label>
		    <div class="col-sm-9">
		      <select class="form-control" id="create-role">
		       <option></option>
		       <option value="user">Client</option>
		       <option value="contractor">Freelancer</option>
		       <option value="admin">Admin</option>
		      </select>
		    </div>
		  </div>
		  <div class="form-group user-company" style="display:none;">
		    <label for="inputEmail3" class="col-sm-3 control-label">Company</label>
		    <div class="col-sm-9">
		      <select class="form-control" id="create-company">
		      		<option value=""></option>
		       <?php $companies = $fpm->getCompanies(); ?>
		        <?php foreach($companies as $company) { ?>
		        	<option value="<?php print $company['id']; ?>"><?php print $company['company']; ?></option>
		        <?php } ?>
		      </select>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-primary">Create User</button>
		    </div>
		  </div>
		  <div class="success">
		   <span class="success_text"></span>
		  </div>
  		</form>
  		
  		<script type="text/javascript">
	  		
  		</script>