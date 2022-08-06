<?php
use app\models\Person;
use app\models\Project;
use app\models\Demo;
use app\models\Visit;
use app\models\Training;
use app\models\Barangpo;
use yii\helpers\Html;
$tracking=Demo::find()->where(['id_project'=>$model->id])->orderBy(['nama' => SORT_ASC])->all();
if($tracking<>""){
            ?>
            <h4><?=\Yii::t('yii', 'Demo')?></h4>
            <table class="table table-bordered">
                <tr>
                <th width="15px">No. </th>
                <th  width="85px"><?=\Yii::t('yii', 'Date')?></th>
                <th width="85px"><?=\Yii::t('yii', 'Status')?></th>
                <!--<th>Budget</th>-->
                <th width="185px"><?=\Yii::t('yii', 'Person Name')?></th>
                <th width="185px"><?=\Yii::t('yii', 'Contact Number')?></th>
                <th></th>
                </tr>
            <?php
            $i=1;
            foreach ($tracking as $key => $value) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>".$value['tanggal']."</td>";
                echo "<td>".$value['statusnya']."</td>";
                //echo "<td>".number_format($value['jumlah'])."</td>";
                echo "<td>".$value['person']."</td>";
                echo "<td>".$value['person_c']."</td>";
                echo "<td>".Html::a('<span class="fas fa-pencil-alt" style="font-size:10pt;" title="edit PO"></span> '.\Yii::t('yii', 'Edit'), ['project/editdemo', 'id' => $value['id']], ['data-pjax' => "1",'role'=>'modal-remote','title'=>'Edit Demo','data-toggle'=>'tooltip','class'=>'btn btn-sm btn-outline-success dropdown-item']).
                    "</td>";

                echo "</tr>";
                $i++;
            }
            ?>
            </table>
        <?php }

$tracking=Training::find()->where(['id_project'=>$model->id])->orderBy(['nama' => SORT_ASC])->all();
if($tracking<>""){
            ?>
            <h4><?=\Yii::t('yii', 'Training')?></h4>
            <table class="table table-bordered">
                <tr>
                <th width="15px">No. </th>
                <th  width="85px"><?=\Yii::t('yii', 'Date')?></th>
                <th width="85px"><?=\Yii::t('yii', 'Status')?></th>
                <!--<th>Budget</th>-->
                <th width="185px"><?=\Yii::t('yii', 'Person Name')?></th>
                <th width="185px"><?=\Yii::t('yii', 'Contact Number')?></th>
                <!--<th width="285px">Keterangan</th>-->
                <th></th>
                </tr>
            <?php
            $i=1;
            foreach ($tracking as $key => $value) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>".$value['tanggal_r']."</td>";
                echo "<td>".$value['statusnya']."</td>";
                echo "<td>".$value['person']."</td>";
                echo "<td>".$value['person_c']."</td>";
                //echo "<td width='285px'>".$value['keterangan']."</td>";
                 echo "<td>".Html::a('<span class="fas fa-pencil-alt" style="font-size:10pt;" title="edit PO"></span> '.\Yii::t('yii', 'Edit'), ['project/edittraining', 'id' => $value['id']], ['data-pjax' => "1",'role'=>'modal-remote','title'=>'Edit Training','data-toggle'=>'tooltip','class'=>'btn btn-sm btn-outline-success dropdown-item']).
                    "</td>";
                echo "</tr>";
                $i++;
            }
            ?>
            </table>
        <?php }
$tracking=Visit::find()->where(['id_project'=>$model->id])->orderBy(['nama' => SORT_ASC])->all();
if($tracking<>""){
            ?>
            <h4><?=\Yii::t('yii', 'Join Visit')?></h4>
            <table class="table table-bordered">
                <tr>
                <th width="15px">No. </th>
                <th  width="85px"><?=\Yii::t('yii', 'Date')?></th>
                <th width="85px"><?=\Yii::t('yii', 'Status')?></th>
                <!--<th>Budget</th>-->
                <th width="185px"><?=\Yii::t('yii', 'Person Name')?></th>
                <th width="185px"><?=\Yii::t('yii', 'Contact Number')?></th>
                <th></th>
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
                 echo "<td>".Html::a('<span class="fas fa-pencil-alt" style="font-size:10pt;" title="edit PO"></span> '.\Yii::t('yii', 'Edit'), ['project/editvisit', 'id' => $value['id']], ['data-pjax' => "1",'role'=>'modal-remote','title'=>'Edit Visit','data-toggle'=>'tooltip','class'=>'btn btn-sm btn-outline-success dropdown-item']).
                    "</td>";
                echo "</tr>";
                $i++;
            }
            ?>
            </table>
        <?php }

$tracking=Barangpo::find()->where(['id_project'=>$model->id])->orderBy(['tanggal' => SORT_ASC])->all();
if($tracking<>""){
            ?>
            <h4><?=\Yii::t('yii', 'Purchase Orders')?></h4>
            <table class="table table-bordered">
                <tr>
                <th width="15px">No. </th>
                <th width="85px"><?=\Yii::t('yii', 'Date')?></th>
                <th><?=\Yii::t('yii', 'PO Code')?></th>
                <th><?=\Yii::t('yii', 'Mark')?></th>
                <th><?=\Yii::t('yii', 'Print')?></th>
                </tr>
            <?php
            $i=1;
            foreach ($tracking as $key => $value) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>".$value['tanggal']."</td>";
                echo "<td>".$value['kode']."</td>";
                echo "<td>".$value['keterangan']."</td>";
                echo "<td>".Html::a('<span class="fas fa-print" style="font-size:10pt;" title="Print"></span> '.\Yii::t('yii', 'Print'), ['barangpo/print', 'id' => $value['id']], ['class' => 'btn btn-success','target'=>"_blank",'data-pjax'=>"0"])."</td>";
                echo "</tr>";
                $i++;
            }
            ?>
            </table>
        <?php }

?>