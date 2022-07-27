<?php
use app\models\Person;
use app\models\Project;
use app\models\Demo;
use app\models\Visit;
use app\models\Training;
$tracking=Demo::find()->where(['id_project'=>$model->id])->orderBy(['nama' => SORT_ASC])->all();
if($tracking<>""){
            ?>
            <h4>Demo</h4>
            <table class="table table-bordered">
                <tr>
                <th>No. </th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Budget</th>
                <th>Nama Person</th>
                <th>Telp</th>
                </tr>
            <?php
            $i=1;
            foreach ($tracking as $key => $value) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>".$value['tanggal']."</td>";
                echo "<td>".$value['statusnya']."</td>";
                echo "<td>".number_format($value['jumlah'])."</td>";
                echo "<td>".$value['person']."</td>";
                echo "<td>".$value['person_c']."</td>";
                echo "</tr>";
                $i++;
            }
            ?>
            </table>
        <?php }

$tracking=Training::find()->where(['id_project'=>$model->id])->orderBy(['nama' => SORT_ASC])->all();
if($tracking<>""){
            ?>
            <h4>Training</h4>
            <table class="table table-bordered">
                <tr>
                <th>No. </th>
                <th>Tanggal</th>
                <th>Nama Person</th>
                <th>Telp</th>
                <th>Status</th>
                <th width="250px">Keterangan</th>
                </tr>
            <?php
            $i=1;
            foreach ($tracking as $key => $value) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>".$value['tanggal_r']."</td>";
                echo "<td>".$value['person']."</td>";
                echo "<td>".$value['person_c']."</td>";
                echo "<td>".$value['statusnya']."</td>";
                echo "<td width='250px'>".$value['keterangan']."</td>";
                echo "</tr>";
                $i++;
            }
            ?>
            </table>
        <?php }
$tracking=Visit::find()->where(['id_project'=>$model->id])->orderBy(['nama' => SORT_ASC])->all();
if($tracking<>""){
            ?>
            <h4>Visit</h4>
            <table class="table table-bordered">
                <tr>
                <th>No. </th>
                <th>Tanggal Visit</th>
                <th>Status</th>
                <th>Person</th>
                <th>Telp</th>
                </tr>
            <?php
            $i=1;
            foreach ($tracking as $key => $value) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>".$value['tanggal']."</td>";
                echo "<td>".$value['statusnya']."</td>";
                echo "<td>".$value['person']."</td>";
                echo "<td>".$value['person_c']."</td>";
                echo "</tr>";
                $i++;
            }
            ?>
            </table>
        <?php }


?>