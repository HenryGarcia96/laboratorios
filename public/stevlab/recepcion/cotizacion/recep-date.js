//var recogerDatos = function(){
   // var nombre = document.getElementById("nombre").value;
   //var observaciones = document.getElementById("observaciones").value;
   // var listEmpresas = document.getElementById('listEmpresas').value;
   // var precios = document.getElementById('listEstudios').value;
    
   // console.log(nombre,listEmpresas, observaciones, precios);

    //window.location.reload();
//}


var recogerDatos = document.getElementById('recogerDatos');

recogerDatos.addEventListener('submit', function(e){
    //e.preventDefault();
    //console.log('Me diste un click ');

    var data = new FormData(recogerDatos)
    //console.log(data);

    fetch('../prue_pdf',{
        method: 'POST',
        body: data
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
    })
});