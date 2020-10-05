<?php if($canaimita !== null):?>

<page backtop="15" backbottom="15" backleft="0" backright="0">
    <bookmark title="Reporte asistencia" level="0" ></bookmark>
    <page_header>
        <img id="imgheader" src="<?= Yii::$app->request->baseUrl."/img/printpdf/bannerfundabit.jpg" ?>" alt="">
    </page_header>

    <div class="fecha"><b>Reporte Fecha: </b><?=date("d/m/Y");?></div>
    <div id="titlereport">
        <?php if (!empty($finicio) && !empty($ffin)) {
            echo "<h4>Reporte de Mascota desde ".$finicio." hasta ".$ffin."</h4>";
        }else if(!empty($mes)){
            setlocale(LC_TIME, 'es_ES.UTF-8');
            $fech = DateTime::createFromFormat('!m',$mes);
            echo "<h4>Reporte Mascotas del ".ucwords( (string)strftime("%B",(int)$fech->getTimestamp()) )."</h4>";
        }?>
    </div>
    <?php foreach($canaimita as $data): ?>
    <div>
        <table class="table table-bordered">
            <!-- primera fila -->
            <thead>
                <tr>
                    <th style="background-color:#28a745;">ID</th>
                    <th>CIAT</th>
                    <th>Institución</th>
                    <th>Representante</th>
                    <th>Cedula</th>
                    <th>Docente</th>
                    <th>Telefono</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
            <!-- segunda fila -->
            <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Grado</th>
                    <th>Graduado</th>
                    <th>Equipo</th>
                    <th>Serial equipo</th>
                    <th>Status</th>
                    <th>Diagnostico</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
            <!-- tercera fila -->
            <thead>
                <tr>
                    <th>Observacion</th>
                    <th>F software</th>
                    <th>F pantalla</th>
                    <th>F tarjeta madre</th>
                    <th>F teclado</th>
                    <th>F carga</th>
                    <th>F general</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php endforeach; ?>
    <page_footer>
        <img id="imgfooter" src="<?= Yii::$app->request->baseUrl."/img/printpdf/cintillomppe.jpg" ?>" alt="">
    </page_footer>
</page>
<?php endif;?>
