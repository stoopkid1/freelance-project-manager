/**
* Custom Javascript & jQuery
* About  : Used to handle form submissions & button onclicks
* 		   A majority of these functions could have been combined into one,
* 		   but I wrote them individually to allow for more customization
* 		   and future changes.
* Author : Michael Loring
* Project: Freelance Project Manager - http://www.mdloring.com/ezleague
* Contact: E-Mail - mdloring@gmail.com ~ Web - http://www.mdloring.com
*/

	$('#fpmRegister').submit(function(e) {
		var username    = $("#register-username").val();
			email	    = $("#register-email").val();
			password    = $("#register-password").val();
			confirm     = $("#register-confirm").val();
			captcha_a   = $("#register-captcha").val();
			captcha     = $("#register-answer").val();
		 e.preventDefault();
   if(captcha_a == captcha) { 
	if(password == confirm && password != '' && password.length >= 6) {
	 $.ajax({
	     type: "POST",
	     url: 'submit.php',
	     data: { form: 'register', username: '' + username + '', email: '' + email + '', password: '' + password + '', confirm: '' + confirm + '' }
	   }).success(function( msg ) {
		      $('.register_success').css("display", "");
		      $(".register_success").fadeIn(1000, "linear");
		      $('.register_success_text').fadeIn("slow");
		      $('.register_success_text').html(msg);

	 	   if(msg == "<strong>Success!</strong> Account has been created. You may now login.") {
	 		  setTimeout(function(){location.reload()},3000);
	 	   }
	  });
	} else {
			$('.register_success').css("display", "");
	        $(".register_success").fadeIn(1000, "linear");
	        $('.register_success_text').fadeIn("slow");
	        $('.register_success_text').html('<strong>Error</strong> Passwords do not match, or is less than 6 characters');
	}
   } else {
		    $('.register_success').css("display", "");
	        $(".register_success").fadeIn(1000, "linear");
	        $('.register_success_text').fadeIn("slow");
	        $('.register_success_text').html('<strong>Error</strong> CAPTCHA answer incorrect');
   }
	});
	
//login to fpm	
	$('#fpmLogin').submit(function(e) {
		var username	= $("#login-username").val();
			password    = $("#login-password").val();
		 e.preventDefault();
	 $.ajax({
	     type: "POST",
	     url: 'submit.php',
	     data: { form: 'login', username: '' + username + '', password: '' + password + ''}
	   }).success(function( msg ) {
		      $('.login_success').css("display", "");
		      $(".login_success").fadeIn(1000, "linear");
		      $('.login_success_text').fadeIn("slow");
		      $('.login_success_text').html(msg);
		      setTimeout(function(){location.reload()},3000);
	  });
	});
	
/*
 * END LOGIN & REGISTRATION FUNCTIONALITY
 */
	

//add client
	$('#add-client').submit(function(e) {
		var company		= $("#company-company").val();
			owner	    = $("#company-owner").val();
			website	    = $("#company-website").val();
			email	    = $("#company-email").val();
		 e.preventDefault();
	 $.ajax({
	     type: "POST",
	     url: 'submit.php',
	     data: { form: 'add-client', company: '' + company + '', owner: '' + owner + '', website: '' + website + '', email: '' + email + '' }
	   }).success(function( msg ) {
		      $('.success').css("display", "");
		      $(".success").fadeIn(1000, "linear");
		      $('.success_text').fadeIn("slow");
		      $('.success_text').html(msg);
		      setTimeout(function(){location.reload()},3000);
	  });
	});
	
//add task
	$('#task-create').submit(function(e) {
		var project		= $("#task-project").val();
			task	    = $("#task-task").val();
			description	= $("#task-description").val();
			assignee	= $("#task-assignee").val();
			priority	= $("#task-priority").val();
			due_date	= $("#task-due-date").val();
			company		= $("#task-company").val();
			
		 e.preventDefault();
	 $.ajax({
	     type: "POST",
	     url: 'submit.php',
	     data: { form: 'task-create', project: '' + project + '', task: '' + task + '', description: '' + description + '', assignee: '' + assignee + '', priority: '' + priority + '', due_date: '' + due_date + '', company: '' + company + '' }
	   }).success(function( msg ) {
		      $('.success').css("display", "");
		      $(".success").fadeIn(1000, "linear");
		      $('.success_text').fadeIn("slow");
		      $('.success_text').html(msg);
		      setTimeout(function(){location.reload()},3000);
	  });
	});
	
//add task note
	$('#task-add-note').submit(function(e) {
		var task	    = $("#task-task").val();
			note		= tinyMCE.get('task-note').getContent();

		 e.preventDefault();
	 $.ajax({
	     type: "POST",
	     url: 'submit.php',
	     data: { form: 'task-add-note', task: '' + task + '', note: '' + note + '' }
	   }).success(function( msg ) {
		      $('.success').css("display", "");
		      $(".success").fadeIn(1000, "linear");
		      $('.success_text').fadeIn("slow");
		      $('.success_text').html(msg);
		      setTimeout(function(){location.reload()},3000);
	  });
	});