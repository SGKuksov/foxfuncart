'use strict';

const gulp = require('gulp');
const plumber = require('gulp-plumber');
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const mqpacker = require('css-mqpacker');
const browserSync = require('browser-sync').create();
const rename = require('gulp-rename');
const cleanCSS = require('gulp-cleancss');
const reload = browserSync.reload;
const del = require('del');
const gulpSequence = require('gulp-sequence');
const cache = require('gulp-cache');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');
const notify = require('gulp-notify');
var devUrl = "http://rocket/";

// ЗАДАЧА: Очистка папки сборки
gulp.task('clean', function () {
  return del([
      'assets/',
      'style.css'
    ]
  );
});

// ЗАДАЧА: Компиляция препроцессора
gulp.task('sass', function(){
  return gulp.src('src/scss/style.scss')         // какой файл компилировать (путь из константы)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sourcemaps.init())                                // инициируем карту кода
    .pipe(sass())                                           // компилируем SASS
    .pipe(postcss([                                         // делаем постпроцессинг
        autoprefixer({ browsers: ['last 2 version'] }),     // автопрефиксирование
        mqpacker({ sort: true }),                           // объединение медиавыражений
    ]))
    .pipe(sourcemaps.write())           // записываем карту кода как отдельный файл (путь из константы)
    .pipe(gulp.dest('./'))                  // записываем CSS-файл (путь из константы)
    .pipe(browserSync.stream())
    .pipe(rename('style.min.css'))                          // переименовываем
    .pipe(cleanCSS())                                       // сжимаем
    .pipe(gulp.dest('./'))
    .pipe(notify('scss build complete!'))
    .pipe(reload({ stream: true }));
});

// ЗАДАЧА: Копирование шрифтов
gulp.task('fonts', function () {
    return gulp.src('src/font/*.{ttf,woff,woff2,eot,svg}')
        .pipe(gulp.dest('assets/font'))
        .pipe(browserSync.stream());
});

// ЗАДАЧА: Копирование изображений
gulp.task('img', function () {
    return gulp.src('src/img/*.{gif,png,jpg,jpeg,svg}')
        .pipe(gulp.dest('assets/img'))
        .pipe(browserSync.stream());
});

// ЗАДАЧА: Конкатенация и углификация Javascript
gulp.task('js', function () {
  return gulp.src(
    [
      // список обрабатываемых файлов
      // 'src/js/slick/slick.min.js',                // подключение slick
      // 'src/js/easytabs/jquery.easytabs.min.js',   // подключение easytabs
      // 'src/js/waypoints/jquery.waypoints.min.js', // подключение waypoint
      'src/js/script.js',                               // подключение main
    ]
   ).pipe(plumber({ errorHandler: onError }))       // для отслеживания ошибок
    .pipe(concat('script.min.js'))                  // сшиваем несколько js
    .pipe(uglify())                                 // минимизируем js
    .pipe(gulp.dest('./assets/js'))                  // положим готовый файл
    .pipe(notify('JS build complete!'))
    .pipe(reload({ stream: true }));                // перезагрузим сервер
});

// ЗАДАЧА: Локальный сервер, слежение
gulp.task('serve', ['build'], function() {
  browserSync.init({
    proxy: devUrl,
    // open: false,
    port: 8080
  });

  // следим за JS
  gulp.watch('src/js/*.js', ['js']);
  // следим за SASS
  gulp.watch('src/scss/*.scss', ['sass']);
  // следим за FONT
  gulp.watch('src/font/*', ['fonts']);
  // следим за IMG
  gulp.watch('src/img/**/*', ['img']);
  // следим за PHP
  gulp.watch("**/*.php").on('change', browserSync.reload);
  // следим за TWIG
  gulp.watch("**/*.twig").on('change', browserSync.reload);

});

// ЗАДАЧА: Задача по умолчанию
gulp.task('default', ['serve']);

// ЗАДАЧА: Сборка
gulp.task('build', function (callback) {
  gulpSequence(
    'clean',
    'sass',
    'js',
    'fonts',
    'img',
    callback
  );
});

// Уведомления об ошибках
var onError = function(err) {
    notify.onError({
      title: "Error in " + err.plugin,
    })(err);
    this.emit('end');
};
