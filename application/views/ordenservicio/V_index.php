<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Orden Servicio</a>
        </div>
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2"><?php echo count($ordenes);?></span>
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
                <th class="center-align">O.S.</th>
                <th class="left-align">SERVICIO</th>
                <th class="left-align">SEDE</th>
                <th class="left-align">CLIENTE</th>
                <th class="left-align">NUM. FISICO</th>
                <th class="center-align">FECHA</th>
                <th class="center-align">COD.PROY</th>
                <th class="center-align">SITUACION</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
            <?php if($ordenes): ?>
                <?php foreach($ordenes as $orden): ?> 
                    <tr>
                        <td class="center-align"><?=$orden->ORDSER_N_ID?></td>
                        <td class="left-align"><?=$orden->SERVIC_C_DESCRIPCION?></td>
                        <td class="left-align"><?=$orden->SEDE_C_DESCRIPCION?></td>
                        <td class="left-align"><?=$orden->CLIENT_C_RAZON_SOCIAL?></td>
                        <td class="left-align"><?=$orden->ORDSER_C_NUMERO_FISICO?></td>
                        <td class="center-align"><?=$orden->ORDSER_D_FECHA?></td>
                        <td class="center-align"><?=$orden->ORDSER_C_COD_PROYECTO?></td>
                        <td class="center-align"><?=$orden->ORDSER_C_SITUACION_DESCRIPCION?></td>
                        <td class="center-align">
                            <a href="<?= base_url() ?>ordenservicio/<?= $orden->EMPRES_N_ID ?>/<?= $orden->ORDSER_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td class="center-align">
                            <a href="ordenservicio/<?= $orden->EMPRES_N_ID ?>/<?= $orden->ORDSER_N_ID ?>/eliminar")>
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
    href="<?= base_url()?>ordenservicio/nuevo"><i class="material-icons">add</i></a>
