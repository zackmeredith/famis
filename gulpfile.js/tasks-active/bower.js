// ==== BOWER ==== //

var gulp        = require('gulp')
  , plugins     = require('gulp-load-plugins')({ camelize: true })
  , config      = require('../../gulpconfig').bower
;

// This task is executed on `bower update` which is in turn triggered by `npm update`; use this to copy and transform source files managed by Bower
gulp.task('bower', ['bower-normalize', 'bower-basscss']);

// A hack used to get around Sass's inability to natively @import vanilla CSS; see: https://github.com/sass/sass/issues/556
gulp.task('bower-normalize', function() {
  return gulp.src(config.normalize.src)
  .pipe(plugins.changed(config.normalize.dest))
  .pipe(plugins.rename(config.normalize.rename))
  .pipe(gulp.dest(config.normalize.dest));
});

gulp.task('bower-basscss', function() {
  return gulp.src(config.basscss.src)
  .pipe(plugins.changed(config.basscss.dest))
  .pipe(plugins.rename(config.basscss.rename))
  .pipe(gulp.dest(config.basscss.dest));
});
