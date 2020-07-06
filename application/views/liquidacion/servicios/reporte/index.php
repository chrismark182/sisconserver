<?php 
   $subtotal1 = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liquidación Servicios</title>
    <link rel="stylesheet" href="<?= dirname(__FILE__) ?>/css/liquidacion.css">
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
            <?= $result[0]->LIQCAB_C_TITULO ?>
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
                    CLIENTE:
                </div>
                <div class = "contenido">
                    <?= $result[0]->CLIENT_C_RAZON_SOCIAL ?>
                </div>
            </div>
            <div>
                <div class = "subtitulo">
                    FECHA LIQUIDACION: 
                </div>
                <div class = "contenido">
                    <?= $result[0]->LIQCAB_C_FECHA ?>
                </div> 
            </div>
            <div>
                <div class = "subtitulo">
                    ORDEN COMPRA:
                </div> 
                <div class = "contenido">
                    <?= $result[0]->LIQCAB_C_ORDEN_COMPRA ?>
                </div> 
            </div>
        </div> 
        <div class="fila2" style="border-top: 0px;">
            <div class = "col_2">
                FECHA   
            </div> 
            <div class = "col_1">
                ORDEN
            </div> 
            <div class = "col_3">
                SERVICIO
            </div> 
            <div class = "col_4">
                COD.PROYECTO
            </div> 
            <div class = "col_5">
                HORAS
            </div> 
            <div class = "col_6">
                MONEDA
            </div> 
            <div class = "col_7">
                PRECIO X HORA
            </div> 
            <div class = "col_8">
                TOTAL
            </div> 
            <br>
        
            <?php $i = 0;?>
                <?php foreach ($result as $item): ?>
                    <div class = "fila2_2">
                        <?= $result[$i]->ORDSER_D_FECHA ?>
                    </div> 
                    <div class = "fila2_1">
                        <?= $result[$i]->ORDSER_N_ID ?>
                    </div> 
                    <div class = "fila2_3">
                        <?= $result[$i]->SERVIC_C_DESCRIPCION ?>                    
                    </div> 
                    <div class = "fila2_4">
                        <?= $result[$i]->ORDSER_C_COD_PROYECTO ?>
                    </div> 
                    <div class = "fila2_5">
                        <?= $result[$i]->ORDSER_N_HORAS ?>
                    </div> 
                    <div class = "fila2_6">
                        <?= $result[$i]->MONEDA_C_SIMBOLO ?>
                    </div> 
                    <div class = "fila2_7">
                        <?= $result[$i]->ORDSER_N_PRECIO_UNIT ?>
                    </div> 
                    <div class = "fila2_8">
                        <?= $result[$i]->ORDSER_N_PRECIO_TOTAL ?>
                    </div> 
                    <div class = "fila2_8" style="display: none">
                        <?= $subtotal1 = $subtotal1 + $result[$i]->ORDSER_N_PRECIO_TOTAL ?>
                    </div> 
                    <br>
                <?php $i = $i + 1;?>
            <?php endforeach; ?>
        </div> 
        <br>
        <br>
        
        <table cellpadding="0" cellspacing="0">
            <tr valign="top" >
                <th>
                    <td width="270px">
                    </td>
                </th>
                <th valign="top">
                    <div class="fila_resumen" style="color:white;">
                        RESUMEN
                    </div> 
                    <div class="fila3" style="border-top: 0px;">
                        <div class = "col_3_resumen">
                            SERVICIO
                        </div> 
                        <div class = "col_5_resumen">
                            HORAS
                        </div> 
                        <div class = "col_5_resumen">
                            MONEDA
                        </div> 
                        <div class = "col_7_resumen">
                            PRECIO X HORA
                        </div> 
                        <div class = "col_7_resumen">
                            TOTAL
                        </div> 
                        <br>
                    
                        <?php $i = 0;?>
                            <?php foreach ($result2 as $item): ?>
                                <div class = "fila2_3_resumen">
                                    <?= $result2[$i]->SERVIC_C_DESCRIPCION ?>                    
                                </div> 
                                <div class = "fila2_5_resumen">
                                    <?= $result2[$i]->ORDSER_N_HORAS ?>
                                </div> 
                                <div class = "fila2_5_resumen">
                                    <?= $result2[$i]->MONEDA_C_SIMBOLO ?>
                                </div> 
                                <div class = "fila2_7_resumen">
                                    <?= $result2[$i]->ORDSER_N_PRECIO_UNIT ?>
                                </div> 
                                <div class = "fila2_7_resumen">
                                    <?= $result2[$i]->ORDSER_N_PRECIO_TOTAL ?>
                                </div> 
                                <br>
                            <?php $i = $i + 1;?>
                        <?php endforeach; ?>
                    </div> 
                </th>
            </tr>
            <tr>
                <th>
                    <td width="270px">
                    </td>
                </th>
                <th>
                    <div class="fila3" style="border-top: 0px;">
                        <br>
                        <div class="fila_final">
                            <div class = "col_totales_titulos">
                                SUB TOTAL
                            </div> 
                            <div class = "col_totales">
                                <?= trim(number_format((float)$subtotal1, 2, '.', '')) ?>
                            </div> 
                        </div> 
                        <div class="fila_final">
                            <div class = "col_totales_titulos">
                                I.G.V.
                            </div> 
                            <div class = "col_totales">
                                <?= trim(number_format((float)($subtotal1 * 0.18), 2, '.', '')) ?>
                            </div> 
                        </div> 
                        <div class="fila_final">
                            <div class = "col_totales_titulos">
                                TOTAL
                            </div> 
                            <div class = "col_totales">
                                <?= trim(number_format((float)$subtotal1 + ($subtotal1 * 0.18), 2, '.', '')) ?>
                            </div> 
                        </div> 
                    </div> 
                </th>
            </tr>
        </table>
    </div>
</body>
</html>