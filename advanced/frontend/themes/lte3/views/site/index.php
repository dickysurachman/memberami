<?php
use app\models\Visit;
use app\models\Project;
use app\models\Costumer;
use app\models\User;
use app\models\Training;
use app\models\Demo;
use app\models\Podetail;
use app\models\Podetailsum;


use scotthuangzl\googlechart\GoogleChart;

$this->title = 'Dashboard Members';
$this->params['breadcrumbs'] = [['label' => $this->title]];
$tgls=date('Y',time());
$project_open=Project::find()->where('status=0')->count();
$project_win=Project::find()->where('status=1')->count();
$costumer=Costumer::find()->count();
$user=User::find()->count()-1;
$usera=User::find()->where(['status'=>10])->count()-1;

$demo =Demo::find()->where('status=0')->count();
$training=Training::find()->where('status=0')->count();
$visit=Visit::find()->where('status=0')->count();

function namabulan($id){
    switch ($id){
    case 1: return "Jan";
    case 2: return "Feb";
    case 3: return "Mar";
    case 4: return "Apr";
    case 5: return "May";
    case 6: return "Jun";
    case 7: return "Jul";
    case 8: return "Aug";
    case 9: return "Sep";
    case 10: return "Oct";
    case 11: return "Nov";
    case 12: return "Dec";
    
    }

}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <?= \hail812\adminlte\widgets\Alert::widget([
                'type' => 'success',
                'body' => '<h3>Welcome '.Yii::$app->user->identity->username.' </h3>',
            ]) ?>
            
        </div>
    </div>    
    <div class="col-md-12">
        
    <?php include '_searchd.php' ?>
            
    </div>
    <div class="row">
        
        <?php 
    if(isset($model->tgl_a) and isset($model->tgl_b)) {

        $haa=Yii::$app->db->createCommand("Select month(tanggal) as nama,sum(total) as rns from podetailsum where tanggal between '".$model->tgl_a."' and '".$model->tgl_b."'group by month(tanggal) order by nama ")->queryAll();
        $i=0;
        $item1a[$i][]="Nama";
        $item1a[$i][]="Revenue";
        $i=1;
        foreach ($haa as $keya) {
            $item1a[$i][]= namabulan((int)$keya['nama']);
            $item1a[$i][]=(int)$keya['rns'];
            $i++;
        }
        $haa=Yii::$app->db->createCommand("Select nama,sum(total) as rns from podetailsum where tanggal between '".$model->tgl_a."' and '".$model->tgl_b."' group by nama order by nama ")->queryAll();
        $i=0;
        $item2a[$i][]="Nama";
        $item2a[$i][]="Revenue";
        $i=1;
        foreach ($haa as $keya) {
            $item2a[$i][]=$keya['nama'];
            $item2a[$i][]=(int)$keya['rns'];
            $i++;
        }

    $total=Podetailsum::find()->where(" tanggal between '".$model->tgl_a."' and '".$model->tgl_b."'")->sum('total');

    
    } else {
        
     $haa=Yii::$app->db->createCommand("Select month(tanggal) as nama,sum(total) as rns from podetailsum where year(tanggal)=".$tgls. "  group by month(tanggal) order by nama ")->queryAll();
        $i=0;
        $item1a[$i][]="Nama";
        $item1a[$i][]="Revenue";
        $i=1;
        foreach ($haa as $keya) {
            $item1a[$i][]= namabulan((int)$keya['nama']);
            $item1a[$i][]=(int)$keya['rns'];
            $i++;
        }
     $haa=Yii::$app->db->createCommand("select nama,sum(total) as rns from podetailsum where year(tanggal)=".$tgls. " group by nama order by nama ")->queryAll();
        $i=0;
        $item2a[$i][]="Nama";
        $item2a[$i][]="Revenue";
        $i=1;
        foreach ($haa as $keya) {
            $item2a[$i][]=$keya['nama'];
            $item2a[$i][]=(int)$keya['rns'];
            $i++;
        }

    $total=Podetailsum::find()->where(" year(tanggal)='".$tgls."'")->sum('total');
    
    }
    //'backgroundColor'=>['fill'=>'green','opacity'=>'10'],
    //'backgroundColor'=>['fill'=>'white','fillOpacity'=>'0.3'],
    //'backgroundColor'=>['fill'=>'red','fillOpacity'=>'0.3'],
    echo "<div class='col-lg-6 alert-success alert '>";
    if(count($item1a)>1) {
    echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                'data' => $item1a,
                'options' => array('title' => 'PO by Month ',
                    'height'=>350,'hAxis' => array('title' => 'Total Project '.number_format($total)),))); 
    }
    echo "</div>";
    echo "<div class='col-lg-6 alert-danger alert alert-danger'>";
    if(count($item2a)>1) {
    echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                'data' => $item2a,
                'options' => array('title' => 'PO by Costumer ','height'=>350,'hAxis' => array('title' => 'Total Project '.number_format($total)),))); 
    }
    echo "</div>";
    ?>

    </div>
    <div class="row">
        <div class="col-lg-6 alert-success alert alert-dismissible" style="padding:15px;" >
            <h3>List PO Project</h3>

            <table class="table table-responsive">
                <tr>
                    <th style="width:30px">No.</th>
                    <th  style="width:210px">Nama</th>
                    <th  style="width:200px;">Nilai</th>
                </tr>

                <?php 
                
                 if(isset($model->tgl_a) and isset($model->tgl_b)) {
                $win=Podetailsum::find()->where("tanggal between '".$model->tgl_a."' and '".$model->tgl_b."'")->orderBy(['total' => SORT_DESC])->limit(5)->all();
                 } else {
                $win=Podetailsum::find()->orderBy(['total' => SORT_DESC])->limit(5)->all();
                 }
                 $i=1;
                 $jumlah=0;
                 foreach($win as $value){
                    $jumlah+=$value->total;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $value->nama ?></td>
                        <td><?php echo number_format($value->total)?></td>
                    </tr>
                    <?php $i++;
                 }
                ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo number_format($jumlah); ?></td>

                    </tr>
            </table>

        </div>
        <div class="col-lg-6 alert-danger alert alert-danger" style="padding:15px;">
            <h3>5 List Project Terbesar </h3>

            <table class="table table-responsive" style="width: 100%">
                <tr>
                    <th style="width:30px">No.</th>
                    <th  style="width:210px">Nama</th>
                    <th  style="width:200px;">Nilai</th>                
                </tr>

                <?php 
                 if(isset($model->tgl_a) and isset($model->tgl_b)) {
                $win=Project::find()->where("status=1  and tanggal between '".$model->tgl_a."' and '".$model->tgl_b."'")->orderBy(['jumlah' => SORT_DESC])->limit(5)->all();
                 } else {
                $win=Project::find()->where('status=1')->orderBy(['jumlah' => SORT_DESC])->limit(5)->all();
                 }
                 $i=1;
                 $jumlah=0;
                 foreach($win as $value){
                     $jumlah+=$value->jumlah;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $value->nama ?></td>
                        <td><?php echo number_format($value->jumlah)?></td>
                    </tr>
                    <?php $i++;
                 }

                ?>
                <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo number_format($jumlah); ?></td>

                    </tr>
            </table>
            
        </div>
    </div>
    





    <div class="row">
        
        <?php 
    if(isset($model->tgl_a) and isset($model->tgl_b)) {

        $haa=Yii::$app->db->createCommand("Select month(tanggal) as nama,sum(jumlah) as rns from project where tanggal between '".$model->tgl_a."' and '".$model->tgl_b."' and status=1 group by month(tanggal) order by nama ")->queryAll();
        $i=0;
        $item1[$i][]="Nama";
        $item1[$i][]="Revenue";
        $i=1;
        foreach ($haa as $keya) {
            $item1[$i][]= namabulan((int)$keya['nama']);
            $item1[$i][]=(int)$keya['rns'];
            $i++;
        }
        $haa=Yii::$app->db->createCommand("Select month(tanggal) as nama,sum(jumlah) as rns from project where tanggal between '".$model->tgl_a."' and '".$model->tgl_b."' and  status=0 group by month(tanggal) order by nama ")->queryAll();
        $i=0;
        $item2[$i][]="Nama";
        $item2[$i][]="Revenue";
        $i=1;
        foreach ($haa as $keya) {
            $item2[$i][]=namabulan($keya['nama']);
            $item2[$i][]=(int)$keya['rns'];
            $i++;
        }

    $total=Project::find()->where(" tanggal between '".$model->tgl_a."' and '".$model->tgl_b."'")->sum('jumlah');

    
    } else {
        
     $haa=Yii::$app->db->createCommand("Select month(tanggal) as nama,sum(jumlah) as rns from project where year(tanggal)=".$tgls. " and status=1 group by month(tanggal) order by nama ")->queryAll();
        $i=0;
        $item1[$i][]="Nama";
        $item1[$i][]="Revenue";
        $i=1;
        foreach ($haa as $keya) {
            $item1[$i][]= namabulan((int)$keya['nama']);
            $item1[$i][]=(int)$keya['rns'];
            $i++;
        }
     $haa=Yii::$app->db->createCommand("Select month(tanggal) as nama,sum(jumlah) as rns from project where year(tanggal)=".$tgls. " and status=0 group by month(tanggal) order by nama ")->queryAll();
        $i=0;
        $item2[$i][]="Nama";
        $item2[$i][]="Revenue";
        $i=1;
        foreach ($haa as $keya) {
            $item2[$i][]=namabulan($keya['nama']);
            $item2[$i][]=(int)$keya['rns'];
            $i++;
        }

    $total=Project::find()->where(" year(tanggal)='".$tgls."'")->sum('jumlah');
    
    }

    echo "<div class='col'>";
    if(count($item1)>1) {
    echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                'data' => $item1,
                'options' => array('title' => 'Win Project ','height'=>350,'hAxis' => array('title' => 'Total Project '.number_format($total)),))); 
    }
    echo "</div>";
    echo "<div class='col'>";
    if(count($item1)>1) {
    echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                'data' => $item2,
                'options' => array('title' => 'Open Project ','height'=>350,'hAxis' => array('title' => 'Total Project '.number_format($total)),))); 
    }
    echo "</div>";
    ?>

    </div>
     <div class="row">
        <div class="col-lg-6 alert-success alert alert-dismissible" style="padding:15px;" >
            <h3>List Project Win</h3>

            <table class="table table-responsive">
                <tr>
                    <th style="width:30px">No.</th>
                    <th  style="width:210px">Nama</th>
                    <th  style="width:200px;">Nilai</th>
                </tr>

                <?php 
                   if(isset($model->tgl_a) and isset($model->tgl_b)) {
                $win=Project::find()->where("status=1  and tanggal between '".$model->tgl_a."' and '".$model->tgl_b."'")->orderBy(['id' => SORT_DESC])->limit(5)->all();
                 } else {
                $win=Project::find()->where('status=1')->orderBy(['id' => SORT_DESC])->limit(5)->all();
                 }
                 $i=1;
                 $jumlah=0;
                 foreach($win as $value){
                    $jumlah+=$value->jumlah;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $value->nama ?></td>
                        <td><?php echo number_format($value->jumlah)?></td>
                    </tr>
                    <?php $i++;
                 }
                ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo number_format($jumlah); ?></td>

                    </tr>
            </table>

        </div>
        <div class="col-lg-6 alert-danger alert alert-danger" style="padding:15px;">
            <h3>List Project Open</h3>

            <table class="table table-responsive" style="width: 100%">
                <tr>
                    <th style="width:30px">No.</th>
                    <th  style="width:210px">Nama</th>
                    <th  style="width:200px;">Nilai</th>                
                </tr>

                <?php 
                 if(isset($model->tgl_a) and isset($model->tgl_b)) {
                $win=Project::find()->where("status=0  and tanggal between '".$model->tgl_a."' and '".$model->tgl_b."'")->orderBy(['id' => SORT_DESC])->limit(5)->all();
                 } else {
                $win=Project::find()->where('status=0')->orderBy(['id' => SORT_DESC])->limit(5)->all();
                 }
                 $i=1;
                 $jumlah=0;
                 foreach($win as $value){
                     $jumlah+=$value->jumlah;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $value->nama ?></td>
                        <td><?php echo number_format($value->jumlah)?></td>
                    </tr>
                    <?php $i++;
                 }

                ?>
                <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo number_format($jumlah); ?></td>

                    </tr>
            </table>
            
        </div>
    </div>    
    <div class="row">
  
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => $user,
                'text' => 'User Registered',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'success'
            ]) ?>
             <?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $smallBox->id.'-ribbon',
                'text' => 'Registered',
                'theme' => 'warning',
                'size' => 'lg',
                'textSize' => 'lg'
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
        </div>
  
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $usera,
                'text' => 'User Approve',
                'icon' => 'fas fa-user-plus',
                'theme' => 'gradient-success',
                //'loadingStyle' => true
            ]) ?>
        </div> 
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $user - $usera,
                'text' => 'User Waiting Approve',
                'icon' => 'fas fa-user-plus',
                'theme' => 'gradient-success',
                'loadingStyle' => true
            ]) ?>
        </div>
    </div>
     <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Jumlah Costumer',
                'number' => $costumer,
                'icon' => 'far fa-envelope',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Jumlah Project Win',
                'number' => $project_win,
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Jumlah Project Open',
                'number' => $project_open,
                 'theme' => 'success',
                'icon' => 'far fa-flag',
            ]) ?>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Waiting Approval Demo',
                'number' => $demo,
                'icon' => 'far fa-envelope',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Waiting Approval Training',
                'number' => $training,
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Waiting Approval Visit',
                'number' => $visit,
                 'theme' => 'success',
                'icon' => 'far fa-flag',
            ]) ?>
        </div>
    </div>


</div>