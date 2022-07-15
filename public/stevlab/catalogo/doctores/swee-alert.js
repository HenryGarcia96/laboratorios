$(function() {
    showSwal = function(type) {
        'use strict';
        if (type === 'mixin') {
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
            });
            
            Toast.fire({
              icon: 'success',
              title: 'Los datos se estan guardando, espere...'
            })
            
          }
     }
   });