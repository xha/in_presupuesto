<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">Pr</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                <?php  
                    if (Yii::$app->user->isGuest) {
                    } else {
                ?>              
                    <?= Html::a(
                        'Logout (Usuario: '.Yii::$app->user->identity->usuario.', Ubic: '.Yii::$app->user->identity->id_unidad.')',
                        ['/site/logout'],
                        ['data-method' => 'post']
                    ) ?>
                <?php 
                    };
                ?>
                </li>
            </ul>
        </div>
    </nav>
</header>
