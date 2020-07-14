<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Seguridad</a>
        <a href="<?= base_url() ?>categorias" class="breadcrumb">Categorías</a>
        <a href="#!" class="breadcrumb">Permisos</a>
      </div>
    </div>
</nav>
<div class="section container">
    <div class="card-panel">
        <input id="categoria_id" type="hidden" value="<?= $categoria->CATEGO_N_ID ?>">
        <?= $categoria->CATEGO_C_DESCRIPCION ?>
    </div>
</div>
<div class="section container">
    <table>
        <thead>
          <tr>
              <th>Menú</th>
              <th>Permiso</th>
          </tr>
        </thead>

        <tbody>
        <?php foreach ($menus as $row): 
            $checked = '';
            if($row->PERMISO > 0): $checked = 'checked'; endif;    
        ?>
            <tr>
                <td><?= $row->MENU_DESCRIPCION ?></td>
                <td> 
                    <div class="switch">
                        <label>
                        Off
                        <input type="checkbox" value="<?= $row->MENU_ID ?>" onclick="updatePermiso(this)" <?= $checked ?>>
                        <span class="lever"></span>
                        On
                        </label>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    function updatePermiso(e)
    {
        $('.preloader-background').css({'display': 'block'});   
        
        let url = '<?= base_url() ?>api/execsp';
        let sp = 'CATEGORIA_MENU_UPD';
        let categoria = parseInt(document.getElementById('categoria_id').value)
        let menu = parseInt(e.value)
        let estado = 0
        if(e.checked){estado = 1}
        let data = {sp, categoria, menu, estado}

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
            M.toast({html: 'Permiso actualizado', classes: 'rounded'});
        });
        $('.preloader-background').css({'display': 'none'});    
    }
</script>