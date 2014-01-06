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
.block{display:block !important;}
.inline{display:inline !important;}
.inlineBlock{display:inline-block !important;}

.align-left{ text-align:left !important;}
.align-center{ text-align:center !important;}
.align-right{ text-align:right !important;}

.bold{ font-weight:600;}
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
	padding-top:85px;
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
.btn-sm{ font-size:13px;}
/* ------ END BTN SIZES ------- */

/* ------ BODY / MAIN LAYOUT ------- */
#content {
	/* this line is needed fot center aligning isotope*/
   margin: 0 auto !important;
   margin-left:0px;
}

h2{font-size: 28px;
font-weight: normal;
color: greens;
font-family: 'GudeaRegular';
margin:0px;
line-height:auto;
color:green;
margin-bottom:15px;
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

.panel .table.tablaIndividual{ margin-bottom:0px;}
.panel-body{ padding:10px;}


.marginLeft{margin-left:10px;}

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

.dropdown-menu{ text-align:left;}


.grid-view {padding: 0px; margin-bottom:50px;}
.grid-view .summary{ display:none;}

.grid-view  input{
border-radius:3px; border:1px solid #ccc;
color:#666;
padding:2px;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
}


.nav-tabs>li>a{font-size:16px; color:white;  font-weight:600;}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{ border:none;}

.nav-tabs>li.active>a{color:#333 !important;}
.nav-tabs>li>a:hover{ color:#666 !important;}

.grid-view .sort-link{background-image:url(images/sort-desc.png); background-repeat:no-repeat; background-position:right; padding-right:20px;}

.grid-view .sort-link.asc{background-image:url(images/sort-asc.png); background-repeat:no-repeat; background-position:right; padding-right:20px;}
.grid-view .sort-link.desc{background-image:url(images/sort-desc.png); background-repeat:no-repeat; background-position:right; padding-right:20px;}

/* ------ END BODY / MAIN LAYOUT ------- */

/* ------ PAGINADOR------- */
ul.yiiPager .page a {
font-weight: normal;
height: 32px;
width: 30px;
margin: 0px;
font-size: 16px;
border-radius: 4px;
line-height: 26px;
text-align: center;
color: #5cb85c;
background-color: #fff;
border-color: #ddd;
}
ul.yiiPager .page a:hover{
color: #fff;
background-color: #5cb85c;
border-color: #00A395;
}

ul.yiiPager{ padding-bottom:40px; margin-left:10px;}

.pager{color:white;}
.pager .next>a, .pager .previous>a{
font-weight: normal;
height: 32px;
margin: 0px;
font-size: 16px;
border-radius: 4px;
line-height: 26px;
text-align: center;
margin-left:5px;
color: #5cb85c;
background-color: #eee;
border-color: #ddd;
}

.pager .next>a:hover, .pager .previous>a:hover{
color: #fff;
background-color: #5cb85c;
border-color: #00A395;
}


ul.yiiPager a:link, ul.yiiPager a:visited {

color: #5cb85c;
background-color: #fff;
border-color: #ddd;
}

ul.yiiPager .selected a{color: #ffffff;
background-color: #5cb85c;
font-weight: 600;
border-color: #5cb85c;
}
ul.yiiPager .selected a:hover{color: #ffffff;
background-color: #5cb85c;
font-weight: 600;
border-color: #5cb85c;
cursor:inherit;
}




/* ------ END PAGINADOR------- */

/*---------- EDIT CREATE FORM -------------*/

.buttonsFloatBottom{ padding:5px; text-align:right; margin-top:20px; background-color:rgba(0,0,0,0.5);}
.buttonsFloatBottom .btn{ margin:5px;}


.form-group { color:#333;}
.form-group input{font-size:16px; }
.form-group textarea{font-size:16px; }
.form-group label{ color:#333; text-align:right;
padding-left: 5px;}

.form-control{ padding:4px;}

.formHasLabel{width: 85%;
display: inline-block;
margin-right: 5px;}

.formHasClear{padding-right:29px; position:relative;}

.clearBT{position:absolute; top:24px; right:15px;color:#ccc; background: none; border:0px none; font-size:24px; vertical-align:bottom;}
.clearBT:hover{color:#bbb; background: none; border:0px none; font-size:24px; vertical-align:bottom;}

input[type="file"] {
width:100%;
}

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

#screenAgregarProductos{ margin-bottom:60px;}
#screenAgregarProductos table td{ vertical-align:middle;}
#screenAgregarProductos table td label{ vertical-align:middle;}


#screenAgregarProductos .table.tablaIndividual thead>tr>th, #screenAgregarProductos .table.tablaIndividual tbody>tr>th, #screenAgregarProductos .table.tablaIndividual tfoot>tr>th, #screenAgregarProductos .table.tablaIndividual thead>tr>td, #screenAgregarProductos .table.tablaIndividual tbody>tr>td, #screenAgregarProductos .table.tablaIndividual tfoot>tr>td {
padding: 6px 8px;
}

.tablaIndividual{ margin-bottom:20px; background-color:rgba(255,255,255,1); max-height:100px; overflow:auto; font-size:14px;}
.table.tablaIndividual { margin-bottom:30px;}
.tablaIndividual td button{ margin:5px; margin-left:0px; vertical-align:middle;}
.table.tablaIndividual th{ font-weight:600;  font-size:14px; line-height:15px; color:#555; background-color:#ddd;}
.table.tablaIndividual th a{ font-weight:600;  font-size:14px; line-height:15px; color:#555; background-color:#ddd; font-family:"GudeaRegular"}
.table.tablaIndividual thead>tr>th, .table.tablaIndividual tbody>tr>th, .table.tablaIndividual tfoot>tr>th, .table.tablaIndividual thead>tr>td, .table.tablaIndividual tbody>tr>td, .table.tablaIndividual tfoot>tr>td{vertical-align:middle; padding:5px;}

#screenProductos .table.tablaIndividual { margin-bottom:5px;}

.buttonsTableProd{min-width:158px;}
.buttonsTablePres{min-width:380px;}

.combined { width:100%;}
.combined select{display:inline-block !important; width:60% !important;}
.combined button{display:inline-block; width:35%; margin:0px !important;}


/*---------- END EDIT CREATE FORM -------------*/

/* ------ MODALS ------- */
.modal{z-index:1070;}
.modal-title{ font-size:1.6em; color:#666; }
.modal-header {padding: 9px 15px;}
.modal-header .close{padding: 0px; margin-top:0px; line-height:34px;}
.modal-footer {padding: 9px 15px;}
.modal-body{ overflow:hidden;}
.modal-backdrop{z-index:1060;}
.modal .nav-tabs li a{ color:#333;}

.modal .nav-tabs>li.active>a { background-color:#ccc; color:#fff !important;}

/* ------ END MODALS ------- */

/* ------ MODAL CARGAR ------- */

.estadoModal{ margin-top:20px; padding-top:10px; border-top:1px dotted #ccc;}
.estadoModal label{ font-size:17px;}
.estadoModal .alert{ font-size:17px;}

.col-sm-6.limpiarPadding{ padding:0px;}

.col-sm-6.paddingRight{ padding-right:15px;}
.col-sm-6.paddingLeft{ padding-left:15px;}

.modal-footer{margin-top:0px;}

.modal-content .alert{ margin-bottom:0px;}

/* ------ END MODAL CARGAR ------- */

/* ------ CREAR PRESU ------- */


#screenCrearPresupuesto{ margin-bottom:40px;}
#campoTipoPrecio{ width:65px; display:inline-block;}

h2 a.superEdit{ position:absolute; top:10px; right:30px; cursor:pointer; font-size:20px;}



.btnAlternateView{ margin-left:5px;}

#myModalFormBudget .modal-dialog{ width:700px;}


#myModalAddProduct .modal-dialog{ width:80%;}
#myModalAddProduct .label{ font-size:15px;}
#myModalAddProduct .table.tablaIndividual{ margin-bottom:0px;}

.inputSmall{ width:40px; display:inline-block; }
.inputMed{ width:55px; display:inline-block; }


ul.superDropdown{
margin-left: 182px !important;
margin-top: -186PX;}
ul.superDropdown li{ width:300px; }


.introProveedor{ padding:10px; padding-bottom:0px; padding-top:5px;}
.introProveedor .table{ margin-bottom: 0px;
border-bottom: 1px dotted #ccc;}
.introProveedor .table th{ font-size:12px; background-color:white;}
.introProveedor .table td{ font-size:12px;}
.titleProveedor{ font-size:15px; font-weight:600; padding-bottom:5px;border-bottom:1px dotted #ccc; padding-left:5px;}

.introProveedor .tableDatosProd{ margin-bottom:5px;}

.superDropdown .fa-fw{
font-size: 12px;
margin-right: 5px;
color: #666;}

.tableOpcionesPrecio{ padding:5px;}
.introProveedor .tableOpcionesPrecio td{ background-color:#eee;font-size:16px;}

.superDropdown .fa-fw.masBajo{ color:#5cb85c;}
.superDropdown .fa-fw.masAlto{ color:red;}


.tituloFinalPresu{ font-size: 1.8em;
font-weight: normal;
color: #333;
text-align: left;
margin: 0px;
line-height: auto;
padding-bottom: 20px;}
.totalPresupuesto{ background-color:#eee; height:120px; margin-top:20px; margin-bottom:30px;}

.tablePresuTotal{ background-color:white;}
.tablePresuTotal td{ line-height:20px; vertical-align:middle !important;}
.superTotal{ font-size:20px;}

.panelPresu{ background-color:rgba(255,255,255,0.5); border:none; margin-bottom:2px;}
.panelPresu{ padding-bottom:20px;   border-bottom-right-radius: 0px;  border-bottom-left-radius: 0px;
}

.contenedorPresu{ background-color:rgba(255,255,255,0.5); padding:0px; margin:0px;  padding-top:20px; margin-bottom:2px;}

.contenedorPresu .col-sm-12{ padding-right:10px;padding-left:10px;}

.panel-body .tablaDatosPanel{ margin-top:10px; margin-bottom:10px !important;}


.navTabsPencil.nav-tabs>li a{position:relative; padding-right:35px;}
.navTabsPencil{ margin-right:340px; position:relative;}
.navTabsPencil .pull-right{ position:absolute; right:-340px; bottom:5px;}
.nav-tabs>li {margin-bottom:0px;}

.nav-tabs>li a.tabEdit{ padding-right:5px;position:absolute;cursor:pointer; right:5px; top:-1px; background-transparent !important; border:none 0px;}


.nav-tabs>li.active>a.tabEdit, .nav-tabs>li.active>a.tabEdit:hover, .nav-tabs>li.active>a.tabEdit:focus { background-color:transparent !important;}
.nav>li>a:hover.tabEdit, .nav>li>a.tabEdit:focus { background-color:transparent !important;}

.nav-tabs>li a.tabEdit:hover, .nav-tabs>li.active>a.tabEdit:hover{color:#5cb85c !important; cursor:pointer;}

.bloqueHoras{min-width:60px; margin-top:6px;}
.bloqueHoras span{ display:inline-block; width:22px; margin-right:3px; font-size:14px;}
.bloqueHoras .inputSmall{margin-top:2px;}

.bloqueDescuentoHoras{min-width:135px; padding-top:1px;}
.bloqueDescuentoHoras span{ display:inline-block; width:22px; margin-right:3px; font-size:14px;}

.bloqueTotalHoras{min-width:85px; margin-top:4px;}
.bloqueTotalHoras span{ display:inline-block; width:22px; margin-right:3px; font-size:14px;}

.bloqueDescuento{min-width:110px; padding-top:1px;}
.bloqueDescuento input{ margin-right:0px;}
.labelPrecio{ font-size:13px;}

.bloquePrecioRec{min-width:65px;}

.radioTipo{display: inline-block;
width: 50px;
height: 34px;
vertical-align: middle; margin-left:0px;}

.radioTipo .radio{margin:0px; text-align:left; height:17px;}

.radioTipo .radio input[type="radio"]{
margin:0px ; margin-left: -15px;}

.campoServicio{width:100%;}

.radioTipo .usd{ vertical-align:top;}

.usd{font-size:11px; display:inline-block;line-height:17px; height:17px; vertical-align:middle;}


.precioTabla{position:relative;}
.precioTabla button.miniEdit{ position:absolute; top:50%; right:-4px; margin-top:-12px !important;}

.precioTablaValor{padding-right:35px; line-height:12px;}


.tableProductName{ font-size:16px; font-family: 'GudeaBold';}
.tableProductBrand{ font-size:16px;}

#product-grid-add .tablaIndividual td button{margin:0px; margin-left:5px;}
#product-grid-add{margin-bottom:0px;}
#myModalAddProduct .modal-body{padding:10px;}


#myModalAddProduct .inputSmall{padding:0px 2px; height:31px;}

#myModalAgregarRec .formHasLabel{ width:74px;}
#myModalAgregarRec .labelPrecio {line-height: 34px;padding: 6px;}

.grid-view th{font-family:"GudeaRegular"; font-weight:600;}
.grid-view td{font-family:"GudeaRegular";}

.statusFloatSaving{padding: 5px;
text-align: center;
color:white;
background-color: rgba(0,0,0,0.5);}

.statusFloatSaved{padding: 5px;
text-align: center;
color:white;
background-color: rgba(92,184,92,0.8);}


.inlineForm{background-color:#eee; padding:5px; border-radius:5px; margin:5px 0px;}

.inlineForm .table{margin-bottom:0px; }
.inlineForm .table td{border: 0px none; }

.label-info{font-size: 13px;
font-family: "GudeaRegular";
}

.liButtonAdd{ line-height:35px; padding-left:10px;}

/* ------ END CREAR PRESU ------- */


/* ----- DISPOSITIVOS --------*/

.devicesSelector{ padding-bottom:10px; margin-bottom:10px;}

#wizardDispositivos h3{ /*margin-top:10px;*/ margin-top:0px;}
.nav-pills.nav-stacked>li>a{border-radius:18px; color:white;}
.nav-pills.nav-stacked>li.active>a{background-color:#eee;color:#333;}
.nav-pills.nav-stacked>li>a:hover{ background-color:#428bca;color:white;}
.nav>li>a.ejectBTN{ width:35px; height:35px; padding:6px; position:absolute; top:3px; right:3px; color: #428bca;
background-color: #fff;}




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