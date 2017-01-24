/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var gulp = require('gulp');
var concatCss = require('gulp-concat-css');
var cleanCSS = require('gulp-clean-css');
var concat = require('gulp-concat');
var strip = require('gulp-strip-comments');
var sassUnicode = require('gulp-sass-unicode');
var watch = require('gulp-watch');
var minify = require('gulp-minify');
var scsslint = require('gulp-scss-lint');
const sass = require('gulp-ruby-sass');

var plugins = require('gulp-load-plugins')({
  scope: [
    'dependencies',
    'devDependencies'
  ]
});

gulp.task('css', function () {
  return gulp.src([
    'node_modules/bootstrap-multiselect/dist/css/bootstrap-multiselect.css',
    'node_modules/bootstrap-select/dist/css/bootstrap-select.css',
    'src/css/lk.css'
   ])
    .pipe(concatCss("lk.css", {rebaseUrls: false}))
    .pipe(sassUnicode())
    .pipe(cleanCSS({compatibility: 'ie8', keepBreaks: true, 'rebase': false, debug: true}, function(details) {
      console.log(details.name + ': ' + details.stats.originalSize);
      console.log(details.name + ': ' + details.stats.minifiedSize);
     }))
    .pipe(gulp.dest('./dist/'));
});

gulp.task('scripts', function() {
  return gulp.src([
    'node_modules/bootstrap-multiselect/dist/js/bootstrap-multiselect.js',
    'node_modules/bootstrap-select/dist/js/bootstrap-select.js',
    'node_modules/bootstrap-select/dist/js/i18n/defaults-de_DE.js',
    'node_modules/jquery.scrollto/jquery.scrollTo.js',
    'src/js/bootstrap.modal.js',
    'src/js/javascript.js',
    'src/js/vku-1.js'
  ])
  .pipe(concat('javascript.js'))
  .pipe(strip())
  .pipe(minify())
  .pipe(gulp.dest('./dist/'));
});

gulp.task('build', ['sass', 'scripts','css'], function() { });

gulp.task('help', function() {
  console.log('The list of available tasks:');
  plugins.taskListing();
});

// Install Ruby gem install scss_lint
gulp.task('scss-lint', function() {
  return gulp.src([
    'src/sass/*.scss',
    'src/sass/*/*.scss'
  ])
  .pipe(scsslint())
  .pipe(scsslint.failReporter());
});

gulp.task('sass', () =>
    sass('src/sass/lk.scss')
    .pipe(sassUnicode())
    .on('error', sass.logError)
    .pipe(gulp.dest('src/css/'))
);

gulp.task('watch', function() {
  gulp.watch('src/js/*.js', ['scripts']);
  gulp.watch(['src/sass/*.scss', 'src/sass/*/*.scss'], ['scss-lint', 'sass', 'css', 'css']);
});


gulp.task('default', ['help'], function() { });
