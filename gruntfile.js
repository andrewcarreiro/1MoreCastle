module.exports = function(grunt){
	grunt.initConfig({
		pkg : grunt.file.readJSON('package.json'),

		less: {
			dev: {
				options: {
					dumpLineNumbers : false
				},
				files: {
					'./1MoreCastle2/style.css':['src/styles/fonts.less', 'src/styles/main.less', 'src/styles/mobile.less','src/styles/desktop.less']
				}
			},
			deploy: {
				options: {
					cleancss : true,
					compress : true
				},
				files: {
					'./1MoreCastle2/style.css':['src/styles/fonts.less', 'src/styles/main.less', 'src/styles/mobile.less','src/styles/desktop.less']
				}
			}
		},

		concat : {
			options : {
				separator : ';'
			},
			dev : {
				src : ['src/js/jquery-2.0.2.min.js','src/js/iscroll.js','src/js/main.js'],
				dest : './1MoreCastle2/script.js'
			}
		}, 

		uglify : {
			options : {
				mangle : false
			},
			prod : {
				files : {
					'./1MoreCastle2/script.js' : ['src/js/jquery-2.0.2.min.js','src/js/iscroll.js','src/js/main.js']
				}
			}
		},

		copy : {
			php : {
				expand : true,
				cwd    : 'src/', 
				src    : '*.php',
				dest   : './1MoreCastle2/'
			},
			images : {
				expand : true,
				cwd    : 'src/', 
				src    : 'images/*',
				dest   : './1MoreCastle2/'
			}
		},

		watch : {
			files : ['src/**/*'],
			tasks : 'dev'
		}



	});

	grunt.registerTask('dev',['less:dev', 'concat:dev', 'copy:php','copy:images']);
	grunt.registerTask('deploy',['less:deploy','uglify:prod', 'copy:php']);



	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-less');
}