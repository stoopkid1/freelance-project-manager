<?php $users = $fpm->getClients(); ?>
	      <div class="table-responsive">
			<table class="table">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Company</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                 <?php foreach($users as $user) { $company = $fpm->getCompanyName($user['company']); ?>
                  <tr>
                   <td><a href="view-users.php?id=<?php print $user['id']; ?>"><?php print $user['username']; ?></a></td>
                   <td><a href="view-client.php?id=<?php print $user['company']; ?>"><?php print $company; ?></a></td>
                   <td><a href="view-users.php?id=<?php print $user['id']; ?>" class="btn btn-info btn-xs">View Details</a></td>
                  </tr>
                 <?php } ?>
              </tbody>
            </table>
		 </div>