<style>
.modal { width: 75% !important ; height: 75% !important ; }
i.icon-white {
    color: #FFFFFF;
}
</style>

<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Ordenes de Servicio</a>
        <a href="#!" class="breadcrumb">Solicitud de Abastecimiento</a>
      </div>
    </div>
</nav>


<br>

<!--
<a class="waves-effect waves-light btn btn-small">Obras</a>
<a class="waves-effect waves-light btn btn-small">Abastecimiento</a>
-->
<div class="section container">

 <ul class="collapsible" style="width:100%">
    <li class="active">
      <div class="collapsible-header"><i class="material-icons left">chevron_right</i>Solicitados</div>
      <div class="collapsible-body"><table class="striped" id="tablalist">
        <thead>
            <tr>          
				<th>#</th>
				<th>Fecha</th>
                <th>Obra/Abastecimiento</th>
                <th>Ver</th>
            </tr>
        </thead>
        
        <tbody>
            <?php if($results): ?>
                <?php foreach($results as $row): ?> 
                    <tr >
                        <td><?=$row->SOLABAS_NUMERO?></td>
						<td><?=$row->SOLABAS_DATE?></td>
                        <td><?=$row->DESCRIPCION?></td>
                        <td><button class="waves-effect waves-light btn modal-trigger btn-small" href="#modal1" name="btnver" id="btnver" attr_soliabas_id="<?=$row->SOLABAS_N_ID?>" >Ver</button></td>
                    </tr>
                <?php endforeach; ?>  
            <?php endif; ?>
        </tbody>
        
    </table></div>
    </li>
	
<?php //if(isset($results2)): ?>
    <li>
      <div class="collapsible-header"><i class="material-icons left">chevron_right</i>En Proceso</div>
      <div class="collapsible-body">
	  
	  <table class="highlight" id="tableenproceso">
        <thead>
            <tr>          
				<th>#</th>
				<th>Fecha</th>
                <th>Obra/Abastecimiento</th>
                <th>Cotizacion</th>
                <th>Precio</th>
                <th>Completo</th>
                <th>Editar</th>
				<th></th>
            </tr>
        </thead>
        
        <tbody>
                <?php foreach($results2 as $row2): ?> 
                    <tr>
                        <td><?=$row2->SOLABAS_NUMERO?></td>
						<td><?=$row2->SOLABAS_DATE?></td>
                        <td><?=$row2->DESCRIPCION?></td>
						<?php 
						
						if($row2->SOLABAS_OPC1==1){
							$ruta="./uploads/".$row2->FILE1;
						}
						elseif($row2->SOLABAS_OPC1==2){
							$ruta="./uploads/".$row2->FILE2;
						}
						elseif($row2->SOLABAS_OPC1==3){
							$ruta="./uploads/".$row2->FILE3;
						}
						
						
						if(empty($row2->SOLABAS_PORCEN)){
							$vporcen = 0;
						}
						else
						{ 
							$vporcen = $row2->SOLABAS_PORCEN;
						}
						
						?>
						
                        <td>
						<a id="afile" href="<?= $ruta ?>" target="_blank" class="btn btn-small"><i class="material-icons icon-white">file_download</i></a>	
						<!--<a id="afile" href="<?= $ruta ?>" target="_blank"><img src="<?= $ruta ?>" id="arfile" width="42" height="42" /></a>	-->
						
						</td>
                        <td id="tdprecio_<?=$row2->SOLABAS_N_ID?>">
						<?php
						if(!empty($row2->SOLABAS_PRECIO))
						{
						
						echo $row2->SOLABAS_PRECIO;
						}
						else
						{
						?>
						<input type="hidden"  class="idsoliabas" id="idsoliabas" name="idsoliabas" value="<?=$row2->SOLABAS_N_ID?>" />
						<!--<input class="precio" type="text" id="precio_<?=$row2->SOLABAS_N_ID?>" name="precio" autocomplete="off" style="width:100px;" />--> <input class="precio" type="number" step="any" id="precio_<?=$row2->SOLABAS_N_ID?>" name="precio" autocomplete="off" style="width:100px;" />
						<button type="button" class='btn-floating btn-small' style="right:0px!important;bottom:0px!important;" id="btnpreciog_<?=$row2->SOLABAS_N_ID?>" name="btnpreciog" attr_idsoli_ver="<?=$row2->SOLABAS_N_ID?>" ><i class='material-icons'>check</i></button>
						<?php
						}
						?></td>
                        <td id="vporcen_<?=$row2->SOLABAS_N_ID?>" > <?= $vporcen." %" ?></td>
                        <td>
						<?php
						if(!empty($row2->SOLABAS_PRECIO))
						{
						?>			
						<?php if(!($session->USUARI_C_USERNAME=='MDiaz' or $session->USUARI_C_USERNAME=='ACuglievan')): ?>
						<button class="btn btn-floating btn-small modal-trigger" style="right:0px!important;bottom:0px!important;" href="#modal2" name="btnedit" id="btnedit_<?=$row2->SOLABAS_N_ID?>" attr_solabas_id="<?=$row2->SOLABAS_N_ID?>" <?php if($row2->SOLABAS_PORCEN==100) {  echo "disabled"; } ?>    ><i class="material-icons" >edit</i></button>
						<?php  endif; ?>	
						
						<?php
						}
						else
						{
						?>
						<?php if(!($session->USUARI_C_USERNAME=='MDiaz' or $session->USUARI_C_USERNAME=='ACuglievan')): ?>
						<button class="btn btn-floating btn-small modal-trigger" style="right:0px!important;bottom:0px!important;" href="#modal2" name="btnedit" id="btnedit_<?=$row2->SOLABAS_N_ID?>" attr_solabas_id="<?=$row2->SOLABAS_N_ID?>" disabled  ><i class="material-icons" disabled >edit</i></button>
						<?php endif; ?>	
						<?php } ?>	

						</td>
						<td>
						<?php if($session->USUARI_C_USERNAME=='ACuglievan'): ?>
						<button class="waves-effect waves-light btn btn-small" onclick="AprobarSolicitud(<?=$row2->SOLABAS_N_ID?>);" <?php if($row2->SOLABAS_OPC2==1) {  echo "disabled"; } ?> >APROBADO</button>
						<?php endif; ?>	
						</td>
                    </tr>
                <?php endforeach; ?>  
        </tbody>
    </table>
	<input type="hidden"  class="psoliabas" id="psoliabas" name="psoliabas" value="" />
    </li>
 <?php //endif; ?>	
 
    <li>
      <div class="collapsible-header"><i class="material-icons left">chevron_right</i>Culminados</div>
      <div class="collapsible-body">   
	  <table class="highlight" id="tableculminado">
        <thead>
            <tr>          
				<th>#</th>
				<th>Fecha</th>
                <th>Obra/Abastecimiento</th>
                <th>Precio</th>
				<th>Historico de Pago</th>
            </tr>
        </thead>
		
		 <tbody>
            <?php if($results3): ?>
                <?php foreach($results3 as $row3): ?> 
                    <tr >
                        <td><?=$row3->SOLABAS_NUMERO?></td>
						<td><?=$row3->SOLABAS_DATE?></td>
                        <td><?=$row3->DESCRIPCION?></td>
                        <td><?=$row3->SOLABAS_PRECIO?></td>
						<td><button class="btn btn-floating btn-small modal-trigger" style="right:0px!important;bottom:0px!important;" href="#modal3" name="btndetcul" id="btndetcul" attr_solabas_id="<?=$row3->SOLABAS_N_ID?>" ><i class="material-icons">description</i></button></td>
                    </tr>
                <?php endforeach; ?>  
            <?php endif; ?>
        </tbody>
		</table>
		</div>
    </li>
	
  </ul>



<!--Modal 1-->
<div id="modal1" class="modal">
    <div class="modal-content">
     <!--<center>--><h4 id="titulosolicitud" style="text-align: center">Solicitud</h4> <!--</center>-->
      <div class="section container center">
        <div class="row">
		
				
            <div class="input-field col s12 m6 l4">
				<div class="input-group date form_date col-md-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
				<input class="validate" size="16" type="text" id="fechav" name="fechav"  readonly>
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				</div>				
				<label class="active" for="fecha" >Fecha:</label>
            </div>
			
            <div class="input-field col s12 m6 l4">
				<div class="input-group date form_date col-md-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
				<input size="16" type="text" id="numerov" name="numerov" value="" readonly>
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				</div>				
				<label class="active" for="numero" >Numero:</label>				
            </div>
					
        </div>		
	
		<div class="form-group">
			<p class="text-center bgcolor">EMPRESA</p>
		</div>
			
		<div class="row">
		
		<div class="input-field col s12 m6 l3">
			<label>
			<input class="with-gap" name="empresa" type="radio" id="empresa1" value="1" disabled />
			<span>Bigote</span>
			</label>
		</div>
		
        <div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="empresa" type="radio" id="empresa2" value="2" disabled />
				<span>Lopud</span>
			</label>
		</div>
		
		
		<div class="input-field col s12 m6 l3">
			<label>
			<input class="with-gap" name="empresa" type="radio" id="empresa3" value="3" disabled />
			<span>AQP</span>
			</label>
		</div>
		
        <div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="empresa" type="radio" id="empresa4" value="4" disabled />
				<span>Choice</span>
			</label>
		</div>
		
		</div>
		
		<br>
		
		<div class="form-group">
			<p class="text-center bgcolor">TIPO </p>
		</div>
		
		
		<div class="row">
		
		 <div class="input-field col s12 m6 l3">
			<label>
			<input class="with-gap" name="tipo" type="radio" id="tipo1" value="1" disabled />
			<span>Obras</span>
			</label>
		</div>
		
        <div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="tipo" type="radio" id="tipo2" value="2" disabled />
				<span>Abastecimiento</span>
			</label>
		</div>
		<input type="hidden" name="tipoid" id="tipoid" />
		</div>
	
		<br>	
		
	<div id="divdepartamento" name="" class="" >
		<div class="form-group">
			<p class="text-center bgcolor">DEPARTAMENTO</p>
		</div>
		
		
		<div class="row">
		<div class="input-field col s12 m6 l3">
		
		<label>
				<input class="with-gap" name="departamento" type="radio" id="gg" disabled />
				<span>G.G.</span>
		</label>

		</div>
		
        <div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="departamento" type="radio" id="administracion" disabled />
				<span>Administracion</span>
		    </label>
        </div>
	
		
		
		<div class="input-field col s12 m6 l3">			
			<label>
				<input class="with-gap" name="departamento" type="radio" id="sistemas" disabled />
				<span>Sistemas</span>
		    </label>
        </div>
		
		<div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="departamento" type="radio" id="monitoreo" disabled />
				<span>Monitoreo</span>
		    </label>
		
		</div>
		
		<div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="departamento" type="radio" id="operarios" disabled />
				<span>Operarios</span>
		    </label>
		</div>
		
		<div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="departamento" type="radio" id="galmacen" disabled />
				<span>G. Almacen</span>
		    </label>
		</div>
		
		<div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="departamento" type="radio" id="operaciones" disabled />
				<span>Operaciones</span>
		    </label>
		</div>
		
		<div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="departamento" type="radio" id="seguridad" disabled />
				<span>Seguridad</span>
		    </label>
		</div>
		
		<div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="departamento" type="radio" id="rrhh" disabled />
				<span>RRHH</span>
		    </label>
        </div>
		
		<div class="input-field col s12 m6 l3">
		 <label>
				<input class="with-gap" name="departamento" type="radio" id="otros" disabled />
				<span>Otros</span>
				<input type="text" class="" id="otrosin" name="otrosin" disabled>
		 </label>
        </div>
		</div>			
	</div>
		
		<br>
		<br>
		<br>		

		<?php /*if(!isset($results2)):*/ ?>
		
		<div class="form-group"> 
			<p class="text-center bgcolor">DETALLE</p>
		</div>
		
		 <?php /*endif;*/ ?>
		 
		<form action="<?= base_url() ?>solicitudabastecimiento/autorizar"  method="post" >
		<?php// if(!isset($results2)): ?>
		<div class="form-group">
            <div class="col-md-12">
            
            <br>
            <br>
            <table id="tabledetalle" class="table table-striped table-bordered nowrap" > <!--style="width:100%"-->
            <tr>
            <th style="width: 300px;">Descripcion</th>
            <th style="width: 350px;">Cotizaciones</th>
            </tr>
            </thead>
			<tbody>
			<tr>
			<td><input type="text" class="" id="descrip" name="descrip" readonly  /></td>
			<td>
				<div class="row">

				<label style="padding:10px;">
				<?php if($session->USUARI_C_USERNAME=='MDiaz' or $session->USUARI_C_USERNAME=='ACuglievan'): ?> <input class="with-gap" name="rfile" type="radio" id="rfile1" value="1"  /><?php endif; ?>
				<span>
				<a id="afile1" href="" class="btn btn-small " target="_blank"><i class="material-icons icon-white">filter_1</i></a>
				
				
				<!--<a id="afile1" href="" target="_blank"><img src="" id="file1" width="42" height="42" /></a>-->
				
				</span>
				</label>

				<label style="padding:10px;">
				<?php if($session->USUARI_C_USERNAME=='MDiaz' or $session->USUARI_C_USERNAME=='ACuglievan'): ?> <input class="with-gap" name="rfile" type="radio" id="rfile2" value="2"  /><?php endif; ?>
				<span>
				<a id="afile2" href="" target="_blank" class="btn btn-small"><i class="material-icons icon-white">filter_2</i></a>
				
				<!--<a id="afile2" href="" target="_blank"><img src="" id="file2" width="42" height="42" /></a>-->
				
				</span>
				</label>
				
				<label style="padding:10px;">
				<?php if($session->USUARI_C_USERNAME=='MDiaz' or $session->USUARI_C_USERNAME=='ACuglievan'): ?><input class="with-gap" name="rfile" type="radio" id="rfile3" value="3"  /><?php endif; ?>
				<span>
				<a id="afile3" href="" target="_blank" class="btn btn-small"><i class="material-icons icon-white">filter_3</i></a>
				<!--<a id="afile3" href="" target="_blank"><img src="" id="file3" width="42" height="42" /></a>-->
				
				</span>
				</label>
				
				</div>	
			</td>
			</tbody>
            </table>
						
           </div>
         </div>
		 
		 <?php // endif; ?>
		 		
		<br>
		<br>
		<div>
		</div>
</div>

<div class="center" >
<input type="hidden" name="rfileid" id="rfileid" />
<input type="hidden" name="idsolabas" id="idsolabas" />

<?php if($session->USUARI_C_USERNAME=='MDiaz' or $session->USUARI_C_USERNAME=='ACuglievan'): ?>
<button class="waves-effect waves-light btn-small" id="btnaceptar" type="submit" >Aceptar</button> <?php endif; ?>
</div>
</form>


    </div>
	
	<div class="modal-footer">
	<a href="" class="btn modal-close red">Cerrar </a>
	</div>
 </div>
<!--Fin Modal 1-->

<!--Modal 2-->
<div id="modal2" class="modal">
    <div class="modal-content">
	
	<table class="highlight" id="tableaceptados">
        <thead>
            <tr>          
				<th>#</th>
				<th>Fecha</th>
                <th>Obra/Abastecimiento</th>               
			   <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            <tr>
			<td name="cnum"></td>
			<td name="cfecha"></td>
			<td name="cobab"></td>
			<td name="preci" id="preci"></td>                       
            </tr>
        </tbody>
    </table>
	<br>
	<br>
<h4>Historial</h4>
<input type="hidden" id="id_solabas" name="id_solabas" />

<div class="section container center">
<button class="btn btn-primary" type="button" id="btnaddprecio" ><i class="material-icons" >add</i></button>		
	
		<form action="<?= base_url() ?>solicitudabastecimiento/autorizar"  method="post" >
		<div class="form-group">
            <div class="col-md-12">
            
            <br>
            <br>
            <table id="tabledetprecio" class="table table-striped table-bordered nowrap" > <!--style="width:100%"-->
			<thead>
            <tr>
            <th style='width: 80px;'>Descripcion</th>
            <th>Pago</th>
			<th>Opcion</th>
            </tr>
            </thead>
			</table>
						
           </div>
         </div>
		<div>
		</div>
</div>
</form>		
		
</div>

</div>
 
 <!--Fin Modal 2-->
 
 <!--Modal 3-->
<div id="modal3" class="modal">
	<div class="modal-content">
	 	<table class="highlight" id="tablehistorico">
        <thead>
            <tr>          
				<th>Fecha</th>
				<th>Descripcion</th>
                <th>Pago</th> 
            </tr>
        </thead>
		<!--
        <tbody>
            <tr>
			<td name="">#</td>
			<td name="">#</td>
			<td name="">#</td>                    
            </tr>
			<tr>
			<td name="">#</td>
			<td name="">#</td>
			<td name="">#</td>                    
            </tr>
			<tr>
			<td name="">#</td>
			<td name="">#</td>
			<td name="">#</td>                    
            </tr>
        </tbody>
		-->
    </table>
	 
	</div> 
</div>
 <!--Fin Modal 3-->

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" 
    href="<?= base_url()?>solicitudabastecimiento/nuevo"><i class="material-icons">add</i></a>
