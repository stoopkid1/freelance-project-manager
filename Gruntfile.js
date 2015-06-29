module.exports = function( grunt ) {

	'use strict';

	// Project configuration
	grunt.initConfig( {

		pkg:    grunt.file.readJSON( 'package.json' ),

		// JS Minification & Concatenation, run "grunt uglify" to minify js
		uglify: {

			compile: {
				options: {
					banner: '/*! <%= pkg.name %> v<%= pkg.version %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/js/compiled.fpm.min.js' : ['assets/js/fpm.js']
				}
			}

		},

		// Compile SASS, run "grunt watch" to autorecompile css changes
		sass: {

			compile: {
				files: {
					'assets/css/theme.css' : 'assets/css/scss/theme.scss'
				}
			}

		},

		// Run "grunt cssmin" to minify css
		cssmin: {
			compile: {
				options: {
					banner: '/*! <%= pkg.name %> v<%= pkg.version %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
						'assets/css/compiled.fpm.css': ['assets/css/theme.css']
				}
			}
		},

		// Watch for changes
		watch:  {

			sass: {
				files: ['assets/css/scss/*/**/*.scss','assets/css/scss/*/**/*.scss'],
				tasks: ['sass'],
				options: {
					debounceDelay: 500,
					livereload: true
				}
			},

			js: {
				files: ['assets/js/*.js'],
				tasks: ['uglify'],
				options: {
					debounceDelay: 500
				}
			}

		}
	} );

	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Default task.
	grunt.registerTask( 'default', ['uglify', 'sass', 'cssmin' ] );

	grunt.util.linefeed = '\n';

};
