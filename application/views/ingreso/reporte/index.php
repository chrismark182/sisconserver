<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papeleta de Visita</title>
    <link rel="stylesheet" href="<?= dirname(__FILE__) ?>/css/ingreso.css">
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
            <?= $result[0]->MOVPER_C_TITULO ?>
        </div> 
        <br>

        <div class="fila_resumen" style="color:white; border-top: 0px;">
            EMPRESA VISITANTE
        </div> 
        <div class="fila2">
            <br>
            <div>
                <div class = "subtitulo">
                    VISITANTE:
                </div>
                <div class = "contenido">
                    <?= $result[0]->CLIENT_C_RAZON_SOCIAL_VISITANTE ?>
                </div>
            </div> 
            <div>
                <div class = "subtitulo">
                    DOCUMENTO:
                </div>
                <div class = "contenido">
                    <?= $result[0]->PERSON_C_DOCUMENTO_VISITANTE ?>
                </div>
            </div>
            <div>
                <div class = "subtitulo">
                    NOMBRES: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->PERSON_C_NOMBRE ?>
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    APELLIDOS:
                </div> 
                <div class = "contenido">
                    <?= $result[0]->PERSON_C_APELLIDOS ?> 
                </div> 
            </div>
        </div>
        <br>

        <div class="fila_resumen" style="color:white; border-top: 0px;">
            EMPRESA VISITADA
        </div> 
        <div class="fila2">
            <div>
                <div class = "subtitulo">
                    VISITADO:
                </div>
                <div class = "contenido">
                    <?= $result[0]->CLIENT_C_RAZON_SOCIAL_VISITADO ?>
                </div>
            </div>
            <div>
                <div class = "subtitulo">
                    DOCUMENTO:
                </div>
                <div class = "contenido">
                    <?= $result[0]->CLICON_C_DOCUMENTO_VISITADO ?>
                </div>
            </div>
            <div>
                <div class = "subtitulo">
                    NOMBRES: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->CLICON_C_NOMBRE ?>
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    APELLIDOS:
                </div> 
                <div class = "contenido">
                    <?= $result[0]->CLICON_C_APELLIDOS ?> 
                </div> 
            </div>
        </div> 
        <br>

        <div class="fila_resumen" style="color:white; border-top: 0px;">
            FECHAS
        </div> 
        <div class="fila2">
            <div>
                <div class = "subtitulo">
                    LLEGADA:
                </div>
                <div class = "contenido">
                    <?= $result[0]->MOVPER_D_FECHA_LLEGADA ?>
                </div>
            </div>
            <div>
                <div class = "subtitulo">
                    INGRESO:
                </div>
                <div class = "contenido">
                    <?= $result[0]->MOVPER_D_FECHA_INGRESO ?>
                </div>
            </div>
            <div>
                <div class = "subtitulo">
                    SALIDA:
                </div> 
                <div class = "contenido">
                    <?= $result[0]->MOVPER_D_FECHA_SALIDA ?> 
                </div> 
            </div>
        </div> 
        <br>

        <div class="fila_resumen" style="color:white; border-top: 0px;">
            OTROS DATOS
        </div> 
        <div class="fila2">
            <div>
                <div class = "subtitulo">
                    MOTIVO:
                </div>
                <div class = "contenido">
                    <?= $result[0]->MOTVIS_C_DESCRIPCION ?>
                </div>
            </div>
            <div>
                <div class = "subtitulo">
                    TIPO DE INGRESO:
                </div>
                <div class = "contenido">
                    <?= $result[0]->TIPING_C_DESCRIPCION ?>
                </div>
            </div>
            <div>
                <div class = "subtitulo">
                    GUIA REMISION:
                </div> 
                <div class = "contenido">
                    <?= $result[0]->MOVPER_C_GUIA_REMISION ?> 
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    OBRA:
                </div> 
                <div class = "contenido">
                    <?= $result[0]->MOVPER_C_OBRA ?> 
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    ORDEN COMPRA:
                </div> 
                <div class = "contenido">
                    <?= $result[0]->MOVPER_C_ORDEN_COMPRA ?> 
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    OBSERVACIONES:
                </div> 
                <div class = "contenido">
                    <?= $result[0]->MOVPER_C_OBSERVACIONES ?> 
                </div> 
            </div>
        </div> 
        <br>
    </div>
</body>
</html>