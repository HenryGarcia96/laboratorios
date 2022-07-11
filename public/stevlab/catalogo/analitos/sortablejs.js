$(function() {
  'use strict';


  // Simple list example
  if ($("#analitos-list").length) {
    var simpleList = document.querySelector("#analitos-list");
    new Sortable(simpleList, {
      multiDrag: true,
      selectedClass: 'selected', 
      fallbackTolerance: 3,
      animation: 150,
      // ghostClass: 'bg-light'
    });
  }

});