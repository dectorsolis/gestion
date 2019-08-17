<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard | Optimización online </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />    
    <!-- Font Awesome -->
    <link href="<?= PATH ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= PATH ?>vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= PATH . 'build/css/custom.css?v=' . rand(0,999999) ?>" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!--Custom Datatable css -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
    
    <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="/gestion/public/assets/js/functions-optimizacion.js?v=4.0.2"></script>    
    <script type="text/javascript" src="<?= PATH . 'build/js/ajax-request.js?v=4.0.1' ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
    <!-- include summernote css/js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed mCustomScrollbar _mCS_1 mCS-autoHide">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0; margin-top:10px;">
              <a href="index.html" class="site_title">  
                <img src="<?= PATH ?>img/logo_big.png" width="55px"> <span>S.I.G.O</span>
                <center><small>Sistema de Información General Optimización</small></center>
              </a>
              
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img class="img-circle profile_img" src="<?= gravatar( $data['user']['username'] , 140); ?>">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?= $data['user']['nombre'] ?></h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <?php if( !empty($data['sidebar']) ): ?>
                  <?php require_once VIEWS . $data['sidebar'] . '.php'; ?>
                <?php endif; ?>
              </div>
             

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?= $data['user']['nombre']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href=" <?= PATH . 'usuarios/perfil/'; ?> ">Perfil</a></li>
                   
                    <li><a href=" <?= PATH . 'login/logout/'; ?> "><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-2x fa-ticket"></i>
                    <span class="badge bg-green"></span>
                  </a>
                  <ul id="menu1" class="ticket-alerts dropdown-menu list-unstyled msg_list" role="menu">
                  
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
           

            <div class="clearfix"></div>



            
                  