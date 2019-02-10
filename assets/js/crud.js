require('../../node_modules/select2/dist/js/select2.min.js');
require('../../node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
require('../../node_modules/trumbowyg/dist/trumbowyg.min.js');

import icons from 'trumbowyg/dist/ui/icons.svg';

$('.select-popup').select2({
  placeholder: 'Select an option',
  "element": HTMLOptionElement

});


$('.datepicker').datepicker({
  format: "mm/yyyy",
  startView: 1,
  minViewMode: 1,
  maxViewMode: 3,
  todayHighlight: true
});

$('.datepicker-full').datepicker({
  todayHighlight: true,
});

$.trumbowyg.svgPath = icons;
$('.editable').trumbowyg();
