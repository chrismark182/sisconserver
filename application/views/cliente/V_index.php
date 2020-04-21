<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="#!" class="breadcrumb">Clientes</a>
      </div>
    </div>
</nav>

<div class="section container center">
    <div class="row">
            <div class="input-field col s12 m6 l4">
                <input id="documento" type="text" name="documento"  class="validate">
                <label class="active" for="documento">Id</label> 
            </div>
            <div class="input-field col s6 m6 l4">
                <input id="razon_social" type="text" name="razon_social"  class="validate">
                <label class="active" for="razon_social">Razon_social</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Buscar">
            </div>
        </div>
    
</div>
<div class="container">
    <table>
        <thead>
            <tr>          
                <th>Tipo de Documento</th>
                <th>Nº Documento</th>
                <th>Razon Social</th>
                <th>Direccion</th>
            </tr>
        </thead>
        <tbody>
            <?php if($clientes): ?>
                <?php foreach($clientes as $cliente): ?> 
                    <tr>
                        
                        <td><?=$cliente->TIPDOC_C_DESCRIPCION?></td>
                        <td><?=$cliente->CLIENT_C_DOCUMENTO?></td>
                        <td><?=$cliente->CLIENT_C_RAZON_SOCIAL?></td>
                        <td><?=$cliente->CLIENT_C_DIRECCION?></td>
                        
                        <td>
                            <a href="<?= base_url() ?>cliente/<?= $cliente->EMPRES_N_ID ?>/<?= $cliente->CLIENT_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td>
                        
                        <a href="cliente/<?= $cliente->EMPRES_N_ID ?>/<?= $cliente->CLIENT_N_ID ?>/eliminar")>
                        
                        <i class="material-icons">delete</i>
                        </a>
                        </td>
            
                    </tr>
                <?php endforeach; ?>  
            <?php endif; ?>
        </tbody>
    </table>
</div>
<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:absolute;" 
    href="<?= base_url()?>cliente/nuevo"><i class="material-icons">add</i></a>
