<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Clientes</a>
        </div>
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2"><?php echo count($clientes);?></span>
                    </b>
                </div>
            </div>
        </ul>
    </div>
</nav>

<div class="section container center">
    <div class="row" style="margin-bottom: 0px">
        <form action="<?= base_url() ?>clientes" method="post">
            <div class="input-field col s5">
                <input id="numero_documento" maxlength="15" type="text" name="numero_documento"  class="validate">
                <label class="active" for="numero_documento">Nro. Documento</label> 
            </div>
            <div class="input-field col s5">
                <input id="razon_social" maxlength="200" type="text" name="razon_social"  class="validate">
                <label class="active" for="razon_social">Razon_social</label> 
            </div>
            <div class="input-field col s2">
                <input class="btn-small" type="submit" value="Buscar">
            </div>
        </form>
    </div>    
</div>
<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="left-align">DOCUMENTO</th>
                <th class="center-align">NUMERO</th>
                <th class="left-align">RAZÓN SOCIAL</th>
                <th class="left-align">DIRECCIÓN</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
            <?php if($clientes): ?>
                <?php foreach($clientes as $cliente): ?> 
                    <tr>
                        <td class="left-align"><?=$cliente->TIPDOC_C_ABREVIATURA?></td>
                        <td class="center-align"><?=$cliente->CLIENT_C_DOCUMENTO?></td>
                        <td class="left-align"><?=$cliente->CLIENT_C_RAZON_SOCIAL?></td>
                        <td class="left-align"><?=$cliente->CLIENT_C_DIRECCION?></td>
                        <td class="center-align">
                            <a href="<?= base_url() ?>cliente/<?= $cliente->EMPRES_N_ID ?>/<?= $cliente->CLIENT_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td class="center-align">
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
