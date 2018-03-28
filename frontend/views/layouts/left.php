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
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'icon' => 'circle-o', 'url' => ['../../backend/web/site/login']];
                $menuItems[] = ['label' => 'Registro', 'icon' => 'file-o', 'url' => ['../../backend/web/site/register']];
                $menuItems[] = ['label' => 'Recuperar Usuario', 'icon' => 'unlock', 'url' => ['../../backend/web/site/recuperar']];
            } else {
                $menuItems[] = ['label' => 'Configuración', 'icon' => 'unlock', 'url' => ['../../backend/web/site/']];
                $menuItems[] = ['label' => 'Tablas Básicas', 'icon' => 'folder-o', 'url' => '#',
                                    'items' => [
                                        ['label' => 'Proveedores', 'icon' => 'check', 'url' => ['../../frontend/web/proveedor']],
                                        ['label' => 'Clientes', 'icon' => 'check', 'url' => ['../../frontend/web/cliente']],
                                        ['label' => 'Productos', 'icon' => 'check', 'url' => ['../../frontend/web/producto']],
                                        ['label' => 'Servicios', 'icon' => 'check', 'url' => ['../../frontend/web/servicio']],
                                        ['label' => 'Impuestos', 'icon' => 'check', 'url' => ['../../frontend/web/impuesto']],
                                        ['label' => 'Ubicaciones', 'icon' => 'check', 'url' => ['../../frontend/web/ubicacion']],
                                ],];
                $menuItems[] = ['label' => 'Compras', 'options' => ['class' => 'header']];
                $menuItems[] = ['label' => 'Orden de C/S', 'icon' => 'adjust', 'url' => ['../../frontend/web/compra/?TipoCom=L']];
                $menuItems[] = ['label' => 'Compras', 'icon' => 'balance-scale', 'url' => ['../../frontend/web/compra/?TipoCom=H']];
                $menuItems[] = ['label' => 'Cotizaciones', 'icon' => 'folder-open', 'url' => ['../../frontend/web/compra/?TipoCom=S']];
                $menuItems[] = ['label' => 'Devolución de Compras', 'icon' => 'battery-empty', 'url' => ['../../frontend/web/compra/?TipoCom=I']];
                $menuItems[] = ['label' => 'Notas de Entrega Cp', 'icon' => 'calculator', 'url' => ['../../frontend/web/compra/?TipoCom=J']];
                $menuItems[] = ['label' => 'Devolución de NE Cp', 'icon' => 'folder', 'url' => ['../../frontend/web/compra/?TipoCom=K']];
                $menuItems[] = ['label' => 'Ventas', 'options' => ['class' => 'header']];
                $menuItems[] = ['label' => 'Presupuestos', 'icon' => 'book', 'url' => ['../../frontend/web/venta/?TipoFac=F']];
                $menuItems[] = ['label' => 'Facturación', 'icon' => 'bar-chart', 'url' => ['../../frontend/web/venta/?TipoFac=A']];
                $menuItems[] = ['label' => 'Pedidos', 'icon' => 'star', 'url' => ['../../frontend/web/venta/?TipoFac=E']];
                $menuItems[] = ['label' => 'Devolución de Ventas', 'icon' => 'ban', 'url' => ['../../frontend/web/venta/?TipoFac=B']];
                $menuItems[] = ['label' => 'Notas de Entrega Vta', 'icon' => 'bandcamp', 'url' => ['../../frontend/web/venta/?TipoFac=C']];
                $menuItems[] = ['label' => 'Devolución de NE Vta', 'icon' => 'battery', 'url' => ['../../frontend/web/venta/?TipoFac=D']];
            }
        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $menuItems,
            ]
        ) ?>

    </section>

</aside>
