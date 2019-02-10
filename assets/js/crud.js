require('../../node_modules/select2/dist/js/select2.min.js');
require('../../node_modules/medium-editor/dist/js/medium-editor.min.js');
require('../../node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');

$('.select-popup').select2({
  placeholder: 'Select an option',
  "element": HTMLOptionElement

});

if(document.getElementById('editable')){
  let editor = new MediumEditor('#editable');
}

$('.datepicker').datepicker({
  todayHighlight: true,
  format: "mm/yyyy",
  startView: 1,
  minViewMode: 1,
  maxViewMode: 3,
  todayHighlight: true
});
