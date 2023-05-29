<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="peluqueria dacor web">
    <meta name="author" content="david herrera costa">

	<title>Peluqueria Dacor</title>

	<link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    
	<link href="Design/fonts/css/all.min.css" rel="stylesheet" type="text/css">
	<!-- template start bootstrap 2 , v4.6.0-->
    <link href="Design/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="Design/css/main3.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>

</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
				<div class="sidebar-brand-icon rotate-n-15">
				<i class="fas fa-users-cog text-primary"></i>
				</div>
				<div class="sidebar-brand-text mx-3">Peluqueria DACOR<i class="fas fa-exclamation"></i></div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item active">
				<a class="nav-link" href="index.php">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>PANEL ADMINISTRATIVO</span>
				</a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				<span class="text-primary">INFORMACIÓN DE PELUQUEROS & CLIENTES</span>
			</div>


			<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-sharp fa-solid fa-user-group fa-bounce"></i>
                    <span>PERSONAL & CLIENTES</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-info py-2 collapse-inner rounded">
					<a class="collapse-item" href="hairdressers.php"><i class="fa-sharp fa-solid fa-user-tie fa-flip"></i> Personal</a>
					<a class="collapse-item" href="clients.php"><i class="fa-sharp fa-regular fa-circle-user"></i></i> Clientes</a>
                    </div>
                </div>
            </li>

			 <!-- Nav Item - Charts -->
			<li class="nav-item">
				<a class="nav-link" href="hairdressers-schedule.php">
				<i class="fa fa-calendar-days fa-flip"></i>
					<span>Horario del Personal</span>
				</a>
			</li>
			
			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
			<span class="text-primary">CONTROL & GESTIÓN DE SERVICIOS</span>
			</div>

			<!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo2"
                    aria-expanded="true" aria-controls="collapseTwo2">
                    <i class="fa-sharp fa-solid fa-user-group fa-bounce"></i>
                    <span>SERVICIOS DISPONIBLES</span>
                </a>
                <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-info py-2 collapse-inner rounded">
					<a class="collapse-item" href="services.php"><i class="fa fa-clipboard-list"></i> Información de Servicios</a>
					<a class="collapse-item" href="service-categories.php"><i class="fa-solid fa-rectangle-list fa-beat"></i> Categoria de Servicios</a>
                    </div>
                </div>
            </li>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>

		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>

					<!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

					
					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="../" target="_blank">
							<i class="fa-solid fa-right-to-bracket text-success"></i>
								<span class="text-success" style="margin-left: 8px;">Ir a Peluquería Dacor Web</span>
							</a>
						</li>
						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">
									<?php echo $_SESSION['username_hairdressing_Ze422aVVwd1']; ?>
								</span>
								<img class="img-profile rounded-circle"
                                    src="Design/images/admin.png" alt="admin">
							</a>

							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuración
                                </a>
                                <div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Cerrar Sesión
								</a>
							</div>
						</li>
					</ul>
				</nav>
				<!-- End of Topbar -->