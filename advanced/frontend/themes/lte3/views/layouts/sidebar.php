<?php 
use hscstudio\mimin\components\Mimin;
//Yii::$app->language="en";
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo Yii::$app->homeUrl ?>index.php" class="brand-link">
        <img src="<?php echo Yii::$app->homeUrl ?>/images/hikorobotics.svg" alt="Hikrobotics" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">&nbsp;</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    <?php 
                        if(Yii::$app->user->isGuest) {
                            echo "Guest";
                        } else {
                            echo Yii::$app->user->identity->username;
                        }
                    ?>



                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu <i class="fa-light fa-business-time"></i><i class="far fa-angle-double-right"></i>-->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => \Yii::t('yii', 'Main Menu'),
                        'icon' => 'tachometer-alt',
                        //'badge' => '<span class="right badge badge-info">5</span>',
                        //'badge' => '<span class="right badge badge-info">5</span>',
                        'visible' => !Yii::$app->user->isGuest,
                        'items' => [
                            ['label' => \Yii::t('yii', 'Patners'), 'url' => ['/userk/index'], 'icon' => 'fas fa-portrait','visible'=>Mimin::checkRoute('userk/create')],
                            ['label' => \Yii::t('yii', 'Patners Level'), 'url' => ['/level/index'], 'icon' => 'fas fa-sitemap','visible'=>Mimin::checkRoute('level/create')],
                            ['label' => \Yii::t('yii', 'Partner Profile'), 'url' => ['/perusahaan/index'], 'icon' => 'fas fa-list','visible'=>Mimin::checkRoute('perusahaan/index')],
                            ['label' => \Yii::t('yii', 'Pages'), 'url' => ['/pagess/index'], 'icon' => 'fas fa-images','visible'=>Mimin::checkRoute('pages/index')],
                            ['label' => \Yii::t('yii', 'Role'), 'url' => ['/mimin/role/index'], 'icon' => 'fas fa-bug','visible'=>Mimin::checkRoute('mimin/role')],
                            ['label' => \Yii::t('yii', 'Routes'), 'url' => ['/mimin/route/index'], 'icon' => 'fas fa-angle-double-right','visible'=>Mimin::checkRoute('mimin/route')],
                            ['label' => \Yii::t('yii', 'Language'), 'url' => ['/site/bahasa'], 'icon' => 'fas fa-atlas'],
                            ['label' => \Yii::t('yii', 'Segment'), 'url' => ['/segment/index'], 'icon' => 'fas fa-landmark','visible'=>Mimin::checkRoute('segment/index')],
                            ['label' => \Yii::t('yii', 'Commodity'), 'url' => ['/barang/index'], 'icon' => 'fas fa-sd-card','visible'=>Mimin::checkRoute('barang/index')],
                            ['label' => \Yii::t('yii', 'Purchase Orders'), 'url' => ['/barangpo/index'], 'icon' => 'fas fa-chart-line','visible'=>Mimin::checkRoute('barangpo/index')],
                            ['label' => \Yii::t('yii', 'Company'), 'url' => ['/costumer/index'], 'icon' => 'fas fa-folder-plus'],
                            ['label' => \Yii::t('yii', 'Customer'), 'url' => ['/person/index'], 'icon' => 'fas fa-address-card'],
                            ['label' => \Yii::t('yii', 'Project'), 'url' => ['/project/index'], 'icon' => 'fas fa-chart-area'],
                            ['label' => \Yii::t('yii', 'Demo'), 'url' => ['/demo/index'], 'icon' => 'fas fa-city','visible'=>Mimin::checkRoute('demo/index')],
                            ['label' => \Yii::t('yii', 'Training'), 'url' => ['/training/index'], 'icon' => 'fas fa-chalkboard-teacher','visible'=>Mimin::checkRoute('training/index')],
                            ['label' => \Yii::t('yii', 'Join Visit'), 'url' => ['/visit/index'], 'icon' => 'far fa-street-view','visible'=>Mimin::checkRoute('visit/index')],
                        ]
                    ],
                    ['label' => \Yii::t('yii', 'Login'), 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' =>  \Yii::t('yii', 'Logout'),'url' => ['site/logout'],'template'=>'<a class="nav-link" href="{url}" data-method="post"><i class="nav-icon fas fa-sign-in-alt"></i>{label}</a>','icon' => 'sign-in-alt', 'visible' => !Yii::$app->user->isGuest],
                    //['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    //['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>