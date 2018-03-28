<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php //echo $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form --
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?php
            /*if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'icon' => 'circle-o', 'url' => ['../../backend/web/site/login']];
                $menuItems[] = ['label' => 'Registro', 'icon' => 'file-o', 'url' => ['../../backend/web/site/register']];
                $menuItems[] = ['label' => 'Recuperar Usuario', 'icon' => 'unlock', 'url' => ['../../backend/web/site/recuperar']];
            } else {*/
                $menuItems[] = ['label' => 'Configuración', 'icon' => 'unlock', 'url' => ['../../backend/web/site/']];
                $menuItems[] = ['label' => 'Tablas Básicas', 'icon' => 'folder-o', 'url' => '#',
                                    'items' => [
                                        ['label' => 'Empresa', 'icon' => 'check', 'url' => ['../../frontend/web/empresa/update?id=1']],
                                        ['label' => 'Catálogo Presupuestario', 'icon' => 'check', 'url' => ['../../frontend/web/partida']],
                                        ['label' => 'Clasificación', 'icon' => 'check', 'url' => ['../../frontend/web/clasificacion']],
                                ],];
                //$menuItems[] = ['label' => 'Devolución de NE Vta', 'icon' => 'battery', 'url' => ['../../frontend/web/venta/?TipoFac=D']];
            //}
        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $menuItems,
            ]
        ) ?>

    </section>

</aside>
