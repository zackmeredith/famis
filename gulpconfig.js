// ==== CONFIGURATION ==== //

// Project paths
var project     = 'loyno-famis'
  , src         = './src/'
  , build       = './build/'
  , dist        = './dist/'+project+'/'
  , bower       = './bower_components/'
  , composer    = './vendor/'
;

// Project settings
module.exports = {

  bower: {
    normalize: { // Copies `normalize.css` from `bower_components` to `src/scss` and renames it to allow for it to imported as a Sass file
      src: bower+'normalize.css/normalize.css'
    , dest: src+'scss/base'
    , rename: '_normalize.scss'
    },
    basscss: {
      src: bower+'basscss/css/basscss.css'
    , dest: src+'scss/base'
    , rename: '_basscss.scss'
    }
  },

  browsersync: {
    files: [build+'/**', '!'+build+'/**.map'] // Exclude map files
  , notify: false // In-line notifications (the blocks of text saying whether you are connected to the BrowserSync server or not)
  , open: false // Set to false if you don't like the browser window opening automatically
  , port: 9000 // Port number for the live version of the site; default: 3000
  , proxy: 'wp:8888' // Using a proxy instead of the built-in server as we have server-side rendering to do via WordPress
  , ghostMode: {
          scroll: true
        }
  , watchOptions: {
      debounceDelay: 1000 // Delay for events called in succession for the same file/event
    }
  },


  images: {
    build: { // Copies images from `src` to `build`; does not optimize
      src: src+'**/*(*.png|*.jpg|*.jpeg|*.gif|*.svg)'
    , dest: build
    }
  , dist: {
      src: [dist+'**/*(*.png|*.jpg|*.jpeg|*.gif|*.svg)', '!'+dist+'screenshot.png']
    , imagemin: {
        optimizationLevel: 7
      , progressive: true
      , interlaced: true
      }
    , dest: dist
    }
  },

  scripts: {
    bundles: { // Bundles are defined by a name and an array of chunks to concatenate; warning: it's up to you to manage dependencies!
      core: ['core']
    , pg8: ['pg8', 'core']
    }
  , chunks: { // Chunks are arrays of globs matching source files that combine to provide specific functionality
      core: [ bower+'slick-carousel/slick/slick.js', src+'js/reveal.js', src+'js/core.js']
      , pg8: [ bower+'html5-history-api/history.js', bower+'wp-ajax-page-loader/wp-ajax-page-loader.js', src+'js/page-loader.js']
    }
  , dest: build+'js/' // Where the scripts end up
  , lint: {
      src: [src+'js/**/*.js'] // Lint core scripts (for everything else we're relying on the original authors)
    }
  , minify: {
      src: [build+'js/**/*.js', '!'+build+'js/**/*.min.js'] // Avoid recursive min.min.min.js
    , rename: { suffix: '.min' }
    , uglify: {}
    , dest: build+'js/'
    }
  , namespace: 'wp-' // Script filenames will be prefaced with this (optional; leave blank if you have no need for it but be sure to change the corresponding value in `src/inc/assets.php`)
  },

  styles: {
    build: {
      src: [src+'scss/*.scss', '!'+src+'scss/_*.scss'] // Ignore partials
    , dest: build
    }
  , dist: {
      src: [dist+'**/*.css', '!'+dist+'**/*.min.css']
    , minify: { keepSpecialComments: 1, roundingPrecision: 3 }
    , dest: dist
    }
  , compiler: 'libsass' // Sass compiler
  , autoprefixer: { browsers: ['> 3%', 'last 2 versions', 'ie 9', 'ios 6', 'android 4'] }
  , rename: { suffix: '.min' }
  , minify: { keepSpecialComments: 1, roundingPrecision: 3 }
  , rubySass: { // Requires the Ruby implementation of Sass; run `gem install sass` if you use this; Compass is not included by default
      loadPath: bower // Adds the `bower_components` directory to the load path so you can @import directly
    , precision: 6
    , 'sourcemap=none': true // Not yet ready for prime time; Sass 3.4 has srcmaps on by default but this causes some problems in the Gulp toolchain
  }
  , libsass: { // Requires the libsass implementation of Sass
      includePaths: [bower] // Adds the `bower_components` directory to the load path so you can @import directly
    , precision: 6
    }
  },

  theme: {
    lang: {
      src: src+'languages/**/*' // Glob matching any language files you'd like to copy over
    , dest: build+'languages/'
  }
  , php: {
      src: src+'**/*.php'
    , dest: build
  }
  , twig: {
      src: src+'views/**/*.twig'
    , dest: build+'views/'
  }
  , fonts: {
      src: src+'fonts/**'
    , dest: build+'fonts/'
  }
  },

  utils: {
    clean: [build+'**/.DS_Store'] // A glob matching junk files to clean out of `build`
    , wipe: [dist] // Clean this out before creating a new distribution copy
  , dist: {
      src: [build+'**/*', '!'+build+'**/*.min.css']
    , dest: dist
    }
  },

  watch: { // What to watch before triggering each specified task
    src: {
      styles:        src+'scss/**/*.scss'
    , scripts:       [src+'js/**/*.js', bower+'**/*.js']
    , images:        src+'**/*(*.png|*.jpg|*.jpeg|*.gif)'
    , theme:         [src+'**/*.php', src+'views/**/*.twig']
    , browsersync:   [build+'**/*']
    }
  , watcher: 'browsersync' // Who watches the watcher? BrowserSync ('browsersync')
  }
}
