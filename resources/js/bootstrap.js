try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('overlayscrollbars');
    require('../../vendor/almasaeed2010/adminlte/dist/js/adminlte');
    require('datatables.net');
    require('datatables.net-bs4');
    require('bootstrap');
} catch (e) {
    console.error(e);
}
