<?php include('protect.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Stay organized with our user-friendly Calendar featuring events, reminders, and a customizable interface. Built with HTML, CSS, and JavaScript. Start scheduling today!"
    />
    <meta
      name="keywords"
      content="calendar, events, reminders, javascript, html, css, open source coding"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- CSS -->
	<style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Quicksand:wght@600&display=swap');

* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

a {
	text-decoration: none;
}

li {
	list-style: none;
}

:root {
	--quicksand: 'Quicksand', sans-serif;
	--bebas: 'Bebas Neue', sans-serif;

	--preto: #000000;
    --cinzaescuro: #333333;
    --dark-grey: #AAAAAA;
    --branco: #fff;
    --red: #DB504A;

    /* ICONS */
    --azulescuro: #1a237e;
    --azulescuroclaro: #4d549b;
    --verdeesmeralda: #2ecc71;
    --verdeesmeraldaclaro: #87ca9e;
    --laranja: #f39c12;
    --laranjaclaro: #f7c877;
    --rosa: #e91e63; 
    --rosaclaro: #f17a9b;
    --roxo: #9b59b6; 
    --roxoclaro: #c49ec6;
    --vermelho: #e74c3c; 
    --vermelhoclaro: #ef9a8c;
    --amarelo: #f1c40f;
    --amareloclaro: #f8dc8e;
    --azulclaro: #3498db;
    --azulclaroclaro: #7fc4e8;
    --verdelimao: #c1e460; 
    --verdelimaoclaro: #e3eeb0;
    --azulceleste: #00bcd4;
    --azulcelesteclaro: #8ed4dd;
    --marrom: #795548; 
    --marromclaro: #ae9f94;
    --cinza: #95a5a6; 
    --cinzaclaro: #c4cdcf;

    /* CALENDAR COLORS */
    --color-weekdays: var(--branco);
    --color-day: var(--azulescuro);
    --hover: var(--azulescuroclaro);
    --box-shadow: var(--cinzaescuro);
    --current-day: var(--rosaclaro);
    --event-color: var(--laranja);
    --modal-event: var(--preto);
    --header-color: var(--azulclaro);
    --header-button: var(--laranjaclaro);
    --body-color: var(--preto);
}

html {
	overflow-x: hidden;
}

body {
	background: var(--cinzaescuro);
	overflow-x: hidden;
  text-transform: uppercase;
}





/* SIDEBAR */
#sidebar {
	position: fixed;
	top: 0;
	left: 0;
	width: 280px;
	height: 100%;
	background: var(--preto);
	z-index: 2000;
	font-family: var(--bebas);
	transition: .3s ease;
	overflow-x: hidden;
	scrollbar-width: none;
}
#sidebar::--webkit-scrollbar {
	display: none;
}
#sidebar.hide {
	width: 60px;
}
#sidebar .brand {
	font-size: 24px;
	font-weight: 700;
	height: 56px;
	display: flex;
	align-items: center;
	color: var(--azulclaro);
	position: sticky;
	top: 0;
	left: 0;
	background: var(--preto);
	z-index: 500;
	padding-bottom: 20px;
	box-sizing: content-box;
}
#sidebar .brand .bx {
	min-width: 60px;
	display: flex;
	justify-content: center;
}
.logo-img {
  width: 60px;
  height: auto;
}
#sidebar .side-menu {
	width: 100%;
	margin-top: 48px;
}
#sidebar .side-menu li {
	height: 48px;
	background: transparent;
	margin-left: 6px;
	border-radius: 48px 0 0 48px;
	padding: 4px;
}
#sidebar .side-menu li.active {
	background: var(--cinzaescuro);
	position: relative;
}
#sidebar .side-menu li.active::before {
	content: '';
	position: absolute;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	top: -40px;
	right: 0;
	box-shadow: 20px 20px 0 var(--cinzaescuro);
	z-index: -1;
}
#sidebar .side-menu li.active::after {
	content: '';
	position: absolute;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	bottom: -40px;
	right: 0;
	box-shadow: 20px -20px 0 var(--cinzaescuro);
	z-index: -1;
}
#sidebar .side-menu li a {
	width: 100%;
	height: 100%;
	background: var(--preto);
	display: flex;
	align-items: center;
	border-radius: 48px;
	font-size: 18px;
	color: var(--branco);
	white-space: nowrap;
	overflow-x: hidden;
	padding: 0 9px;
}
#sidebar .side-menu.top li.active a {
	color: var(--azulclaro);
}
#sidebar.hide .side-menu li a {
	width: calc(48px - (4px * 2));
	transition: width .3s ease;
}
#sidebar .side-menu li a.logout {
	color: var(--red);
}
#sidebar .side-menu.top li a:hover {
	color: var(--azulclaro);
}
#sidebar .side-menu li a .bx {
	min-width: calc(60px  - ((4px + 6px) * 2));
	display: flex;
	justify-content: center;
}
#sidebar .side-menu li a .text {
  	margin-left: 16px;
}
/* SIDEBAR */





/* CONTENT */
#content {
	position: relative;
	width: calc(100% - 280px);
	left: 280px;
	transition: .3s ease;
}
#sidebar.hide ~ #content {
	width: calc(100% - 60px);
	left: 60px;
}




/* NAVBAR */
#content nav {
	height: 56px;
	background: var(--preto);
	padding: 0 24px;
	display: flex;
	align-items: center;
	grid-gap: 24px;
	font-family: var(--bebas);
	position: sticky;
	top: 0;
	left: 0;
	z-index: 1000;
}
#content nav::before {
	content: '';
	position: absolute;
	width: 40px;
	height: 40px;
	bottom: -40px;
	left: 0;
	border-radius: 50%;
	box-shadow: -20px -20px 0 var(--preto);
}
#content nav a {
	color: var(--branco);
}
#content nav .bx.bx-menu {
	cursor: pointer;
	color: var(--branco);
}
#content nav .nav-link {
	font-size: 16px;
	transition: .3s ease;
}
#content nav .nav-link:hover {
	color: var(--azulclaro);
}
#content nav form {
	max-width: 400px;
	width: 100%;
	margin-right: auto;
}
/* NAVBAR */





/* MAIN */
#content main {
	width: 100%;
	padding: 36px 24px;
	font-family: var(--quicksand);
	max-height: calc(100vh - 56px);
	overflow-y: auto;
}
#content main .head-title {
	display: flex;
	align-items: center;
	justify-content: space-between;
	grid-gap: 16px;
	flex-wrap: wrap;
}
#content main .head-title .left h1 {
	font-size: 36px;
	font-weight: 600;
	margin-bottom: 10px;
	color: var(--branco);
}
#content main .head-title .left .breadcrumb {
	display: flex;
	align-items: center;
	grid-gap: 16px;
}
#content main .head-title .left .breadcrumb li {
	color: var(--branco);
}
#content main .head-title .left .breadcrumb li a {
	color: var(--dark-grey);
	pointer-events: none;
}
#content main .head-title .left .breadcrumb li a.active {
	color: var(--azulclaro);
	pointer-events: unset;
}



.container {
  position: relative;
  width: 100%;
  min-height: 850px;
  margin: 0 auto;
  padding: 5px;
  color: #fff;
  display: flex;
  border-radius: 10px;
  background-color: black;
}
.left {
  width: 60%;
  padding: 20px;
}
.calendar {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  justify-content: space-between;
  color: #878895;
  border-radius: 5px;
  background-color: #fff;
}
/* set after behind the main element */
.calendar::before,
.calendar::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 100%;
  width: 12px;
  height: 97%;
  border-radius: 0 5px 5px 0;
  background-color: #d3d4d6d7;
  transform: translateY(-50%);
}
.calendar::before {
  height: 94%;
  left: calc(100% + 12px);
  background-color: rgb(153, 153, 153);
}
.calendar .month {
  width: 100%;
  height: 150px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 50px;
  font-size: 1.2rem;
  font-weight: 500;
  text-transform: capitalize;
}
.calendar .month .prev,
.calendar .month .next {
  cursor: pointer;
}
.calendar .month .prev:hover,
.calendar .month .next:hover {
  color: var(--azulclaro);
}
.calendar .weekdays {
  width: 100%;
  height: 100px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 20px;
  font-size: 1rem;
  font-weight: 500;
  text-transform: capitalize;
}
.weekdays div {
  width: 14.28%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.calendar .days {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  padding: 0 20px;
  font-size: 1rem;
  font-weight: 500;
  margin-bottom: 20px;
}
.calendar .days .day {
  width: 14.28%;
  height: 90px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: var(--preto);
  border: 1px solid #f5f5f5;
}
.calendar .days .day:nth-child(7n + 1) {
  border-left: 2px solid #f5f5f5;
}
.calendar .days .day:nth-child(7n) {
  border-right: 2px solid #f5f5f5;
}
.calendar .days .day:nth-child(-n + 7) {
  border-top: 2px solid #f5f5f5;
}
.calendar .days .day:nth-child(n + 29) {
  border-bottom: 2px solid #f5f5f5;
}

.calendar .days .day:not(.prev-date, .next-date):hover {
  color: #fff;
  background-color: var(--azulclaro);
}
.calendar .days .prev-date,
.calendar .days .next-date {
  color: #b3b3b3;
}
.calendar .days .active {
  position: relative;
  font-size: 2rem;
  color: #fff;
  background-color: var(--azulclaro);
}
.calendar .days .active::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  box-shadow: 0 0 10px 2px var(--azulclaro);
}
.calendar .days .today {
  font-size: 2rem;
}
.calendar .days .event {
  position: relative;
}
.calendar .days .event::after {
  content: "";
  position: absolute;
  bottom: 10%;
  left: 50%;
  width: 75%;
  height: 6px;
  border-radius: 30px;
  transform: translateX(-50%);
  background-color: var(--azulclaro);
}
.calendar .days .day:hover.event::after {
  background-color: #fff;
}
.calendar .days .active.event::after {
  background-color: #fff;
  bottom: 20%;
}
.calendar .days .active.event {
  padding-bottom: 10px;
}
.calendar .goto-today {
  width: 100%;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 5px;
  padding: 0 20px;
  margin-bottom: 20px;
  color: var(--azulclaro);
}
.calendar .goto-today .goto {
  display: flex;
  align-items: center;
  border-radius: 5px;
  overflow: hidden;
  border: 1px solid var(--azulclaro);
}
.calendar .goto-today .goto input {
  width: 100%;
  height: 30px;
  outline: none;
  border: none;
  border-radius: 5px;
  padding: 0 20px;
  color: var(--azulclaro);
  border-radius: 5px;
}
.calendar .goto-today button {
  padding: 5px 10px;
  border: 1px solid var(--azulclaro);
  border-radius: 5px;
  background-color: transparent;
  cursor: pointer;
  color: var(--azulclaro);
}
.calendar .goto-today button:hover {
  color: #fff;
  background-color: var(--azulclaroclaro);
}
.calendar .goto-today .goto button {
  border: none;
  border-left: 1px solid var(--azulclaro);
  border-radius: 0;
}
.container .right {
  position: relative;
  width: 40%;
  min-height: 100%;
  padding: 20px 0;
}

.right .today-date {
  width: 100%;
  height: 50px;
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  align-items: center;
  justify-content: space-between;
  padding: 0 40px;
  padding-left: 70px;
  margin-top: 50px;
  margin-bottom: 20px;
  text-transform: capitalize;
}
.right .today-date .event-day {
  font-size: 2rem;
  font-weight: 500;
}
.right .today-date .event-date {
  font-size: 1rem;
  font-weight: 400;
  color: #878895;
}
.events {
  width: 100%;
  height: 100%;
  max-height: 600px;
  overflow-x: hidden;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  padding-left: 4px;
}
.events .event {
  position: relative;
  width: 95%;
  min-height: 70px;
  display: flex;
  justify-content: center;
  flex-direction: column;
  gap: 5px;
  padding: 0 20px;
  padding-left: 50px;
  color: #fff;
  background: linear-gradient(90deg, #3f4458, transparent);
  cursor: pointer;
}
/* even event */
.events .event:nth-child(even) {
  background: transparent;
}
.events .event:hover {
  background: linear-gradient(90deg, var(--azulclaro), transparent);
}
.events .event .title {
  display: flex;
  align-items: center;
  pointer-events: none;
}
.events .event .title .event-title {
  font-size: 1rem;
  font-weight: 400;
  margin-left: 20px;
}
.events .event i {
  color: var(--azulclaro);
  font-size: 0.5rem;
}
.events .event:hover i {
  color: #fff;
}
.events .event .event-time {
  font-size: 0.8rem;
  font-weight: 400;
  color: #878895;
  margin-left: 15px;
  pointer-events: none;
}
.events .event:hover .event-time {
  color: #fff;
}
/* add tick in event after */
.events .event::after {
  content: "✓";
  position: absolute;
  top: 50%;
  right: 0;
  font-size: 3rem;
  line-height: 1;
  display: none;
  align-items: center;
  justify-content: center;
  opacity: 0.3;
  color: var(--azulclaro);
  transform: translateY(-50%);
}
.events .event:hover::after {
  display: flex;
}
.add-event {
  position: absolute;
  bottom: 30px;
  right: 30px;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
  color: #878895;
  border: 2px solid #878895;
  opacity: 0.5;
  border-radius: 50%;
  background-color: transparent;
  cursor: pointer;
}
.add-event:hover {
  opacity: 1;
}
.add-event i {
  pointer-events: none;
}
.events .no-event {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  font-weight: 500;
  color: #878895;
}
.add-event-wrapper {
  position: absolute;
  bottom: 100px;
  left: 50%;
  width: 90%;
  max-height: 0;
  overflow: hidden;
  border-radius: 5px;
  background-color: #fff;
  transform: translateX(-50%);
  transition: max-height 0.5s ease;
}
.add-event-wrapper.active {
  max-height: 300px;
}
.add-event-header {
  width: 100%;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 20px;
  color: #373c4f;
  border-bottom: 1px solid #f5f5f5;
}
.add-event-header .close {
  font-size: 1.5rem;
  cursor: pointer;
}
.add-event-header .close:hover {
  color: var(--azulclaro);
}
.add-event-header .title {
  font-size: 1.2rem;
  font-weight: 500;
}
.add-event-body {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  gap: 5px;
  padding: 20px;
}
.add-event-body .add-event-input {
  width: 100%;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}
.add-event-body .add-event-input input {
  width: 100%;
  height: 100%;
  outline: none;
  border: none;
  border-bottom: 1px solid #f5f5f5;
  padding: 0 10px;
  font-size: 1rem;
  font-weight: 400;
  color: #373c4f;
}
.add-event-body .add-event-input input::placeholder {
  color: #a5a5a5;
}
.add-event-body .add-event-input input:focus {
  border-bottom: 1px solid var(--azulclaro);
}
.add-event-body .add-event-input input:focus::placeholder {
  color: var(--azulclaro);
}
.add-event-footer {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}
.add-event-footer .add-event-btn {
  height: 40px;
  font-size: 1rem;
  font-weight: 500;
  outline: none;
  border: none;
  color: #fff;
  background-color: var(--azulclaro);
  border-radius: 5px;
  cursor: pointer;
  padding: 5px 10px;
  border: 1px solid var(--azulclaro);
}
.add-event-footer .add-event-btn:hover {
  background-color: var(--azulclaroclaro);
  color: transparent;
}

/* media queries */

@media screen and (max-width: 1000px) {
  body {
    align-items: flex-start;
    justify-content: flex-start;
  }
  .container {
    min-height: 100vh;
    flex-direction: column;
    border-radius: 0;
  }
  .container .left {
    width: 100%;
    height: 100%;
    padding: 20px 0;
  }
  .container .right {
    width: 100%;
    height: 100%;
    padding: 20px 0;
  }
  .calendar::before,
  .calendar::after {
    top: 100%;
    left: 50%;
    width: 97%;
    height: 12px;
    border-radius: 0 0 5px 5px;
    transform: translateX(-50%);
  }
  .calendar::before {
    width: 94%;
    top: calc(100% + 12px);
  }
  .events {
    padding-bottom: 340px;
  }
  .add-event-wrapper {
    bottom: 100px;
  }
}
@media screen and (max-width: 500px) {
  .calendar .month {
    height: 75px;
  }
  .calendar .weekdays {
    height: 50px;
  }
  .calendar .days .day {
    height: 40px;
    font-size: 0.8rem;
  }
  .calendar .days .day.active,
  .calendar .days .day.today {
    font-size: 1rem;
  }
  .right .today-date {
    padding: 20px;
  }
}
/* MAIN */
/* CONTENT */









@media screen and (max-width: 768px) {
	#sidebar {
		width: 200px;
	}

	#content {
		width: calc(100% - 60px);
		left: 200px;
	}

	#content nav .nav-link {
		display: none;
	}
}






@media screen and (max-width: 576px) {
	#content nav form .form-input input {
		display: none;
	}

	#content nav form .form-input button {
		width: auto;
		height: auto;
		background: transparent;
		border-radius: none;
		color: var(--branco);
	}

	#content nav form.show .form-input input {
		display: block;
		width: 100%;
	}
	#content nav form.show .form-input button {
		width: 36px;
		height: 100%;
		border-radius: 0 36px 36px 0;
		color: var(--preto);
		background: var(--vermelho);
	}

	#content nav form.show ~ .notification,
	#content nav form.show ~ .profile {
		display: none;
	}

	#content main .box-info {
		grid-template-columns: 1fr;
	}

	#content main .table-data .head {
		min-width: 420px;
	}
	#content main .table-data .order table {
		min-width: 420px;
	}
	#content main .table-data .todo .todo-list {
		min-width: 420px;
	}
}
    </style>

	<title>Vidraçaria Lucas ◈ Agenda</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
            <img src="assets/imgs/logo.png" class="logo-img">
			<span class="text">Vidraçaria Lucas</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="home.php">
					<i class="fa-solid fa-house"></i>
					<span class="text">Home</span>
				</a>
			</li>
			<li>
				<a href="clientes.php">
					<i class="fa-solid fa-users"></i>
					<span class="text">Clientes</span>
				</a>
			</li>
			<li>
				<a href="produtos.php">
					<i class="fa-solid fa-boxes-stacked"></i>
					<span class="text">Produtos</span>
				</a>
			</li>
			<li>
				<a href="funcionarios.php">
					<i class="fa-solid fa-users-gear"></i>
					<span class="text">Funcionários</span>
				</a>
			</li>
			<li>
				<a href="fornecedores.php">
					<i class="fa-solid fa-truck-fast"></i>
					<span class="text">Fornecedores</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="logout.php" class="logout">
                    <span class="icon"><i class="fa-solid fa-person-through-window"></i></span>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Teste</a>
			<form action="#">
			</form>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Calendário</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Agenda</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="home.php">Voltar</a>
						</li>
					</ul>
				</div>
			</div>

    <div class="container">
      <div class="left">
        <div class="calendar">
          <div class="month">
            <i class="fas fa-angle-left prev"></i>
            <div class="date">Agosto 2023</div>
            <i class="fas fa-angle-right next"></i>
          </div>
          <div class="weekdays">
            <div>Dom</div>
            <div>Seg</div>
            <div>Ter</div>
            <div>Qua</div>
            <div>Qui</div>
            <div>Sex</div>
            <div>Sáb</div>
          </div>
          <div class="days"></div>
          <div class="goto-today">
            <div class="goto">
              <input type="text" placeholder="mês/ano" class="date-input" />
              <button class="goto-btn">Ir</button>
            </div>
            <button class="today-btn">Hoje</button>
          </div>
        </div>
      </div>
      <div class="right">
        <div class="today-date">
          <div class="event-day">Sex</div>
          <div class="event-date">18 de Outubro de 2023</div>
        </div>
        <div class="events"></div>
        <div class="add-event-wrapper">
          <div class="add-event-header">
            <div class="title">Adicionar</div>
            <i class="fas fa-times close"></i>
          </div>
          <div class="add-event-body">
            <div class="add-event-input">
              <input type="text" placeholder="Compromisso" class="event-name" />
            </div>
            <div class="add-event-input">
              <input
                type="text"
                placeholder="Horário de Início:"
                class="event-time-from"
              />
            </div>
            <div class="add-event-input">
              <input
                type="text"
                placeholder="Horário de Término:"
                class="event-time-to"
              />
            </div>
          </div>
          <div class="add-event-footer">
            <button class="add-event-btn">Adicionar</button>
          </div>
        </div>
      </div>
      <button class="add-event">
        <i class="fas fa-plus"></i>
      </button>
    </div>

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script>
        const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})
    </script>

<script>
const calendar = document.querySelector(".calendar"),
  date = document.querySelector(".date"),
  daysContainer = document.querySelector(".days"),
  prev = document.querySelector(".prev"),
  next = document.querySelector(".next"),
  todayBtn = document.querySelector(".today-btn"),
  gotoBtn = document.querySelector(".goto-btn"),
  dateInput = document.querySelector(".date-input"),
  eventDay = document.querySelector(".event-day"),
  eventDate = document.querySelector(".event-date"),
  eventsContainer = document.querySelector(".events"),
  addEventBtn = document.querySelector(".add-event"),
  addEventWrapper = document.querySelector(".add-event-wrapper "),
  addEventCloseBtn = document.querySelector(".close "),
  addEventTitle = document.querySelector(".event-name "),
  addEventFrom = document.querySelector(".event-time-from "),
  addEventTo = document.querySelector(".event-time-to "),
  addEventSubmit = document.querySelector(".add-event-btn ");

let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();

const months = [
  "Janeiro",
  "Fevereiro",
  "Março",
  "Abril",
  "Maio",
  "Junho",
  "Julho",
  "Agosto",
  "Setembro",
  "Outubro",
  "Novembro",
  "Dezembro",
];

const daysOfWeek = [
    "Dom",
    "Seg",
    "Ter",
    "Qua",
    "Qui",
    "Sex",
    "Sáb",
];

// const eventsArr = [
//   {
//     day: 13,
//     month: 11,
//     year: 2022,
//     events: [
//       {
//         title: "Event 1 lorem ipsun dolar sit genfa tersd dsad ",
//         time: "10:00 AM",
//       },
//       {
//         title: "Event 2",
//         time: "11:00 AM",
//       },
//     ],
//   },
// ];

const eventsArr = [];
getEvents();
console.log(eventsArr);

//function to add days in days with class day and prev-date next-date on previous month and next month days and active on today
function initCalendar() {
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const prevLastDay = new Date(year, month, 0);
  const prevDays = prevLastDay.getDate();
  const lastDate = lastDay.getDate();
  const day = firstDay.getDay();
  const nextDays = 7 - lastDay.getDay() - 1;

  date.innerHTML = months[month] + " " + year;

  let days = "";

  for (let x = day; x > 0; x--) {
    days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDate; i++) {
    //check if event is present on that day
    let event = false;
    eventsArr.forEach((eventObj) => {
      if (
        eventObj.day === i &&
        eventObj.month === month + 1 &&
        eventObj.year === year
      ) {
        event = true;
      }
    });
    if (
      i === new Date().getDate() &&
      year === new Date().getFullYear() &&
      month === new Date().getMonth()
    ) {
      activeDay = i;
      getActiveDay(i);
      updateEvents(i);
      if (event) {
        days += `<div class="day today active event">${i}</div>`;
      } else {
        days += `<div class="day today active">${i}</div>`;
      }
    } else {
      if (event) {
        days += `<div class="day event">${i}</div>`;
      } else {
        days += `<div class="day ">${i}</div>`;
      }
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="day next-date">${j}</div>`;
  }
  daysContainer.innerHTML = days;
  addListner();
}

//function to add month and year on prev and next button
function prevMonth() {
  month--;
  if (month < 0) {
    month = 11;
    year--;
  }
  initCalendar();
}

function nextMonth() {
  month++;
  if (month > 11) {
    month = 0;
    year++;
  }
  initCalendar();
}

prev.addEventListener("click", prevMonth);
next.addEventListener("click", nextMonth);

initCalendar();

//function to add active on day
function addListner() {
  const days = document.querySelectorAll(".day");
  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      getActiveDay(e.target.innerHTML);
      updateEvents(Number(e.target.innerHTML));
      activeDay = Number(e.target.innerHTML);
      //remove active
      days.forEach((day) => {
        day.classList.remove("active");
      });
      //if clicked prev-date or next-date switch to that month
      if (e.target.classList.contains("prev-date")) {
        prevMonth();
        //add active to clicked day afte month is change
        setTimeout(() => {
          //add active where no prev-date or next-date
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("prev-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else if (e.target.classList.contains("next-date")) {
        nextMonth();
        //add active to clicked day afte month is changed
        setTimeout(() => {
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("next-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else {
        e.target.classList.add("active");
      }
    });
  });
}

todayBtn.addEventListener("click", () => {
  today = new Date();
  month = today.getMonth();
  year = today.getFullYear();
  
  init
initCalendar();
});

dateInput.addEventListener("input", (e) => {
  dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
  if (dateInput.value.length === 2) {
    dateInput.value += "/";
  }
  if (dateInput.value.length > 7) {
    dateInput.value = dateInput.value.slice(0, 7);
  }
  if (e.inputType === "deleteContentBackward") {
    if (dateInput.value.length === 3) {
      dateInput.value = dateInput.value.slice(0, 2);
    }
  }
});

gotoBtn.addEventListener("click", gotoDate);

function gotoDate() {
  console.log("here");
  const dateArr = dateInput.value.split("/");
  if (dateArr.length === 2) {
    if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
      month = dateArr[0] - 1;
      year = dateArr[1];
      initCalendar();
      return;
    }
  }
  alert("Data Inválida");
}

//function get active day day name and date and update eventday eventdate
function getActiveDay(date) {
  const day = new Date(year, month, date);
  const dayName = day.toString().split(" ")[0];
  eventDay.innerHTML = dayName;
  eventDate.innerHTML = date + " " + months[month] + " " + year;
}

//function update events when a day is active
function updateEvents(date) {
  let events = "";
  eventsArr.forEach((event) => {
    if (
      date === event.day &&
      month + 1 === event.month &&
      year === event.year
    ) {
      event.events.forEach((event) => {
        events += `<div class="event">
            <div class="title">
              <i class="fas fa-circle"></i>
              <h3 class="event-title">${event.title}</h3>
            </div>
            <div class="event-time">
              <span class="event-time">${event.time}</span>
            </div>
        </div>`;
      });
    }
  });
  if (events === "") {
    events = `<div class="no-event">
            <h3>Sem Compromissos</h3>
        </div>`;
  }
  eventsContainer.innerHTML = events;
  saveEvents();
}

//function to add event
addEventBtn.addEventListener("click", () => {
  addEventWrapper.classList.toggle("active");
});

addEventCloseBtn.addEventListener("click", () => {
  addEventWrapper.classList.remove("active");
});

document.addEventListener("click", (e) => {
  if (e.target !== addEventBtn && !addEventWrapper.contains(e.target)) {
    addEventWrapper.classList.remove("active");
  }
});

//allow 50 chars in eventtitle
addEventTitle.addEventListener("input", (e) => {
  addEventTitle.value = addEventTitle.value.slice(0, 60);
});

function defineProperty() {
  var osccred = document.createElement("div");
  osccred.innerHTML =
  osccred.style.position = "absolute";
  osccred.style.bottom = "0";
  osccred.style.right = "0";
  osccred.style.fontSize = "10px";
  osccred.style.color = "#ccc";
  osccred.style.fontFamily = "sans-serif";
  osccred.style.padding = "5px";
  osccred.style.background = "#fff";
  osccred.style.borderTopLeftRadius = "5px";
  osccred.style.borderBottomRightRadius = "5px";
  osccred.style.boxShadow = "0 0 5px #ccc";
  document.body.appendChild(osccred);
}

defineProperty();

//allow only time in eventtime from and to
addEventFrom.addEventListener("input", (e) => {
  addEventFrom.value = addEventFrom.value.replace(/[^0-9:]/g, "");
  if (addEventFrom.value.length === 2) {
    addEventFrom.value += ":";
  }
  if (addEventFrom.value.length > 5) {
    addEventFrom.value = addEventFrom.value.slice(0, 5);
  }
});

addEventTo.addEventListener("input", (e) => {
  addEventTo.value = addEventTo.value.replace(/[^0-9:]/g, "");
  if (addEventTo.value.length === 2) {
    addEventTo.value += ":";
  }
  if (addEventTo.value.length > 5) {
    addEventTo.value = addEventTo.value.slice(0, 5);
  }
});

//function to add event to eventsArr
addEventSubmit.addEventListener("click", () => {
  const eventTitle = addEventTitle.value;
  const eventTimeFrom = addEventFrom.value;
  const eventTimeTo = addEventTo.value;
  if (eventTitle === "" || eventTimeFrom === "" || eventTimeTo === "") {
    alert("Por favor, preencha todos os campos.");
    return;
  }

  //check correct time format 24 hour
  const timeFromArr = eventTimeFrom.split(":");
  const timeToArr = eventTimeTo.split(":");
  if (
    timeFromArr.length !== 2 ||
    timeToArr.length !== 2 ||
    timeFromArr[0] > 23 ||
    timeFromArr[1] > 59 ||
    timeToArr[0] > 23 ||
    timeToArr[1] > 59
  ) {
    alert("Formato de hora inválido.");
    return;
  }

  const timeFrom = convertTime(eventTimeFrom);
  const timeTo = convertTime(eventTimeTo);

  //check if event is already added
  let eventExist = false;
  eventsArr.forEach((event) => {
    if (
      event.day === activeDay &&
      event.month === month + 1 &&
      event.year === year
    ) {
      event.events.forEach((event) => {
        if (event.title === eventTitle) {
          eventExist = true;
        }
      });
    }
  });
  if (eventExist) {
    alert("Compromisso adicionado.");
    return;
  }
  const newEvent = {
    title: eventTitle,
    time: timeFrom + " - " + timeTo,
  };
  console.log(newEvent);
  console.log(activeDay);
  let eventAdded = false;
  if (eventsArr.length > 0) {
    eventsArr.forEach((item) => {
      if (
        item.day === activeDay &&
        item.month === month + 1 &&
        item.year === year
      ) {
        item.events.push(newEvent);
        eventAdded = true;
      }
    });
  }

  if (!eventAdded) {
    eventsArr.push({
      day: activeDay,
      month: month + 1,
      year: year,
      events: [newEvent],
    });
  }

  console.log(eventsArr);
  addEventWrapper.classList.remove("active");
  addEventTitle.value = "";
  addEventFrom.value = "";
  addEventTo.value = "";
  updateEvents(activeDay);
  //select active day and add event class if not added
  const activeDayEl = document.querySelector(".day.active");
  if (!activeDayEl.classList.contains("event")) {
    activeDayEl.classList.add("event");
  }
});

//function to delete event when clicked on event
eventsContainer.addEventListener("click", (e) => {
  if (e.target.classList.contains("event")) {
    if (confirm("Tem certeza que deseja deletar este evento?")) {
      const eventTitle = e.target.children[0].children[1].innerHTML;
      eventsArr.forEach((event) => {
        if (
          event.day === activeDay &&
          event.month === month + 1 &&
          event.year === year
        ) {
          event.events.forEach((item, index) => {
            if (item.title === eventTitle) {
              event.events.splice(index, 1);
            }
          });
          //if no events left in a day then remove that day from eventsArr
          if (event.events.length === 0) {
            eventsArr.splice(eventsArr.indexOf(event), 1);
            //remove event class from day
            const activeDayEl = document.querySelector(".day.active");
            if (activeDayEl.classList.contains("event")) {
              activeDayEl.classList.remove("event");
            }
          }
        }
      });
      updateEvents(activeDay);
    }
  }
});

//function to save events in local storage
function saveEvents() {
  localStorage.setItem("events", JSON.stringify(eventsArr));
}

//function to get events from local storage
function getEvents() {
  //check if events are already saved in local storage then return event else nothing
  if (localStorage.getItem("events") === null) {
    return;
  }
  eventsArr.push(...JSON.parse(localStorage.getItem("events")));
}

function convertTime(time) {
  //convert time to 24 hour format
  let timeArr = time.split(":");
  let timeHour = timeArr[0];
  let timeMin = timeArr[1];
  let timeFormat = timeHour >= 12 ? "PM" : "AM";
  timeHour = timeHour % 12 || 12;
  time = timeHour + ":" + timeMin + " " + timeFormat;
  return time;
}
</script>

</body>
</html>