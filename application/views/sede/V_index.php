<div class="container">
    <table>
        <thead>
            <tr>          
                <th>ID</th>
                <th>Descripcion</th>
                <th>Direccion</th>
                <th>Abreviatura</th>
            </tr>
        </thead>
        <tbody>
            <?php if($sedes): ?>
                <?php foreach($sedes as $sede): ?> 
                    <tr>
                        <td><?=$sede->SEDE_N_ID?></td>
                        <td><?=$sede->SEDE_C_DESCRIPCION?></td>
                        <td><?=$sede->SEDE_C_DIRECCION?></td>
                        <td><?=$sede->SEDE_C_ABREVIATURA?></td>
                        <td>
                            <a href="<?= base_url() ?>sede/<?= $sede->SEDE_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>  
            <?php endif; ?>
        </tbody>
    </table>
</div>
<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:absolute;" 
    href="<?= base_url()?>sede/nuevo"><i class="material-icons">add</i></a>
