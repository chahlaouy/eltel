
import '../css/app.scss'

window.$ = window.jQuery = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');
require('admin-lte')
// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $("#btn-minute").click(function(){
        $("#p-minute").toggle();
      });
    $("#btn-app").click(function(){
        $("#p-app").toggle();
      });
});


