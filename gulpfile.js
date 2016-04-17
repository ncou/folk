'use strict';

const gulp      = require('gulp'),
      stylecow  = require('gulp-stylecow'),
      rename    = require('gulp-rename'),
      path      = require('path'),
      requirejs = require('requirejs'),
      del       = require('del'),
      bower     = path.join(__dirname, 'bower_components');

gulp.task('css', function() {
    let config = require('./stylecow.json');

    config.files.forEach(function (file) {
        gulp
            .src(file.input)
            .pipe(stylecow(config))
            .pipe(rename(file.output))
            .pipe(gulp.dest(''));
    });
});

gulp.task('js', function(done) {
    del.sync(path.join('assets/js/vendor'));

    [
        ['ckeditor', '**/*'],
        ['codemirror', '**/*'],
        ['handsontable', 'dist/**/*'],
        ['jquery', 'dist/jquery.js'],
        ['jquery-lazyscript', '*.js'],
        ['magnific-popup', 'dist/*.js'],
        ['microplugin', 'src/**/*'],
        ['requirejs', '*.js'],
        ['selectize', 'dist/js/*'],
        ['sifter', '*.js'],
        ['typeahead.js', 'dist/**/*'],
    ].forEach(function (module) {
        gulp
            .src(path.join(bower, module[0], module[1]))
            .pipe(gulp.dest(path.join('assets/js/vendor', module[0])))
    });
});

gulp.task('img', function (done) {
    del.sync(path.join('assets/icons'));

    gulp
        .src(path.join(bower, 'material-design-icons/**/production/*_24px.svg'))
        .pipe(gulp.dest('assets/icons', done))
        .on('end', done);
});

gulp.task('default', ['css', 'js', 'img']);
