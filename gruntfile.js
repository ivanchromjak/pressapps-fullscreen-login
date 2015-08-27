module.exports = function(grunt) {

    grunt.initConfig({

        uglify: {
          build: {
            files: {
              'admin/js/pressapps-fullscreen-login-admin.js': 'src/admin/js/*.js',
              'public/js/pressapps-fullscreen-login-public.js': 'src/public/js/*.js'
            }
          },
          dev: {
            options: {
              beautify: true,
              mangle: false,
              compress: false,
              preserveComments: 'all'
            },
            files: {
              'admin/js/pressapps-fullscreen-login-admin.js': 'src/admin/js/*.js',
              'public/js/pressapps-fullscreen-login-public.js': ['src/public/js/modernizr.custom.js', 'src/public/js/classie.js', 'src/public/js/snap.svg.js', 'src/public/js/public.js']
            }
          }
        },

        sass: {                              
          dev: {                           
            options: {                      
              style: 'expanded',
              sourcemap: 'none'
            },
            files: {                        
              'admin/css/pressapps-fullscreen-login-admin.css': 'src/admin/scss/admin.scss',
              'public/css/pressapps-fullscreen-login-public.css': 'src/public/scss/public.scss',
              'public/css/effects/contentpush.css': 'src/public/scss/effects/contentpush.scss',
              'public/css/effects/contentscale.css': 'src/public/scss/effects/contentscale.scss',
              'public/css/effects/corner.css': 'src/public/scss/effects/corner.scss',
              'public/css/effects/door.css': 'src/public/scss/effects/door.scss',
              'public/css/effects/hugeinc.css': 'src/public/scss/effects/hugeinc.scss',
              'public/css/effects/scale.css': 'src/public/scss/effects/scale.scss',
              'public/css/effects/simplegenie.css': 'src/public/scss/effects/simplegenie.scss',
              'public/css/effects/slidedown.css': 'src/public/scss/effects/slidedown.scss'
            }
          },
          build: {                           
            options: {                      
              style: 'compressed',
              sourcemap: 'none'
            },
            files: {                        
              'admin/css/pressapps-fullscreen-login-admin.css': 'src/admin/scss/admin.scss',
              'public/css/pressapps-fullscreen-login-public.css': 'src/public/scss/public.scss',
              'public/css/effects/contentpush.css': 'src/public/scss/effects/contentpush.scss',
              'public/css/effects/contentscale.css': 'src/public/scss/effects/contentscale.scss',
              'public/css/effects/corner.css': 'src/public/scss/effects/corner.scss',
              'public/css/effects/door.css': 'src/public/scss/effects/door.scss',
              'public/css/effects/hugeinc.css': 'src/public/scss/effects/hugeinc.scss',
              'public/css/effects/scale.css': 'src/public/scss/effects/scale.scss',
              'public/css/effects/simplegenie.css': 'src/public/scss/effects/simplegenie.scss',
              'public/css/effects/slidedown.css': 'src/public/scss/effects/slidedown.scss'
            }
          }
        },

        compress: {
              main: {
                options: {
                  archive: "../../../../production/pressapps-fullscreen-login.zip"
                },
                files: [
                   {
                     //cwd: '../',
                     expand: true,     // Enable dynamic expansion.
                     src: [
                      '**',
                      '!gruntfile.js',
                      '!.DS_Store',
                      '!node_modules/**',
                      '!.git',
                      '!admin/skelet/.git',
                      '!.gitignore',
                      '!.gitmodules',
                      '!.editorconfig',
                      '!.ftppass',
                      '!.grunt',
                      '!.jshintrc',
                      '!gruntfile.js',
                      '!package.json',
                      '!sftpCache.json',
                      '!src/**'
                    ], 
                     dest: '../',
                    },
               ]
            }
        },

        'sftp-deploy': {
          demo: {
            auth: {
              host: 'fullscreen-login.pressapps.io',
              port: 22,
              authKey: 'demo'
            },
            cache: 'sftpCache.json',
            src: './',
            dest: 'apps/wordpress/public/wp-content/plugins/pressapps-fullscreen-login',
            exclusions: [
              '.DS_Store',
              'node_modules',
              '.sass-cache',
              '.git',
              'admin/skelet/.git',
              '.gitignore',
              '.gitmodules',
              '.editorconfig',
              '.ftppass',
              '.grunt',
              '.jshintrc',
              'gruntfile.js',
              'package.json',
              'sftpCache.json',
              'src'
            ],
            progress: true
          }
        },

        watch: {
          js: {
            files: ['src/public/js/*.js', 'src/admin/js/*.js'],
            tasks: ['uglify:dev']
          },
          css: {
            files: ['src/public/scss/*.scss', 'src/admin/scss/*.scss'],
            tasks: ['sass:dev']
          }
        }

    });

    grunt.loadNpmTasks('grunt-sftp-deploy');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');

    grunt.registerTask('build', ['uglify:build','sass:build']);
    grunt.registerTask('default', ['uglify:dev','sass:dev']);

};