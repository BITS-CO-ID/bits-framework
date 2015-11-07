module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            css: {
                src: [
                    'public/components/bootstrap/dist/css/bootstrap.min.css',
                    'public/components/font-awesome/css/font-awesome.min.css',
                    'public/components/custom.css'
                ],
                dest: 'public/css/style.css'
            },
            js: {
                src: [
                    'public/components/jquery/dist/jquery.min.js',
                    'public/components/bootstrap/dist/js/bootstrap.min.js',
                    'public/components/custom.js'
                ],
                dest: 'public/js/script.js'
            }
        },
        cssmin: {
            css: {
                src: 'public/css/style.css',
                dest: 'public/css/style.min.css'
            }
        },
        uglify: {
            js: {
                files: {
                    'public/js/script.js': ['public/js/script.js']
                }
            }
        },
        watch: {
            files: [
                    'public/components/bootstrap/dist/css/bootstrap.min.css',
                    'public/components/font-awesome/css/font-awesome.min.css',
                    'public/components/custom.css',
                    'public/components/jquery/dist/jquery.min.js',
                    'public/components/bootstrap/dist/js/bootstrap.min.js',
                    'public/components/custom.js'
                ],
            tasks: ['concat', 'cssmin', 'uglify'],
            options: {
              livereload: true,
            }
        },
    });
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.registerTask('default', ['concat:css', 'cssmin:css', 'concat:js', 'uglify:js', 'watch']);
};
