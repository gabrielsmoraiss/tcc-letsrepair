var gulp = require('gulp');
var less = require('gulp-less');
var LessPluginAutoPrefix = require('less-plugin-autoprefix');
var minifyCss = require('gulp-minify-css');
var plumber = require('gulp-plumber');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var rename = require("gulp-rename");
var notify = require("gulp-notify");
var copy = require("gulp-copy");

var stream = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var browserify = require('browserify');
var stringify = require('stringify');
var argv = require('yargs').argv;

var lessPath = 'resources/assets/less';
var jsPath = 'resources/assets/js/src';
var cssDest = 'public/assets/css';
var jsDest = 'public/assets/js';

var autoprefix = new LessPluginAutoPrefix({
  browsers: ["last 2 versions"]
});

gulp.task('browserify', function() {
  var fileName = '/app.js';

  var bundler = browserify(jsPath + fileName);

  bundler
    .transform(stringify(['.html']))
    .bundle()
    .on('error', function(err) {
      console.log(err.toString());
      this.emit("end");
    })
    .pipe(stream(fileName.replace('/', '')))
    .pipe(gulp.dest(jsDest))
    .pipe(buffer())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(sourcemaps.init())
    .pipe(uglify())
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(jsDest))
    .pipe(notify('Browserify is done.'));
});

gulp.task('js', function() {
  var src = jsPath + '/app*.js';
  var fileName = 'app.js';

  gulp.src([
      jsPath + '/functions.js',
      src
    ])
    .pipe(plumber())
    .pipe(concat(fileName))
    .pipe(gulp.dest(jsDest))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(sourcemaps.init())
    .pipe(uglify())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(jsDest))
    .pipe(notify('Build de Javascript finalizada #choraJaveiro'));
});

gulp.task('copy', function() {
  gulp.src([
      'node_modules/bootstrap/fonts/*',
      'node_modules/font-awesome/fonts/*'
    ])
    .pipe(copy('public/assets/fonts', {
      prefix: 3
    }))
});

gulp.task('css', function() {
  gulp.src('resources/assets/less/app/style.less')
    .pipe(less({
      plugins: [autoprefix]
    }))
    .pipe(plumber())
    .pipe(rename('style.min.css'))
    .pipe(gulp.dest(cssDest))
    .pipe(notify("Build de CSS finalizada"));
});

gulp.task('libs', function() {
  gulp.src([
      'node_modules/jquery/dist/jquery.js',
      'node_modules/bootstrap/dist/js/bootstrap.js',
      'node_modules/datatables/media/js/jquery.dataTables.js',
      'node_modules/datatables-bootstrap3-plugin/media/js/datatables-bootstrap3.js',
      'node_modules/selectize/dist/js/standalone/selectize.js',
    ])
    .pipe(concat('libs.js'))
    .pipe(gulp.dest(jsDest))
    .pipe(rename('libs.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest(jsDest))
    .pipe(notify("Libs finalizado!"));
});

gulp.task('default', ['browserify', 'css', 'libs']);

gulp.task('watch', ['browserify', 'css', 'libs'], function() {
  gulp.watch(lessPath + '/app/**/*.less', ['css']);
  gulp.watch(jsPath + '/**/*.js', ['browserify']);
  gulp.watch(jsPath + '/libs.js', ['libs']);
});
