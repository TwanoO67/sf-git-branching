'use strict';

module.exports = function (grunt) {

  grunt.initConfig({

    //prendre des screenshot locaux
    autoshot: {
        default_options: {
          options: {
            // necessary config
            path: "web/images/screenshots/",
            // optional config, must set either remote or local
            remote: {
              files: [
              //  { src: REMOTE_SITE_URL, dest: FILENAME(INCLUDE FILE TYPE), delay: DELAY_MILLISECOND }
              ]
            },
            local: {
              path: "web",
              port: 8000,
              files: [
                { src: "app_dev.php/depot/1#!/status", dest: "index.png", delay: 200 }
              ]
            },
            viewport: ['1024x768', '500x500']
          },
        },
      },


  });

  grunt.registerTask('default', ['php']);

  require('load-grunt-tasks')(grunt);
  require('./grunt/connect')(grunt);
  require('./grunt/watch')(grunt);
  require('./grunt/clean')(grunt);
  require('./grunt/copy')(grunt);
  require('./grunt/shell')(grunt);
  require('./grunt/uglify')(grunt);
  require('./grunt/sass')(grunt);

  grunt.registerTask('default', ['build']);

  grunt.registerTask('build', ['clean', 'sass:prod', 'uglify', 'copy', 'shell:assetic']);

  grunt.registerTask('serve', function (env) {

    if (env === 'prod') {
      grunt.task.run(['clean', 'sass:prod', 'uglify', 'copy', 'shell:assetic', 'php:prod', 'watch']);
    } else {
      grunt.task.run(['clean', 'sass:dev', 'copy', 'php:dev', 'watch']);
    }

  });

  grunt.loadNpmTasks('grunt-autoshot');
};
