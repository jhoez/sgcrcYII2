<?php if($canaimita !== null):?>
<page backtop="15" backbottom="15" backleft="0" backright="0">
    <bookmark title="Reporte asistencia" level="0" ></bookmark>
    <page_header>
        <img id="imgheader" src="<?= Yii::$app->request->baseUrl."/img/printpdf/bannerfundabit.jpg" ?>" alt="">
    </page_header>

    <div class="fecha"><b>Fecha: </b><?=date("d/m/Y");?></div>
    <div id="titlereport">
        <h2>Reporte de Canaimitas con falla de "<?= $falla;?>"</h2>
    </div>
    <?php foreach($canaimita as $data): ?>
        <table class="table table-bordered">
            <!-- primera fila -->
            <thead>
                <tr>
                    <th id="thead" style="background-color:#28a745;">ID</th>
                    <th id="thead">Sede CIAT</th>
                    <th id="thead">Institución</th>
                    <th id="thead">Representante</th>
                    <th id="thead">Cedula</th>
                    <th id="thead">Docente</th>
                    <th id="thead">Telefono</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="tbody"><?=$data->ideq;?></td>
                    <td id="tbody"><?=$data->getCanrepresentante()->getRepSedeciat()->sede;?></td>
                    <td id="tbody"><?=$data->getCanrepresentante()->getRepInstituto()->nombinst;?></td>
                    <td id="tbody"><?=$data->getCanrepresentante()->nombre;?></td>
                    <td id="tbody"><?=$data->getCanrepresentante()->cedula;?></td>
                    <td id="tbody"><?=$data->getCanrepresentante()->docente;?></td>
                    <td id="tbody"><?=$data->getCanrepresentante()->telf;?></td>
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
    <page_footer>
        <img id="imgfooter" src="<?= Yii::$app->request->baseUrl."/img/printpdf/cintillomppe.jpg" ?>" alt="">
    </page_footer>
</page>
<?php endif;?>
