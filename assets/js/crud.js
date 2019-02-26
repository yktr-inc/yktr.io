require('../../node_modules/select2/dist/js/select2.min.js');
require('../../node_modules/trumbowyg/dist/trumbowyg.min.js');

const flatpickr = require("flatpickr");

import icons from 'trumbowyg/dist/ui/icons.svg';

flatpickr(".month", {
    dateFormat: "m/Y",
    allowInput: true,
    altInput: true,
});

flatpickr(".full-datepicker", {
    dateFormat: "d/m/Y H:i",
    enableTime: true,
    allowInput: true,
    time_24hr: true
});

$('.select-popup').select2({
    placeholder: "Select a state",
    allowClear: true
});

$.trumbowyg.svgPath = icons;
$('.editable').trumbowyg();


// setup an "add a tag" link
var $addTagLink = $('<a href="#" class="btn btn-sm btn-primary">Add a step</a>');
var $newLinkLi = $('<li class="list"></li>').append($addTagLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
   var $collectionHolder = $('ul.steps');
    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addTagLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addTagForm($collectionHolder, $newLinkLi);
    });

});

function addTagForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormLi.append('<a href="#" class="btn btn-sm btn-danger remove-tag">Remove step</a>');

    $newLinkLi.before($newFormLi);

    $('.full-datepicker').flatpickr({
    dateFormat: "d/m/Y H:i",
    enableTime: true,
    allowInput: true,
    altInput: true,
    time_24hr: true
});

    // handle the removal, just for this example
    $('.remove-tag').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}
