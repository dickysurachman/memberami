<?php
use app\models\Person;
use app\models\Project;
use app\models\Demo;
use app\models\Visit;
use app\models\Training;
$tracking=Person::find()->where(['id_costumer'=>$model->id])->orderBy(['nama' => SORT_ASC])->all();
if($tracking<>""){
            ?>
            <h4>Person</h4>
            <table class="table table-bordered">
                <tr>
                <th>No. </th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Email</th>
                </tr>
            <?php
            $i=1;
            foreach ($tracking as $key => $value) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>".$value['nama']."</td>";
                echo "<td>".$value['telp']."</td>";
                echo "<td>".$value['email']."</td>";
                echo "</tr>";
                $i++;
            }
            ?>
            </table>
        <?php }
$tracking=Project::find()->where(['id_costumer'=>$model->id])->orderBy(['nama' => SORT_ASC])->all();
if($tracking<>""){
            ?>
            <h4>Project</h4>
            <table class="table table-bordered">
                <tr>
                <th>No. </th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Jumlah</th>
                </tr>
            <?php
            $i=1;
            foreach ($tracking as $key => $value) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>".$value['nama']."</td>";
                echo "<td>".$value['tanggal']."</td>";
                echo "<td>".$value['statusnya']."</td>";
                echo "<td>".number_format($value['jumlah'])."</td>";
                echo "</tr>";
                $i++;
            }
            ?>
            </table>
        <?php }
?>