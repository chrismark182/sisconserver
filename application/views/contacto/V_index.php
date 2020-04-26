<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="#!" class="breadcrumb">Contactos</a>
      </div>
    </div>
</nav>

<div class="container">
    <table>
        <thead>
            <tr>          
                <th>Razon Social</th>
                <th >Tipo de Documento</th>
                <th >N° Documento</th>
                <th>Nombres</th>
            </tr>
        </thead>
        <tbody>
            <?php if($contactos): ?>
                <?php foreach($contactos as $contacto): ?> 
                    <tr>
                        
                        <td><?=$contacto->CLIENT_C_RAZON_SOCIAL?></td>
                        <td ><?=$contacto->TIPDOC_C_ABREVIATURA?></td>
                        <td class="right-align"><?=$contacto->CLICON_C_DOCUMENTO ?></td>
                        <td><?=$contacto->CLICON_C_NOMBRE?></td>
                        
                        <td>
                            <a href="<?= base_url() ?>contacto/<?= $contacto->EMPRES_N_ID ?>/<?= $contacto->CLIENT_N_ID ?>/<?= $contacto->CLICON_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td>
                        
                        <a href="contacto/<?= $contacto->EMPRES_N_ID ?>/<?= $contacto->CLIENT_N_ID ?>/<?= $contacto->CLICON_N_ID ?>/eliminar")>
                        
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
    href="<?= base_url()?>contacto/nuevo"><i class="material-icons">add</i></a>
