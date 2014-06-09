$(document).ready(function(){

/*
 * START GENERAL
 */
	
//sidebar navgiation slide up/down functionality
  $(".submenu > a").click(function(e) {
    e.preventDefault();
    var $li = $(this).parent("li");
    var $ul = $(this).next("ul");

    if($li.hasClass("open")) {
      $ul.slideUp(350);
      $li.removeClass("open");
    } else {
      $(".nav > li > ul").slideUp(350);
      $(".nav > li").removeClass("open");
      $ul.slideDown(350);
      $li.addClass("open");
    }
  });
  
//completed projects accordion
  $(function() {
	  $( "#projects-completed" ).accordion();
  });
  
//Tiny MCE
  tinymce.init({
      selector: ".tiny_mce",
      plugins: [
          "advlist autolink lists link image charmap print preview anchor",
          "searchreplace visualblocks code fullscreen",
          "insertdatetime media table contextmenu paste"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
  });

  // Tiny MCE
  tinymce.init({
      selector: "#tinymce_full",
      plugins: [
          "advlist autolink lists link image charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime media nonbreaking save table contextmenu directionality",
          "emoticons template paste textcolor"
      ],
      toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
      toolbar2: "print preview media | forecolor backcolor emoticons",
      image_advtab: true,
      templates: [
          {title: 'Test template 1', content: 'Test 1'},
          {title: 'Test template 2', content: 'Test 2'}
      ]
  });
  
/*
 * END GENERAL
 */  
  
  
/*
 * CREATE USER
 */  
  var role = jQuery('#create-role');
	role.change(function () {
	    if (role.val() == 'user') {
	        $('.user-company').show();
	    }
	    else $('.user-company').hide();
	});
/*
 * END CREATE USER
 */	
	
/*
 * PROJECT DETAILS
 */	
	
	//hide save and cancel buttons by default
	$('#save-description-btn').hide();
	$('#cancel-description-btn').hide();
	
	//enable description input, show cancel and save buttons
	$('#edit-description-btn').click(function(){
        $('#edit-description').prop('disabled', false);
        $('#edit-description-btn').hide();
        $('#cancel-description-btn').show();
        $('#save-description-btn').show();
	});
	
	//disable description input, hide cancel and save buttons
	$('#cancel-description-btn').click(function(){
        $('#edit-description').prop('disabled', true);
        $('#edit-description-btn').show();
        $('#save-description-btn').hide();
        $('#cancel-description-btn').hide();
	});
	
	//fire ajax call to save the updated description
	$('#save-description-btn').click(function(){
		var project_id		= $('#project-id').val();
			description		= $('textarea#edit-description').val();

		$.ajax({
		     type: "POST",
		     url: 'submit.php',
		     data: { form: 'project-update-description', project: '' + project_id + '', description: '' + description + '' }
		   }).success(function( msg ) {
			      $('.success').css("display", "");
			      $(".success").fadeIn(1000, "linear");
			      $('.success_text').fadeIn("slow");
			      $('.success_text').html(msg);
			      setTimeout(function(){location.reload()},3000);
		  });
	});
	
	//fire ajax call to update the project status to active in the database
	$('#mark-active-btn').click(function(){
		var project_id		= $('#project-id').val();

		$.ajax({
		     type: "POST",
		     url: 'submit.php',
		     data: { form: 'project-update-status', project: '' + project_id + '', status: '1' }
		   }).success(function( msg ) {
			      $('.success').css("display", "");
			      $(".success").fadeIn(1000, "linear");
			      $('.success_text').fadeIn("slow");
			      $('.success_text').html(msg);
			      setTimeout(function(){location.reload()},3000);
		  });
	});
	
	$('#mark-completed-btn').click(function(){
		var project_id		= $('#project-id').val();

		$.ajax({
		     type: "POST",
		     url: 'submit.php',
		     data: { form: 'project-update-status', project: '' + project_id + '', status: '0' }
		   }).success(function( msg ) {
			      $('.success').css("display", "");
			      $(".success").fadeIn(1000, "linear");
			      $('.success_text').fadeIn("slow");
			      $('.success_text').html(msg);
			      setTimeout(function(){location.reload()},3000);
		  });
	});
	
	$(function() {
		$( "#task-due-date" ).datepicker();
			$( "#task-due-date" ).datepicker( "option", "dateFormat", 'yy-mm-dd' );
	});
/*
 * END PROJECT DETAILS
 */	
	
/*
 * TASK DETAILS
 */	
	
	//hide save and cancel buttons by default
	$('#task-save-description-btn').hide();
	$('#task-cancel-description-btn').hide();
	$('#task-cancel-progress-btn').hide();
	$('#task-save-progress-btn').hide();
	
	//enable description input, show cancel and save buttons
	$('#task-edit-description-btn').click(function(){
        $('#task-edit-description').prop('disabled', false);
        $('#task-edit-description-btn').hide();
        $('#task-cancel-description-btn').show();
        $('#task-save-description-btn').show();
	});
	
	//disable description input, hide cancel and save buttons
	$('#task-cancel-description-btn').click(function(){
        $('#task-edit-description').prop('disabled', true);
        $('#task-edit-description-btn').show();
        $('#task-save-description-btn').hide();
        $('#task-cancel-description-btn').hide();
	});
	
	//fire ajax call to save the updated description
	$('#task-save-description-btn').click(function(){
		var task_id			= $('#task-id').val();
			description		= $('textarea#task-edit-description').val();

		$.ajax({
		     type: "POST",
		     url: 'submit.php',
		     data: { form: 'task-update-description', task: '' + task_id + '', description: '' + description + '' }
		   }).success(function( msg ) {
			      $('.success').css("display", "");
			      $(".success").fadeIn(1000, "linear");
			      $('.success_text').fadeIn("slow");
			      $('.success_text').html(msg);
			      setTimeout(function(){location.reload()},3000);
		  });
	});
	
	$('#task-mark-completed-btn').click(function(){
		var task_id		= $('#task-id').val();

		$.ajax({
		     type: "POST",
		     url: 'submit.php',
		     data: { form: 'task-update-status', task: '' + task_id + '', status: '0' }
		   }).success(function( msg ) {
			      $('.success').css("display", "");
			      $(".success").fadeIn(1000, "linear");
			      $('.success_text').fadeIn("slow");
			      $('.success_text').html(msg);
			      setTimeout(function(){location.reload()},3000);
		  });
	});
	
	$('#task-mark-active-btn').click(function(){
		var task_id		= $('#task-id').val();

		$.ajax({
		     type: "POST",
		     url: 'submit.php',
		     data: { form: 'task-update-status', task: '' + task_id + '', status: '1' }
		   }).success(function( msg ) {
			      $('.success').css("display", "");
			      $(".success").fadeIn(1000, "linear");
			      $('.success_text').fadeIn("slow");
			      $('.success_text').html(msg);
			      setTimeout(function(){location.reload()},3000);
		  });
	});
	
	//enable description input, show cancel and save buttons
	$('#task-edit-progress-btn').click(function(){
        $('#task-update-progress').prop('disabled', false);
        $('#task-edit-progress-btn').hide();
        $('#task-cancel-progress-btn').show();
        $('#task-save-progress-btn').show();
	});
	
	//disable description input, hide cancel and save buttons
	$('#task-cancel-progress-btn').click(function(){
        $('#task-update-progress').prop('disabled', true);
        $('#task-edit-progress-btn').show();
        $('#task-save-progress-btn').hide();
        $('#task-cancel-progress-btn').hide();
	});
	
	//fire ajax call to save the updated description
	$('#task-save-progress-btn').click(function(){
		var task_id			= $('#task-id').val();
		progress			= $('#task-update-progress').val();

		$.ajax({
		     type: "POST",
		     url: 'submit.php',
		     data: { form: 'task-update-progress', task: '' + task_id + '', progress: '' + progress + '' }
		   }).success(function( msg ) {
			      $('.success').css("display", "");
			      $(".success").fadeIn(1000, "linear");
			      $('.success_text').fadeIn("slow");
			      $('.success_text').html(msg);
			      setTimeout(function(){location.reload()},3000);
		  });
	});
	
/*
 * END TASK DETAILS
 */	
	
/*
 * USERS
 */	
	
	$('#delete-user-btn').click(function(){
		var user_id			= $('#delete-user-id').val();

		$.ajax({
		     type: "POST",
		     url: 'submit.php',
		     data: { form: 'delete-user', user: '' + user_id + '' }
		   }).success(function( msg ) {
			      $('.success').css("display", "");
			      $(".success").fadeIn(1000, "linear");
			      $('.success_text').fadeIn("slow");
			      $('.success_text').html(msg);
			      setTimeout(function(){window.location='view-users.php'},3000);
		  });
	});
	
/*
 * END USERS
 */	
  
});