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

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => \Yii::t('yii', 'Main Menu'),
                        'icon' => 'tachometer-alt',
                        'badge' => '<span class="right badge badge-info">5</span>',
                        'visible' => !Yii::$app->user->isGuest,
                        'items' => [
                            ['label' => \Yii::t('yii', 'User'), 'url' => ['/userk/index'], 'iconStyle' => 'far','visible'=>Mimin::checkRoute('userk/create')],
                            ['label' => \Yii::t('yii', 'Perusahaan User'), 'url' => ['/perusahaan/index'], 'iconStyle' => 'far','visible'=>Mimin::checkRoute('userk/create')],
                            ['label' => \Yii::t('yii', 'Pages'), 'url' => ['/pages/index'], 'iconStyle' => 'far','visible'=>Mimin::checkRoute('userk/create')],
                            ['label' => \Yii::t('yii', 'Role'), 'url' => ['/mimin/role'], 'iconStyle' => 'far','visible'=>Mimin::checkRoute('userk/create')],
                            ['label' => \Yii::t('yii', 'Routes'), 'url' => ['/mimin/route'], 'iconStyle' => 'far','visible'=>Mimin::checkRoute('userk/create')],
                            ['label' => \Yii::t('yii', 'Language'), 'url' => ['/site/bahasa'], 'iconStyle' => 'far'],
                            ['label' => \Yii::t('yii', 'Segment'), 'url' => ['/segment/index'], 'iconStyle' => 'far','visible'=>Mimin::checkRoute('segment/index')],
                            ['label' => \Yii::t('yii', 'Barangs'), 'url' => ['/barang/index'], 'iconStyle' => 'far','visible'=>Mimin::checkRoute('barang/index')],
                            ['label' => \Yii::t('yii', 'PO Barangs'), 'url' => ['/barangpo/index'], 'iconStyle' => 'far','visible'=>Mimin::checkRoute('barangpo/index')],
                            ['label' => \Yii::t('yii', 'Company'), 'url' => ['/costumer/index'], 'iconStyle' => 'far'],
                            ['label' => \Yii::t('yii', 'Costumer'), 'url' => ['/person/index'], 'iconStyle' => 'far'],
                            ['label' => \Yii::t('yii', 'Project'), 'url' => ['/project/index'], 'iconStyle' => 'far'],
                            ['label' => \Yii::t('yii', 'Demo'), 'url' => ['/demo/index'], 'iconStyle' => 'far',
                            'visible'=>Mimin::checkRoute('demo/index')],
                            ['label' => \Yii::t('yii', 'Training'), 'url' => ['/training/index'], 'iconStyle' => 'far','visible'=>Mimin::checkRoute('training/index')],
                            ['label' => \Yii::t('yii', 'Join Visit'), 'url' => ['/visit/index'], 'iconStyle' => 'far','visible'=>Mimin::checkRoute('visit/index')],
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