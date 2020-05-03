<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Motivo de Visita</a>
        </div>
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2"><?php echo count($visitas);?></span>
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
                <th class="left-align">MOTIVO DE VISITA</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
            <?php if($visitas): ?>
                <?php foreach($visitas as $visita): ?> 
                    <tr>
                        <td class="center-align"><?=$visita->MOTVIS_N_ID?></td>
                        <td class="left-align"><?=$visita->MOTVIS_C_DESCRIPCION?></td>
                        <td class="center-align">
                            <a href="<?= base_url() ?>visita/<?= $visita->EMPRES_N_ID ?>/<?= $visita->MOTVIS_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td class="center-align">
                            <a href="visita/<?= $visita->EMPRES_N_ID ?>/<?= $visita->MOTVIS_N_ID ?>/eliminar")>
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
    href="<?= base_url()?>visita/nuevo"><i class="material-icons">add</i></a>
