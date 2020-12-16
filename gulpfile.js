const { watch, src, dest, series, parallel, task } = require('gulp');
var gulp = require('gulp');
var merge = require('merge-stream');
const sass = require('gulp-sass');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');

gulp.task('sass', function() {
  var b4st = gulp.src('./theme/scss/b4st.scss') // Gets all files ending with .scss in app/scss and children dirs
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: 'expanded' })).on('error', sass.logError)
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./theme/css'))

  var editor = src('./theme/scss/editor.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: 'expanded' })).on('error', sass.logError)
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./theme/css'))

  return merge(b4st, editor);
})

gulp.task('watch', async function(){
  gulp.watch('./theme/scss/*/*.scss', gulp.series('sass'));
});

//exports.default = parallel(cssTask, watchFiles);
//exports.default = parallel(cssTask);
