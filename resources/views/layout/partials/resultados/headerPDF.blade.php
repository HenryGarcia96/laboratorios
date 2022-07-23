<div class="header separador-bottom">
    {{-- Data del laboratorio o empresa --}}
    <table>
        <tbody>
            <tr>
                <td class="col-resize-max">
                    {{$laboratorio->nombre}} - {{$laboratorio->razon_social}}
                </td>
                <td class="col-resize-min">
                    <img src="{{base64_encode('/public/storage/logotipos/labs.png')}}" alt="">
                </td>
            </tr>
            
        </tbody>
    </table>
    <table>
        <tr>
            <td class="col-left">
            </td>
            <td class="col-center">
                {{$sucursal->sucursal}}
            </td>
            <td class="col-right">
        </tr>
    </table>
    {{-- Data del folio y paciente --}}
    <table>
        <tr>
            <td class="col-left">
                <br>
                <strong>Folio: </strong>{{$folios->folio}}
                <br>
                <strong>Fecha de impresión: </strong> {{Date("d/m/Y h:i A") }}
            </td>
            <td class="col-center">
                <br>
                <strong>Nombre del paciente: </strong>{{$paciente->nombre}} {{$paciente->ap_paterno}} {{$paciente->ap_materno}}
            </td>
            <td class="col-right">
                <br>
                <img src="{{base64_encode('/public/storage/logotipos/labs.png')}}" alt="">
            </td>
        </tr>
    </table>
</div>

