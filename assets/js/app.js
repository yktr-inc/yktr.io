require('../scss/app.scss');
const $ = require('jquery');
require('bootstrap');


$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});