module.exports = function(grunt) {
    require('load-grunt-tasks')(grunt);

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> - <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            build: {
                src: 'js/{,*/}*.js',
                dest: 'gruponews.min.js'
            }
        },
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'css/main.css': 'sass/style.sass'
                }
            },

            dev: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'css/main.css': 'sass/style.sass'
                }
            }
        },
        watch: {
            styles: {
                files: ['sass/**/*.{scss,sass}'],
                tasks: ['sass:dev']
            }
        },
        buildcontrol: {
            options: {
                dir: 'dist',
                commit: true,
                push: true,
                message: 'Built %sourceName% from commit %sourceCommit% on branch %sourceBranch%'
            },
            producao: {
                options: {
                    remote: 'ssh://gruponews@gruponews.com.br/~/public_html/site/wp-content/themes/gruponews13/',
                    branch: 'master'
                }
            }
        }

    });

    // Load the plugin that provides the "uglify" task.
    //grunt.loadNpmTasks('grunt-contrib-uglify');

    // Default task(s).
    grunt.registerTask('default', ['watch']);
    grunt.registerTask('build', ['uglify:build', 'sass:dist', 'buildcontrol:producao']);

};
