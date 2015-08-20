module.exports = function(grunt) {

    grunt.initConfig({

        compress: {
              main: {
                options: {
                  archive: "../../../../production/pressapps-fullscreen-login.zip"
                },

                files: [
                   {
                     //cwd: '../',
                     expand: true,     // Enable dynamic expansion.
                     src: ['**'], // Actual pattern(s) to match.
                     dest: '../',
                    },
               ]
            }
        },

        'ftp-deploy': {
          build: {
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
              'sftpCache.json'
            ]
          }
        },


    });

    grunt.loadNpmTasks('grunt-ftp-deploy');
    grunt.loadNpmTasks('grunt-sftp-deploy');
    grunt.loadNpmTasks('grunt-contrib-compress');

    //grunt.registerTask('default', ['ftp-deploy']);


};


