module.exports = function(grunt) {

	grunt.initConfig({


		bower_concat: {
			all: {

				dest:"build/_bower.js",
				cssDest: "build/_bower.css",
			mainFiles: {
				'bootstrap': ['dist/css/bootstrap.css']
			}
		}
		},

		/*START: CONCAT*/
		concat: {
			options: {
				process: function(src,filepath) {
					return "\n/**************/\n/****"+
					filepath+"*****/\n/***********/\n"+src;

				}
			},
			//concatenate files from bower
			bower: {
				files : {
					"public/css/_bower.css":
						["bower_components/bootstrap/dist/css/*.min.css",
					     "bower_components/dropzone/dist/*.css",
					     "bower_components/font-awesome/css/font-awesome.css",
					     ],
					     "public/js/_bower.js":[
                    	   "bower_components/jquery/dist/*.min.js",
                    	   "bower_components/angular/angular.js",
                           "bower_components/bootstrap/dist/js/*.min.js",
                           "bower_components/dropzone/dist/*.min.js",
                           ]
				}
			},
			//concatenate files to be used in backend part of the website
			admin: {
				files: {
					"public/css/backend.main.css": ["public/css/_bower.css",
                    "public/css/backend/*.css"],
                    "public/js/backend.main.js": ["public/js/_bower.js"]

				}
			}
		},
		/**END: CONCAT**/

		/**STARTl COPY**/
		copy: {
			fonts: {
				files: [
					{expand:true,flatten:true,
						src:["bower_components/font-awesome/fonts/*"],
						dest:"public/fonts/"},
					{expand:true,flatten:true,
							src:["bower_components/bootstrap/fonts/*"],
							dest:"public/fonts/"},
				]
			}
		},
		/**END: COPY**/

		/**START: CLEAN**/
		clean: {
			fonts: {
				src: ["public/fonts/*"]
			}
		},
		/**END: CLEAN**/

		/**START: CSSMIN**/
		cssmin: {
			backend: {
				files:[{
					expand:true,
					cwd: "public/css",
					src: ["backend.main.css"],
					dest: "public/css",
					ext: ".min.css"
				}]

			}
		},
		/**END: CSSMIN**/

		/**START: UGLIFY**/
		uglify: {
			backend: {
				files:{
					'public/js/backend.main.min.js':['public/js/backend.main.js']
				}
			}
		},
		/**END: UGLIFY**/

		/**START: SASS**/
		sass: {
			backend: {
				files: {
					"./public/css/backend/backend.css": "./public/css/backend/sass/main.scss"
				}
			}
		}
		/**END: SASS**/
	});

	grunt.loadNpmTasks('grunt-bower-concat');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');

	grunt.registerTask("default",["bower_concat:all"]);
	grunt.registerTask("concat_bower_files",["concat:bower"]);
	grunt.registerTask("copy_fonts",["sass:fonts","copy:fonts"]);

	grunt.registerTask("sass_compile",["sass:backend"]);

	grunt.registerTask("development",["clean:fonts",
	                             "copy:fonts",
															 "sass_compile",
	                             "concat:bower",
	                             "concat:admin"]);
	grunt.registerTask("minify",["cssmin:backend","uglify:backend"]);

	grunt.registerTask("production",['development','minify']);
}
