<style>
/*!
 * Pelicano v1.1.1
 *
 * Copyright 2013 
 */

 @font-face {
font-family: 'GudeaRegular';
src: url('fonts/Gudea-Regular.otf');
font-weight: normal;
font-style: normal;
}
 @font-face {
font-family: 'GudeaItalic';
src: url('fonts/Gudea-Italic.otf');
font-weight: normal;
font-style: normal;
}
 @font-face {
font-family: 'GudeaBold';
src: url('fonts/Gudea-Bold.otf');
font-weight: normal;
font-style: normal;
}
 @font-face {
font-family: 'LatoRegular';
src: url('fonts/Lato-Reg.otf');
font-weight: normal;
font-style: normal;
}

@font-face {
font-family: 'EntypoRegular';
src: url('fonts/entypo-webfont.eot');
src: url('fonts/entypo-webfont.eot?#iefix') format('embedded-opentype'),
     url('fonts/entypo-webfont.woff') format('woff'),
     url('fonts/entypo-webfont.ttf') format('truetype'),
     url('fonts/entypo-webfont.svg#EntypoRegular') format('svg');
font-weight: normal;
font-style: normal;
}

a {
  outline: 0 none !important;
  color:#333 ;
}

a:hover {
  color:#666 ;
}

a:active {
  color:#666 ;
  background-color:none;
}
a:focus {
  color:#666 ;
  background-color:none;
}

a:hover, a:active, a:focus {
	  outline: 0 none !important;
}

i {
  outline: 0 none !important;
}
button {
  outline: 0 none !important;
}

.noMargin{ margin:0px !important;}

.align-left{ text-align:left;}
.align-center{ text-align:center;}
.align-right{ text-align:right;}


.list-group{ margin-left:0px; margin-bottom:0px;}

.list-group .label{ font-size:14px; line-height:26px;}

.panel>.list-group .list-group-item {
min-height: 48px;
line-height: 35px;
}

body{
	font-family: 'GudeaRegular', Arial, sans-serif; 
	font-size:15px;
	cursor:default;
	line-height:inherit;
	color:#333;
	background-color:#ccc;	
	padding-top:125px;
	 }


.container{/*padding: 10px 20px;*/}

.container, .navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container {
width: 100% !important;
max-width: 100% !important;
min-width: 100% !important;
}


.breadcrumb{position: fixed;
top:70px;
right: 0;
left: 0;
margin-right:10px; margin-left:10px; z-index:1050;
}


  /* ----- NEW BUTTONS ------*/
  .btn-primary{
  color: #ffffff;
background-color: #5cb85c;
font-weight:600;
border-color: #5cb85c;
}

  .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary {
color: #ffffff;
background-color: #24D900;
border-color: #24D900;}

.btn-primary.disabled, .btn-primary[disabled], fieldset[disabled] .btn-primary, .btn-primary.disabled:hover, .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary:hover, .btn-primary.disabled:focus, .btn-primary[disabled]:focus, fieldset[disabled] .btn-primary:focus, .btn-primary.disabled:active, .btn-primary[disabled]:active, fieldset[disabled] .btn-primary:active, .btn-primary.disabled.active, .btn-primary[disabled].active, fieldset[disabled] .btn-primary.active {
color:#eee;
background-color: #26ada1;
border-color: #21988e;
}
    .btn-default{
  color: #5cb85c;
background-color: #eee;
border-color: #ddd;
}
.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open .dropdown-toggle.btn-default {
color: #fff;
background-color: #5cb85c;
border-color: #00A395;
}
    .btn-danger{
  color: #d9534f;
background-color: #eee;
border-color: #ddd;
}


.btn-default.disabled, .btn-default[disabled], fieldset[disabled] .btn-default, .btn-default.disabled:hover, .btn-default[disabled]:hover, fieldset[disabled] .btn-default:hover, .btn-default.disabled:focus, .btn-default[disabled]:focus, fieldset[disabled] .btn-default:focus, .btn-default.disabled:active, .btn-default[disabled]:active, fieldset[disabled] .btn-default:active, .btn-default.disabled.active, .btn-default[disabled].active, fieldset[disabled] .btn-default.active {
background-color:#ebebeb;
border-color: #ccc;
color:#888;
}

body.modal-open {
    overflow: hidden;
    overflow'x: hidden;
    overflow'y: hidden;
}

/* end of hack */


/* ------ MAIN MENU / NAV BAR ------- */
.navbar{ min-height:45px;}

ul.nav{ margin-left:0px;}

#Menu{ margin-top: 10px; margin-left:10px; margin-right:10px; border-top: 5px solid #24D900; height:55px;z-index:1060;}
#MenuLogo{
	margin-left: 0px;
font-family: 'LatoRegular', sans-serif;
font-size: 18px;
text-transform: uppercase;
letter-spacing: 1px;
padding: 0px 15px;
line-height:48px;
	}

#Menu .navbar-collapse{ padding-right:0px;}
#Menu .navbar-nav>li>a{padding: 2px 15px;line-height: 45px;}

.popover{width:300px; max-width:300px;}
.popoverButtons{ border-top:1px dotted #ccc; margin-top:10px; padding-top:10px;}
.popoverButtons button{  width:110px; margin-right:10px;}


/* ------ BTN INITIAL FONT SIZES ------- */
.btn{ font-size:15px;}
.btn-lg{ font-size:18px;}
/* ------ END BTN SIZES ------- */

/* ------ BODY / MAIN LAYOUT ------- */
#content {
	/* this line is needed fot center aligning isotope*/
   margin: 0 auto !important;
   margin-left:0px;
}

h2{font-size: 28px;
font-weight: normal;
color: #ccc;
font-family: 'GudeaRegular';
margin:0px;
line-height:auto;
padding-bottom:10px;
 }

h1.pageTitle{font-size: 2em;
font-weight: normal;
color: #fff;
text-align:left;
margin:0px;
line-height:auto; padding-bottom:20px; }

h3{font-size: 24px;
font-weight: 100;
color: #ddd;
margin-bottom:10px; margin-top:10px;text-shadow: 0 1px 3px #000;
font-family:'GudeaRegular', Arial, sans-serif;
}

h3.tableTitle{ color: #666; text-shadow:none; background-color:#eee; padding:10px; margin-bottom:0px;}

.panel-heading h3 { text-shadow:none; color:#333;}
.panel-primary .panel-heading h3 {  color:white;}

.listNumber {
border: 1px solid #333;
border-radius: 15px;
line-height: 25px;
width: 28px;
display: inline-block;
height: 28px;
text-align: center;
font-weight: bold;
margin-right:15px;
}


.listNumber.done{background-color:#5cb85c; border:none; color:white;}

.tableTitle span{ font-size:15px; margin-left:10px; line-height:25px;}

.pageTitleContainer{
padding-bottom:10px;
margin-bottom:10px;}



/* ------ BODY / MAIN LAYOUT ------- */


/*---------- EDIT CREATE FORM -------------*/

.buttonsBottom{border-top: 1px solid #fbfbfb; padding:5px; text-align:right; margin-top:20px;}

.form-group { color:#333;}
.form-group input{font-size:16px; }
.form-group textarea{font-size:16px; }
.form-group label{font-size:15px; color:#333; text-align:right;line-height: 30px;
padding-left: 5px;}

.rowSeparator{ font-size:20px; margin-top:30px;  padding:5px; background-color:rgba(255,255,255,0.4);
color: #666;
text-align: center;
text-transform: uppercase;
font-size: 16px;
letter-spacing: 2px;
font-weight: 600;
}
.noTopMargin{ margin-top:0px;}

a.label-danger{ cursor:pointer;}
a.label-danger:hover{ color:white;}

#screenAgregarProductos table td{ vertical-align:middle;}
#screenAgregarProductos table td label{ vertical-align:middle;}


#screenAgregarProductos .table.tablaIndividual thead>tr>th, #screenAgregarProductos .table.tablaIndividual tbody>tr>th, #screenAgregarProductos .table.tablaIndividual tfoot>tr>th, #screenAgregarProductos .table.tablaIndividual thead>tr>td, #screenAgregarProductos .table.tablaIndividual tbody>tr>td, #screenAgregarProductos .table.tablaIndividual tfoot>tr>td {
padding: 6px 8px;
}

.combined { width:100%;}
.combined select{display:inline-block; width:60%;}
.combined button{display:inline-block; width:35%; margin:0px !important;}

/*---------- END EDIT CREATE FORM -------------*/


/* ------ MODAL CARGAR ------- */

.estadoModal{ margin-top:20px; padding-top:10px; border-top:1px dotted #ccc;}
.estadoModal label{ font-size:17px;}
.estadoModal .alert{ font-size:17px;}

/* ------ END MODAL CARGAR ------- */

  
/* ------ MODAL POPUPS SERIES / PELI DETAIL ------- */
.modal{z-index:1070;}
.modal-title{ font-size:1.6em; color:#666; }
.modal-header {padding: 9px 15px;}
.modal-header .close{padding: 0px; margin-top:0px; line-height:34px;}
.modal-footer {padding: 9px 15px;}
.modal-body{ overflow:hidden;}
.modal-backdrop{z-index:1065;}

/* ------ END MODAL DETAIL ------- */




/* ----- DISPOSITIVOS --------*/
.tablaIndividual{ margin-bottom:20px; background-color:rgba(255,255,255,1); max-height:100px; overflow:auto;}

.devicesSelector{ padding-bottom:10px; margin-bottom:10px;}

#wizardDispositivos h3{ /*margin-top:10px;*/ margin-top:0px;}
.nav-pills.nav-stacked>li>a{border-radius:18px; color:white;}
.nav-pills.nav-stacked>li.active>a{background-color:#eee;color:#333;}
.nav-pills.nav-stacked>li>a:hover{ background-color:#428bca;color:white;}
.nav>li>a.ejectBTN{ width:35px; height:35px; padding:6px; position:absolute; top:3px; right:3px; color: #428bca;
background-color: #fff;}

.table.tablaIndividual { margin-bottom:30px;}
.tablaIndividual .tdPath{font-size:14px;}
.tablePeliTitle{ font-family:'GudeaBold';  font-size:18px;}
.tablaIndividual td button{ margin:5px; margin-left:0px; vertical-align:middle;}
.table.tablaIndividual th{ font-weight:600;  font-size:16px; color:#555; background-color:#ddd;}
.table.tablaIndividual thead>tr>th, .table.tablaIndividual tbody>tr>th, .table.tablaIndividual tfoot>tr>th, .table.tablaIndividual thead>tr>td, .table.tablaIndividual tbody>tr>td, .table.tablaIndividual tfoot>tr>td{vertical-align:middle; padding:5px;}

.table.tablaIndividual thead>tr>th, .table.tablaIndividual tbody>tr>th, .table.tablaIndividual tfoot>tr>th, .table.tablaIndividual thead>tr>td, .table.tablaIndividual tbody>tr>td, .table.tablaIndividual tfoot>tr>td {
padding: 2px 8px;
}


.deviceDropdownName{border:0px none !important; font-size: 24px;padding:5px; border:0px none; 
font-weight: 100;
color: #ddd;
margin:0px;
text-shadow: 0 1px 3px #000;
font-family: 'GudeaRegular', Arial, sans-serif;}
.deviceDropdown i{ margin-left:10px; margin-right:5px;}
.deviceDropdown:hover .deviceDropdownName{}


.deviceDropdownName:hover{background-color:#fff !important;border:0px none; color:#666; text-shadow:none;}
.deviceDropdownName:focus{background-color:#fff !important;border:0px none; color:#666 !important; text-shadow:none;}

.nav-tabs>li>a{font-size:16px; color:white;  font-weight:600;}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{ border:none;}

.nav-tabs>li.active>a{color:#333 !important;}
.nav-tabs>li>a:hover{ color:#666 !important;}

.tab-pane .superBoton{
	position: absolute;
right: 14px;
top: 2px;}

.downloadLink{ cursor:pointer;}
.downloadLink i{ margin-right:5px;}

#wizardDispositivos button{min-width:120px;}

.nav-tabs .dropdown-menu{ font-size:20px;}
/* ----- END DISPOSITIVOS --------*/



/*---------- EDIT PELICULA -------------*/

.editAfiche { text-align:center;}
.editAfiche .aficheImg{width: 200px;
height: 280px; margin-bottom:10px;
}
.editImagesButtons{ text-align:center;}
.editImagesButtons .btn{margin:auto; margin-bottom:10px; 
display: block;
width: 199px;}

.buttonGroup{ margin-top:10px; text-align:right; }
.buttonGroup button{ margin-right:10px;}
#myModalCambiarAfiche .modal-dialog{ width:80%;}

#myModalCambiarAfiche ul.thumbnails.image_picker_selector li{width: 165px; height:240px;
cursor:pointer;}

#myModalCambiarBackdrop ul.thumbnails.image_picker_selector li {width:240px; height:155px;cursor:pointer;}
#myModalCambiarBackdrop .modal-dialog{ width:80%;}

.modal-scroll{ max-height:430px; overflow-y:auto;}
.backdrop-on{ 	

background: no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

ul.thumbnails.image_picker_selector{overflow:hidden;}

#fieldDuracion{ width:78%; display:inline-block;}


.modal .form-group label{font-size:17px; color:#333; text-align:right;}

.form-group select, .form-group ul.select2-choices{
display: block;
width: 100%;
height: 34px;
padding: 6px 12px;
font-size: 16px;
line-height: 1.428571429;
color: #555;
vertical-align: middle;
background-color: #fff;
background-image: none;
border: 1px solid #ccc;
border-radius: 4px;
-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
-webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
.form-group ul.select2-choices{padding:2px;}
.select2-container-multi .select2-choices .select2-search-choice{
line-height:20px;}

.select2-search-choice-close{top:6px; width:13px}

.superContainer{-moz-box-shadow: 0px 0px 2px #000;
-webkit-box-shadow: 0px 0px 2px #000;
box-shadow: 0px 0px 2px rgba(0,0,0,0.8); background-color:rgba(0,0,0,0.5); padding-top:20px; padding-bottom:20px;}


/*---------- END EDIT PELICULA -------------*/


</style>