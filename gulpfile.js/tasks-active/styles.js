// ==== STYLES ==== //

var gulp          = require('gulp')
  , gutil         = require('gulp-util')
  , plugins       = require('gulp-load-plugins')({ camelize: true })
  , config        = require('../../gulpconfig').styles
  , autoprefixer  = require('autoprefixer-core')
  , rucksack      = require('gulp-rucksack')
  , lost          = require('lost')
;

// Build stylesheets from source Sass files, autoprefix, and make a minified copy (for debugging) with libsass
gulp.task('styles-libsass', function() {
  return gulp.src(config.build.src)
  // .pipe(plugins.sourcemaps.init())
    .pipe(plugins.sass(config.libsass))
    .pipe(rucksack())
    .pipe(plugins.postcss([
        lost(),
        autoprefixer(config.autoprefixer)
    ]))
  .pipe(plugins.sourcemaps.write()) // Write internal sourcemap
  .pipe(gulp.dest(config.build.dest)) // Drops the unminified CSS file into the `build` folder
  .pipe(plugins.rename(config.rename))
  .pipe(plugins.sourcemaps.init())
    .pipe(plugins.minifyCss(config.minify))
  .pipe(plugins.sourcemaps.write('./')) // Write external sourcemap
  .pipe(gulp.dest(config.build.dest)); // Drops a minified CSS file into the `build` folder for debugging
});

// Copy stylesheets from the `build` folder to `dist` and minify them along the way
gulp.task('styles-dist', ['utils-dist'], function() {
  return gulp.src(config.dist.src)
  .pipe(plugins.sourcemaps.init())
    .pipe(plugins.minifyCss(config.minify))
  .pipe(plugins.sourcemaps.write('./')) // Write external sourcemap
  .pipe(gulp.dest(config.dist.dest));
});

// Easily configure the Sass compiler from `/gulpconfig.js`
gulp.task('styles', ['styles-'+config.compiler]);
