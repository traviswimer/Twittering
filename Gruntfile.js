
module.exports = function(grunt){

	grunt.initConfig({

		// PHP unit tests
		phpunit: {
			classes: {
				dir: './test/'
			},
			options: {
				bin: './vendor/bin/phpunit',
				bootstrap: './test/phpunitBootstrap.php',
				colors: true,
				coverage: true,
				coverageHtml: './test/coverage_report',
				configuration: './test/phpunit.xml'
			}
		},

		// Run tasks when changes occur
		watch: {
			testBack: {
				files: [
					'./test/**/*.php',
					'./src/**/*.php'
				],
				tasks: ['phpunit']
			}
		},


	});

	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-phpunit');

	grunt.registerTask('default', ['watch']);
	grunt.registerTask('test', ['phpunit']);

};

