<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Bloqueo</a>
        <a href="<?= base_url() ?>bloqueos" class="breadcrumb">Bloqueo</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>bloqueos/nuevo" method="post">
        <div class="row">
			<select id="misdoc" name="misdoc" required>
                    	<option value="" disabled selected>Seleccionar Cliente</option>
                    <?php foreach ($misdoc as $row): ?>
                        <option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
                    <?php endforeach; ?>
            </select>
            <div class="input-field col s12">
                <input id="descripcion" maxlength="100" type="text" name="descripcion" class="validate">
                <label class="active" for="descripcion">Numero de documento</label> 
            </div>
			<div class="input-field col s12">
                <input class="btn-small" type="submit" onclick="bloqueo()" value="Bloqueo">
            </div>
        </div>
    </form>
</div>
        


<div id="modalBloqueos" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 class="left">Bloqueos</h4>
        <input type="hidden" id="acuerdo_id_periodo" >
        <div class="section">
            <table class="striped" style="font-size: 12px;">
                <thead class="blue-grey darken-1" style="color: white">
                    <tr>
						<th class="left-align" >MOTIVO BLOQUEO</th>
                        <th class="center-align">USUARIO </th>          
                        <th class="center-align">FECHA</th>
                    </tr>
                </thead>

				<tbody  id="cuerpoBloqueo">
					<form action="<?= base_url() ?>bloqueos/bloquear" method="post">
						<tr>
							<th class="right-align">
								<div class="input-field col s12 m6 l4">
									<input id="motivo_bloqueo" maxlength="200" type="text" name="motivo_bloqueo" class="validate">
									<label class="" for="motivo_bloqueo" style="font-weight:100" >Motivo bloqueo</label> 
								</div> 
							</th>
							<th class="center-align" name="user_block"> 
							<select id="bloqueo" name="bloqueo" required>
								<option value="" disabled selected>Seleccionar Usuario</option>
								<?php foreach ($listPersonas as $row): ?>
									<option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
								<?php endforeach; ?>
							</select>
							
							</th>          
							<th class="center-align" name="date_block">FECHA</th>

						</tr>

						<button style="position:relative; top:340px; right:125px" type="submit" class="btn btn-right"> bloquear</button>
					
					</form>
                </tbody>
			
            </table>
			
        </div>
    </div>

	
    <div class="modal-footer">
        <a href="#!" class=" waves-effect waves-green btn-flat">Aceptar</a>
    </div>
</div>


<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="center-align">CLIENTE</th>
                <th class="left-align">APELLIDOS</th>
                <th class="left-align">EMPRESA</th>
                <th class="left-align">MOTIVO BLOQUEO</th>
            </tr>
        </thead>
        <tbody id="resultados">   
				<tr>
					<td class="left-align">Naranjas</td>

					<td class="left-align">Tocatext </td>
					<td class="left-align"> <input type="text" placeholder="Ingrese motivo del bloqueo"> </td>
					<td class="center-align">Alberto</td>
								
				</tr>
							
                    </tbody>
    </table>
	<div class="input-field col s12" style="text-align: center">
        <input class="btn-small" type="submit" value="Grabar">
    </div>
</div>

<script>

function bloqueo($bloqueo)
    {
		//console.log('Se bloqueara usuario ');
		$('#modalBloqueos').modal('open');
		

     //  if($cerrado > 0)
     //   {
     //       $('#btnAgregarPeriodo').css({'display': 'none'});
     //   }else{
        //    $('#btnAgregarPeriodo').css({'display': 'block'});
     //   }
        
  //    $('.preloader-background').css({'display': 'block'});
   //   $('#acuerdo_id_periodo').val($bloqueo)
        /*let url = 'api/execsp';
        let sp = 'ALQUILER_DETALLE_LIS';
        let empresa = $empresa;
        let acuerdo = $acuerdo;
        data = {sp, empresa, acuerdo};
        
        $('#periodos').html('');
        fetch(url, {
                    method: 'POST', // or 'PUT'
                    body: JSON.stringify(data), // data can be `string` or {object}!
                    headers:{
                        'Content-Type': 'application/json'
                        }
                    })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) 
        {
            $('#total').html(data.length);
         
            for (let index = 0; index < data.length; index++) {
                const element = data[index];

                let $eliminar = `<i class="material-icons" style="color: #999999">delete</i>`
                if(element.ALQDET_C_SITUACION == '0')
                {
                    $eliminar = `<i class="material-icons" style="cursor: pointer;" onclick="modalEliminar('2', '${element.EMPRES_N_ID}-${element.ALQUIL_N_ID}-${element.ALQDET_N_ID}')">delete</i>`
                }else if(element.ALQDET_C_SITUACION == '1'){
                    $situacion = `<i class="material-icons">assignment_turned_in</i>`
                }
                
                $('#periodos').append(`   
                                        <tr>
                                            <td class="center-align">${element.ALQDET_N_ID}</td>
                                            <td class="center-align">${element.ALQDET_C_FECHA_INICIO}</td>
                                            <td class="center-align">${element.ALQDET_C_FECHA_FINAL}</td>
                                            <td class="right-align">${element.ALQDET_N_AREA}</td>
                                            <td class="right-align">${element.ALQDET_N_PRECIO_UNIT}</td>
                                            <td class="right-align">${element.TOTAL}</td>
                                            <td class="center-align">${element.ALQDET_C_SITUACION_DES}</td>
                                            <td class="center-align">
                                                ${$eliminar} 
                                            </td>
                                        </tr>
                                    `);
            }
            $('#modalPeriodos').modal('open');
            $('.preloader-background').css({'display': 'none'});                            
        });*/
    }


</script>
