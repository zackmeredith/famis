// ==== ICONS ==== //

var gulp        = require('gulp')
  , svgSprite   = require('gulp-svg-sprite')
  , config      = require('../../gulpconfig').icons
;

gulp.task('sprite-page', function() {
  return gulp.src(config.svg.src)
    .pipe(svgSprite(config))
    .pipe(gulp.dest(config.mode.dest));
});

gulp.task('sprite-shortcut', function() {
  return gulp.src(config.mode.src)
    .pipe(gulp.dest(config.mode.dest));
});

gulp.task('icons', ['sprite-page', 'sprite-shortcut']);
