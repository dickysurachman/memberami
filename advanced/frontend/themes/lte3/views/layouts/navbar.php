<?php
use app\models\Visit;
use app\models\Training;
use app\models\Demo;
use yii\helpers\Html;
use hscstudio\mimin\components\Mimin;

if(!Yii::$app->user->isGuest) {
    if(Mimin::checkRoute('userk/create')){
    $demo =Demo::find()->where('status=1')->count();
    $training=Training::find()->where('status=1')->count();
    $visit=Visit::find()->where('status=1')->count();
    } else {    
    $demo =Demo::find()->where('status=1 and id_user='.Yii::$app->user->identity->id)->count();
    $training=Training::find()->where('status=1 and id_user='.Yii::$app->user->identity->id)->count();
    $visit=Visit::find()->where('status=1 and id_user='.Yii::$app->user->identity->id)->count();
    }
} else {

    $demo =0;
    $training=0;
    $visit=0;
}
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?=\yii\helpers\Url::home()?>" class="nav-link"><?php echo \Yii::t('yii', 'Home')?></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo Yii::$app->homeUrl ?>site/profile.html" class="nav-link"><?php echo \Yii::t('yii', 'Profile')?></a>

        </li>

        <li class="nav-item dropdown">
            <a data-toggle="dropdown" href="<?php echo Yii::$app->homeUrl ?>site/rate.html" class="nav-link dropdown-toggle"><?php echo \Yii::t('yii', 'Pricelist')?></a>
        <ul class="dropdown-menu border-0 shadow">
            <li class="dropdown-item">
            <a href="<?php echo Yii::$app->homeUrl ?>site/rate.html" class="nav-link"><?php echo \Yii::t('yii', 'General Pricelist')?></a>
            </li>
            <li class="dropdown-item">
            <a href="<?php echo Yii::$app->homeUrl ?>site/ratemember.html" class="nav-link"><?php echo \Yii::t('yii', 'Partner Pricelist')?></a>
            </li>
        </ul>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo Yii::$app->homeUrl ?>#" class="nav-link"><?php echo \Yii::t('yii', 'Download')?></a>

        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo Yii::$app->homeUrl ?>site/contact.html" class="nav-link">Contact</a>

        </li>
       
        
    </ul>

    <!-- SEARCH FORM -->
 
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">3 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> <?php echo $demo ?> Demo  
                    <span class="float-right text-muted text-sm">Approved</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> <?php echo $visit ?> Visit
                    <span class="float-right text-muted text-sm">Approved</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> <?php echo $training ?> Training
                    <span class="float-right text-muted text-sm">Approved</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <?php 
        if(!Yii::$app->user->isGuest)
            { ?>
        <li class="nav-item">
            <?= Html::a('<i class="nav-icon fas fa-sign-in-alt"></i> Sign Out', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
        <?php }?>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->