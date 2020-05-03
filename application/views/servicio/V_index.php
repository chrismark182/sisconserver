<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Servicios</a>
        </div>
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2"><?php echo count($servicios);?></span>
                    </b>
                </div>
            </div>
        </ul>      
    </div>
</nav>
<div class="container">
    <div>
        &nbsp;
    </div>

    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="center-align">ID</th>
                <th class="left-align">SERVICIO</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
            <?php if($servicios): ?>
                <?php foreach($servicios as $servicio): ?> 
                    <tr>
                        <td class="center-align"><?=$servicio->SERVIC_N_ID?></td>
                        <td class="left-align"><?=$servicio->SERVIC_C_DESCRIPCION?></td>
                        <td class="center-align">
                            <a href="<?= base_url() ?>servicio/<?= $servicio->EMPRES_N_ID ?>/<?= $servicio->SERVIC_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td class="center-align">
                            <a href="servicio/<?= $servicio->EMPRES_N_ID ?>/<?= $servicio->SERVIC_N_ID ?>/eliminar")>
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
    href="<?= base_url()?>servicio/nuevo"><i class="material-icons">add</i></a>
