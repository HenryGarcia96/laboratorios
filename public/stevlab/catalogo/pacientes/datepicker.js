$(function() {
    'use strict';
  
    if($('#vigencia-fin').length) {
      var date = new Date();
      var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
      $('#vigencia-fin').datepicker({
        format: "dd/mm/yyyy",
        todayHighlight: true,
        autoclose: true
      });
      $('#vigencia-fin').datepicker('setDate', today);

    }
    if($('#vigencia-inicio').length) {
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('#vigencia-inicio').datepicker({
          format: "dd/mm/yyyy",
          todayHighlight: true,
          autoclose: true
        });
        $('#vigencia-inicio').datepicker('setDate', today);
      }
      if($('#fecha-nacimiento').length) {
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('#fecha-nacimiento').datepicker({
          format: "dd/mm/yyyy",
          todayHighlight: true,
          autoclose: true
        });
        $('#fecha-nacimiento').datepicker('setDate', today);
      }
  });