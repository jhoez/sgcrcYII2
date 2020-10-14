<?php if($equipo !== null):?>
<page backtop="0" backbottom="0" backleft="0" backright="0">
    <bookmark title="Reporte asistencia" level="0" ></bookmark>
    <page_header>
        <img class="imgheader" src="<?= Yii::$app->request->baseUrl."/img/printpdf/bannerfundabit.jpg" ?>" alt="">
    </page_header>

    <div class="text-right"><b>Reporte Fecha: </b><?=date("d/m/Y");?></div>
    <div class="text-center">
        <?php if (!empty($finicio) && !empty($ffin)) {
            echo "<h4>Reporte de Mascota desde ".$finicio." hasta ".$ffin."</h4>";
        }else if(!empty($mes)){
            setlocale(LC_TIME, 'es_ES.UTF-8');
            $fech = DateTime::createFromFormat('!m',$mes);
            echo "<h4>Reporte Mascotas del ".ucwords( (string)strftime("%B",(int)$fech->getTimestamp()) )."</h4>";
        }?>
    </div>
    <div class="">
        <?php foreach($equipo as $data): ?>
        <table class="table table-bordered">
            <!-- primera fila -->
            <thead>
                <tr>
                    <th style="background-color:#28a745;">ID</th>
                    <th>Sede CIAT</th>
                    <th>Institución</th>
                    <th>Representante</th>
                    <th>Cedula</th>
                    <th>Docente</th>
                    <th>Telefono</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=$data->ideq;?></td>
                    <td><?=$data->getCanrepresentante()->getRepSedeciat()->sede;?></td>
                    <td><?=$data->getCanrepresentante()->getRepInstituto()->nombinst;?></td>
                    <td><?=$data->getCanrepresentante()->nombre;?></td>
                    <td><?=$data->getCanrepresentante()->cedula;?></td>
                    <td><?=$data->getCanrepresentante()->docente;?></td>
                    <td><?=$data->getCanrepresentante()->telf;?></td>
                </tr>
            </tbody>
            <!-- segunda fila -->
            <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Grado</th>
                    <th>Esta graduado</th>
                    <th>Equipo</th>
                    <th>Serial equipo</th>
                    <th>Status equipo</th>
                    <th>Diagnostico</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=$data->getCanrepresentante()->getRepEstudiante()->nombestu;?></td>
                    <td><?=$data->getCanrepresentante()->getRepEstudiante()->getEstNiveleduc()->nivel;?></td>
                    <td><?=$data->getCanrepresentante()->getRepEstudiante()->getEstNiveleduc()->graduado;?></td>
                    <td><?=$data->eqversion;?></td>
                    <td><?=$data->eqserial;?></td>
                    <td><?=$data->eqstatus;?></td>
                    <td><?=$data->diagnostico;?></td>
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
                    <td><?=$data->observacion; ?></td>
                    <td><?=$data->getCanfsoftware()->fsoft;?></td>
                    <td><?=$data->getCanfpantalla()->fpant;?></td>
                    <td><?=$data->getCanftarjetamadre()->ftarj;?></td>
                    <td><?=$data->getCanfteclado()->ftec;?></td>
                    <td><?=$data->getCanfcarga()->fcarg;?></td>
                    <td><?=$data->getCanfgeneral()->fgen;?></td>
                </tr>
            </tbody>
        </table>
    <?php endforeach; ?>
    </div>
    <page_footer>
        <img class="imgfooter" src="<?= Yii::$app->request->baseUrl."/img/printpdf/cintillomppe.jpg" ?>" alt="">
    </page_footer>
</page>
<?php endif;?>
