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

const sass = require('gulp-ruby-sass');

gulp.task('css', function () {
  return gulp.src([
                  'src/css/style.css', 
                  'node_modules/bootstrap-multiselect/dist/css/bootstrap-multiselect.css', 
                  "node_modules/bootstrap-select/dist/css/bootstrap-select.css",
                  'src/css/lk.css'
                ])
    .pipe(concatCss("lk.css"))
    .pipe(cleanCSS({compatibility: 'ie8', keepBreaks: true, 'target': "out/"}))
    .pipe(gulp.dest('./dist/'));
});


gulp.task('scripts', function() {
  return gulp.src([
                   'node_modules/bootstrap-multiselect/dist/js/bootstrap-multiselect.js', 
                   "node_modules/bootstrap-select/dist/js/bootstrap-select.js",
                   "node_modules/bootstrap-select/dist/js/i18n/defaults-de_DE.js",
                   "src/js/bootstrap.modal.js",
                   'src/js/javascript.js'
                 ])
    .pipe(concat('javascript.js'))
    .pipe(strip())
    .pipe(gulp.dest('./dist/'));
});

gulp.task('sass', () =>
    sass('src/sass/lk.scss')
        .on('error', sass.logError)
        .pipe(gulp.dest('src/css/'))
);



gulp.task('build', ['scripts', 'sass', 'css'], function() {
  
});