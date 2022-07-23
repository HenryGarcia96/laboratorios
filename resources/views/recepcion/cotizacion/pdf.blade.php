<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cotizacion</title>

<style>
  html{
    margin: 1px;
  }
  body{
    background-position: center center;  */
		background-attachment: fixed; 
		background-size: 796px 561px; 
		/* width: 780px; */
		/* object-fit: contain; */
		opacity: 0.9;
		background-color: #f8f9fa;
		color: #272b41;
		font-family: "Poppins",sans-serif;
		font-size: 0.9375rem;
		height: 100%;
		overflow-x: hidden;
  }
  table,td  {
    text-align: center;
		border: 1px solid #000;
    border-collapse: collapse;
		/* Alto de las celdas */
		height: 30px;
		font-size: 12px;
    width: 80%;
    margin: 0 auto; 
    
		}
    img{
      display: block;
      margin-left: 550px;
      margin-right: 70%;
      width: 30%;
    }
    .lab,p{
      position: absolute; top: 0px; left: 0px;

    }
    
</style>

</head>
<body>

  <div>
    <img style="margin-right: 10px;" src="http://laboratorio.test/storage/app/{{$empresa}}" alt="">
  </div>
  
  <div class="lab">
    <P><b> LABORATORIO IXTLAHUACA </b> <br>
      VICENTE GUERRERO 102, IXTLAHUACA CENTRO, MEXICO <br>
      Tel: 54578411 Email:lab_cemi102@hotamil.com</P>
  </div>
<br><br><br>
<div>
  <label for="">Paciente: </label>{{$nombre}}<br>

  
</div>
<br>

<table>
  <thead>
    <tr>
      <th>Clave</th>
      <th>Descripcion</th>
      <th>Costo</th>
      <th>Dias</th>
      <th>Condiciones</th>
      
    </tr>
  </thead>

  <tbody>
    <tr>
      <td style="width: 13%; text-align: center;">DOC1</td>
      <td style="width: 60%; text-align: left;">Hemoglobina Glucocilada	</td>
      <td style="width: 13%; text-align: center;">$150.00</td>
      <td style="width: 5%; text-align: center;">2</td>
      <td>Ayuno entre 8-12 horas</td>
    </tr>
    
  </tbody>
</table>
<br>
<label for="">Total: </label>$150.00 <br>
<label for="">Observaciones: </label>{{$observaciones}}
<label for=""></label>
</body>
</html>