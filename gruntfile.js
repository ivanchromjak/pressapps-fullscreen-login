module.exports = function(grunt) {

    grunt.initConfig({

        uglify: {
          build: {
            src: 'src/public/js/*.js',
            dest: 'public/js/pressapps-fullscreen-login-public.js'
          },
          dev: {
            options: {
              beautify: true,
              mangle: false,
              compress: false,
              preserveComments: 'all'
            },
            src: 'src/public/js/*.js',
            dest: 'public/js/pressapps-fullscreen-login-public.js'
          }
        },

        sass: {                              
          dev: {                           
            options: {                      
              style: 'expanded',
              sourcemap: 'none'
            },
            files: {                        
              'public/css/pressapps-fullscreen-login-public.css': 'src/public/scss/*.scss'
            }
          },
          build: {                           
            options: {                      
              style: 'compressed',
              sourcemap: 'none'
            },
            files: {                        
              'public/css/pressapps-fullscreen-login-public.css': 'src/public/scss/*.scss'
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

        'ftp-deploy': {
          dev: {
            auth: {
              host: '188.121.45.1',
              port: 21,
              authKey: 'key1'
            },
            src: './',
            dest: '/wp-content/plugins/pressapps-fullscreen-login',
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
            ]
          },
          demo: {
            auth: {
              host: '188.121.45.1',
              port: 21,
              authKey: 'key1'
            },
            src: './',
            dest: '/wp-content/plugins/pressapps-fullscreen-login',
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
            ]
          }
        },

        watch: {
          js: {
            files: ['src/public/js/*.js'],
            tasks: ['uglify:dev']
          },
          css: {
            files: ['src/public/scss/*.scss'],
            tasks: ['sass:dev']
          }
        }

    });

    grunt.loadNpmTasks('grunt-ftp-deploy');
    grunt.loadNpmTasks('grunt-sftp-deploy');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    //grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-sass');

    grunt.registerTask('build', ['uglify:build','sass:build']);
    grunt.registerTask('default', ['uglify:dev','sass:dev']);

};


