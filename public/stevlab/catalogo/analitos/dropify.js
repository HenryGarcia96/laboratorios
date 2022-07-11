$(function() {
    'use strict';
    
    $('#dropImagen').dropify({
        messages: {
            'default': 'Suelta una imagen o de click aquí',
            'replace': 'Arrastre y suelte o de click aquí para reeemplazar',
            'remove':  'Remvoer',
            'error':   'Ooops, algo salio mal.'
        },
        error: {
            'fileSize': 'El tamaño del archivo es demasiado grande ({{ value }} max).',
            'minWidth': 'El ancho de la imagen es muy pequeño ({{ value }}}px min).',
            'maxWidth': 'El alto de la imagen es muy grande ({{ value }}}px max).',
            'minHeight': 'El alto de la imagen es muy pequeño ({{ value }}}px min).',
            'maxHeight': 'El alto de la imagen es muy grande ({{ value }}px max).',
            'imageFormat': 'El formato no esta permitido, solo ({{ value }}).'
        }
    });
});