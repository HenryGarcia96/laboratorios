$(function() {
  'use strict';

  if($('#selectInicio').length) {
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('#selectInicio').datepicker({
      format: "mm/dd/yyyy",
      todayHighlight: true,
      autoclose: true
    });
    $('#selectInicio').datepicker('setDate', today);
  }
});

$(function(){
  if($('#selectFinal').length) {
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('#selectFinal').datepicker({
      format: "mm/dd/yyyy",
      todayHighlight: true,
      autoclose: true
    });
    $('#selectFinal').datepicker('setDate', today);
  }
})