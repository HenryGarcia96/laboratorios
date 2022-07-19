<style>
    table, th, td{
        width: 100%;
        border: 1px solid;
        border-collapse: collapse;
        text-align: center;
        padding: 5px;
    }

    
</style>

<table>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Empresa</th>
        <th>Observaciones</th>
        <th>Estudios</th>
        <th>Total</th>
        
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>{{$nombre}}</td>
        <td>{{$empresa}}</td>
        <td>{{$observaciones}}</td>
        <td>{{$listEstudio}}</td>
        <td>$00,00</td>
      </tr>
      
    </tbody>
  </table>
