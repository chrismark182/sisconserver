<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Tarifario</a>
        </div>
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2"><?php echo count($tarifas);?></span>
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
                
                <th class="left-align">SEDE</th>
                <th class="left-align">CLIENTE</th>
                <th class="left-align">SERVICIO</th>
                <th class="center-align">MONEDA</th>
                <th class="center-align">PRECIO UNITARIO</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
            <?php if($tarifas): ?>
                <?php foreach($tarifas as $tarifa): ?> 
                    <tr>
                        <td class="left-align"><?=$tarifa->SEDE_C_ABREVIATURA?></td>
                        <td class="left-align"><?=$tarifa->CLIENT_C_RAZON_SOCIAL?></td>
                        <td class="left-align"><?=$tarifa->SERVIC_C_DESCRIPCION?></td>
                        <td class="left-align"><?=$tarifa->MONEDA_C_ABREVIATURA?></td>
                        <td class="left-align"><?=$tarifa->TARIFA_N_PRECIO_UNIT?></td>
                        <td class="center-align">
                            <a href="<?= base_url() ?>ordenservicio/<?= $tarifa->EMPRES_N_ID ?>/<?= $tarifa->TARIFA_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td class="center-align">
                            <a href="ordenservicio/<?= $tarifa->EMPRES_N_ID ?>/<?= $tarifa->SEDE_N_ID ?>/<?= $tarifa->TARIFA_N_ID ?>/eliminar")>
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
    href="<?= base_url()?>ubicacion/nuevo"><i class="material-icons">add</i></a>
