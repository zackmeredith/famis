// ==== THEME ==== //

var gulp        = require('gulp')
  , plugins     = require('gulp-load-plugins')({ camelize: true })
  , config      = require('../../gulpconfig').theme
;

// Copy PHP source files to the `build` folder
gulp.task('theme-php', function() {
  return gulp.src(config.php.src)
  .pipe(plugins.changed(config.php.dest))
  .pipe(gulp.dest(config.php.dest));
});

// Copy Twig source files to the `build` folder
gulp.task('theme-twig', function() {
  return gulp.src(config.twig.src)
  .pipe(plugins.changed(config.twig.dest))
  .pipe(gulp.dest(config.twig.dest));
});

// Copy Font source files to the `build` folder
gulp.task('theme-fonts', function() {
  return gulp.src(config.fonts.src)
  .pipe(plugins.changed(config.fonts.dest))
  .pipe(gulp.dest(config.fonts.dest));
});

// Copy everything under `src/languages` indiscriminately
gulp.task('theme-lang', function() {
  return gulp.src(config.lang.src)
  .pipe(plugins.changed(config.lang.dest))
  .pipe(gulp.dest(config.lang.dest));
});

// All the theme tasks in one
gulp.task('theme', ['theme-lang', 'theme-php', 'theme-twig', 'theme-fonts']);
