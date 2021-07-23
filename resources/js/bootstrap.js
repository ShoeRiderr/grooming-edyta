/**
 * Import dayjs library with locale in application.
 */
import 'dayjs/locale/pl';
import dayjs from 'dayjs';

window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

dayjs.locale('pl');

window.dayjs = dayjs;