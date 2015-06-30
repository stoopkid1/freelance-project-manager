		<form class="form-horizontal" id="create-account" role="form">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">First Name</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="create-first-name" placeholder="First Name" type="text">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Last Name</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="create-last-name" placeholder="Last Name" type="text">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Phone Number</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="create-phone-number" placeholder="ex: 123-456-7890" type="phone">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">E-Mail</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="create-email" placeholder="E-Mail Address" type="text">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="create-password" placeholder="Password" type="password">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Confirm</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="create-confirm" placeholder="Password" type="password">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Type</label>
		    <div class="col-sm-9">
		      <select class="form-control" id="create-role">
		       <option></option>
		       <option value="client">Client</option>
		       <option value="user">Freelancer</option>
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
		  <div class="register_success">
		   <span class="register_success_text"></span>
		  </div>
  		</form>
  		
  		<script type="text/javascript">
	  		
  		</script>