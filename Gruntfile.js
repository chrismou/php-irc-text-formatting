module.exports = function(grunt) {

    grunt.initConfig({
        phpunit: {
            unit: {
                dir: 'tests/',
                options: {
                    coverageHtml: 'coverage/html',
                    coverageClover: 'coverage/clover.xml'
                }
            },
            options: {
                bin: 'vendor/bin/phpunit',
                colors: true,
                configuration: 'phpunit.xml',
                followOutput: true
            }
        },
        phpcs: {
            application: {
                src: [
                    'src/**/*.php'
                ]
            },
            options: {
                bin: 'vendor/bin/phpcs',
                //report: 'checkstyle',
                //reportFile: 'storage/build/checkstyle.xml',
                standard: 'PSR2'
            }
        }
    });

    grunt.loadNpmTasks('grunt-phpcs');
    grunt.loadNpmTasks('grunt-phpunit');

    grunt.registerTask(
        'default',
        [
            'phpcs',
            'phpunit:unit'
        ]
    );

    grunt.registerTask(
        'coverage',
        [
            'phpunit:unitcoverage'
        ]
    );
};