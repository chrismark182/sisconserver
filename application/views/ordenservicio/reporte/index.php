<?php 
   $subtotal1 = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Servicio</title>
    <link rel="stylesheet" href="<?= dirname(__FILE__) ?>/css/ordenservicio.css">
</head>
<body>
    <div class = "paper">
        <div class="fila1">
            <div class="logo">
                <img src='<?= dirname(__FILE__) ?>/Logo_Bigote.jpg'>
            </div>
            <div class = "usuario">
                Usuario: <?= $this->data['session']->USUARI_C_USERNAME ?>
            </div> 
            <div class = "fecha">
                Fecha: <?php echo date('d/m/Y')?> <?php echo date('H:i')?>
            </div> 
        </div> 
        <br>

        <div class = "titulo" style="color:white;">
            ORDEN DE SERVICIO Nro. <?= $result[0]->ORDSER_N_ID ?>
        </div> 
        <div class="fila2">
            <br>
            <div>
                <div class = "subtitulo">
                    SEDE: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->SEDE_C_DESCRIPCION ?>
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    NUMERO FISICO:
                </div>
                <div class = "contenido">
                    <?= $result[0]->ORDSER_C_NUMERO_FISICO ?>
                </div>
            </div> 
            <div>
                <div class = "subtitulo">
                    FECHA: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->ORDSER_D_FECHA ?>
                </div> 
            </div>
        </div> 

        <div class="fila_resumen" style="color:white; border-top: 0px;">
            DATOS DEL CLIENTE
        </div> 
        <div class="fila2" style="border-top: 0px;">
            <br>
            <div>
                <div class = "subtitulo">
                    CLIENTE: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->CLIENT_C_RAZON_SOCIAL ?>
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    SOLICITANTE: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->ORDSER_C_SOLICITANTE ?>
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    DIRECCION: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->CLIENT_C_DIRECCION ?>
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    RUC: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->CLIENT_C_DOCUMENTO ?>
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    COD. PROYECTO: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->ORDSER_C_COD_PROYECTO ?>
                </div> 
            </div>
        </div> 
        
        <div class="fila_resumen" style="color:white; border-top: 0px;">
            DATOS DEL SERVICIO
        </div> 
        <div class="fila2" style="border-top: 0px;">
            <br>
            <div>
                <div class = "subtitulo">
                    SERVICiO: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->SERVIC_C_DESCRIPCION ?>
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    MONEDA: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->MONEDA_C_DESCRIPCION ?>
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    HORAS: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->ORDSER_N_HORAS ?>
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    PRECIO X HORA: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->ORDSER_N_PRECIO_UNIT ?>
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    TOTAL: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->ORDSER_N_TOTAL ?>
                </div> 
            </div>
        </div> 
    </div>
</body>
</html>