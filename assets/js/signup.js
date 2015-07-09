(function( $ ) {

/**
 *  FPM DEVELOPER SIGNUP
 *  Registration functionality specifically for DEVELOPER ACCOUNTS
 */

  var FPM_Signup = {

    /**
     * Initialize FPM Developer Signup
     */
    init: function() {

      this.cacheElements();
      this.bindEvents();
    },

    /**
     * Cache elements to object-level variables
     */
    cacheElements: function() {

			this.body = $('body');
			this.signupButton = $('#signup-btn');

    },

    bindEvents: function() {

      this.signupButton.on( "click", $.proxy( function (e) {

        e.preventDefault();
        var email     = $('#signup-email').val();
            password  = $('#signup-password').val();
            confirm   = $('#signup-confirm').val();

        $.ajax({
             type: "POST",
             url: 'submit.php',
             data: { form: 'signup', email: '' + email + '', password: '' + password + '', confirm: '' + confirm + '' }
           }).success(function( msg ) {
                $('.success').css("display", "");
                $('.success').fadeIn(1000, "linear");
                $('.success_text').fadeIn("slow");
                $('.success_text').html(msg);
                setTimeout(function(){window.location='index.php';},3000);
          });

      }, this ) );

    }

  };

  /**
   * Wait until the document is ready before initializing
   */
  $(document).ready(function() {

    FPM_Signup.init();

  });

}( jQuery ) );
