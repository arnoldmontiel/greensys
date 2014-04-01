<style>
/*!
 * Green v1.1.1
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

 @font-face {
font-family: 'Mono';
src: url('fonts/DejaVuSansMono.ttf');
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
b, strong {
font-family: 'GudeaBold';
}
button {
  outline: 0 none !important;
}

.noMargin{ margin:0px !important;}
.noBorder{ border:0px none !important;}
.block{display:block !important;}
.inline{display:inline !important;}
.inlineBlock{display:inline-block !important;}

.clear{clear:both;}

.align-left{ text-align:left !important;}
.align-center{ text-align:center !important;}
.align-right{ text-align:right !important;}

.verticalTop{vertical-align:top !important;}

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
	background: #ECF0F1;
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

/* ------ MOBILE MENU ------- */

.pushMenuItem {position:relative;}
.pushMenuActive{position:relative;}

a.pushMenuItem:before {
        position:absolute;
		font-family: FontAwesome;
        top:0;
        right:10px;
        top:50%;
        color:#ddd;
        margin-top:-8px;
        margin-right:3px;
        content: '\f096';
    }
a.pushMenuActive:before {
        position:absolute;
		font-family: FontAwesome;
        top:0;
        right:10px;
        top:50%;
        margin-top:-8px;
        content: '\f046';
        color:#666;
        margin-right:0px;
    }
.cbp-spmenu .pushMenuSuperGroup{height:100%; padding-bottom:105px;overflow:auto; -webkit-overflow-scrolling:touch;}
.cbp-spmenu .pushMenuGroup{border-bottom:1px solid #ddd;padding-top:10px;}
.cbp-spmenu .pushMenuGroup .pushMenuGroupTitle{
padding-left:15px;
padding-bottom:0px;
font-size: 16px;
font-weight: 700;
color: #bbb;
text-transform: uppercase;
letter-spacing: 2px;}

.cbp-spmenu {
	border-top: 6px solid #24D900 ;
	background-color: #f8f8f8 ;
	color: #777 ;
	z-index:1060 ;
}

.cbp-spmenu-vertical a {
border-bottom: 0px none;
padding: 0px;
}
.cbp-spmenu-vertical .pushMenuItem {
border-bottom: 0px none;
padding: 1em;
}

.cbp-spmenu .pushMenuItem {
	color: #777 ;
	border-bottom: 1px solid #fff ;
	padding-right:35px;
}

.cbp-spmenu .pushMenuItem:hover {
	color: #5e5e5e;
	background-color: transparent;
	text-decoration: none;
}

.cbp-spmenu .cbp-title {
	background-color: #f8f8f8;
	font-size: 25px;
	padding: 10px;
	background-color: #fbfbfb;
	white-space:nowrap;
	padding-right:40px;
}

.cbp-spmenu-left, .cbp-spmenu-push-toleft{left:-100%;}
.cbp-spmenu-right, .cbp-spmenu-push-toright{right:-100%;}
.cbp-spmenu a:hover {
background: none;
}
a.close-menu {
	position: absolute;
	height: 40px;
	width: 40px;
	line-height: 40px;
	text-align: center;
	top: 5px;
	right: 5px;
	padding: 0px;
	display: inline-block;
	text-decoration: none;
	border: none;
	vertical-align: middle;
	font-size: 25px;
	cursor: pointer;
	color: #5cb85c;
}

a.close-menu:hover {
	background-color: transparent;
	color: rgba(38, 173, 161, 0.5);
}

a.list-group-item {
	font-size: initial;
}

.cbp-spmenu{width:auto; min-width:250px;}
.cbp-spmenu-open{width:auto; min-width:340px;}

#pushFiltro{font-size:14px;}

.pushMenuDates{padding:10px;}
.pushMenuDates label{display:block; text-align:left;}
.pushMenuDates input{width:150px;}


.sideMenuBotones{ white-space:nowrap;position:absolute; bottom:0px; z-index:1090; background-color:#fbfbfb; padding: 10px 0px; width:100%; text-align:center; border-top:2px solid #eee;}

.sideMenuBotones .btn{ margin-left:10px;}

.treeMenu{overflow-y: auto;
height: 100%; border-left: 1px solid #CCC;}

.treeMenu a{display:inline-block;}

.jstree-default .jstree-anchor {
padding-right:10px;
line-height: 30px;
height: 30px;
}
.jstree-default .jstree-icon:empty {
height: 30px;
line-height: 30px;
}
.jstree-default .jstree-hovered {
background: #e7f4f9 !important;
}

.jstree-default .jstree-clicked {
background: #D5F0C5 !important;
}

.jstree-container-ul{margin-bottom:125px;}

.jstree-default .jstree-wholerow-clicked{background:transparent !important;}

/* ------ END MOBILE MENU ------- */
/* ----- LOGIN ------*/
.loginBody{background:transparent; background-color:#5cb85c; padding:0px;}
.loginPanel{
background-color: #f8f8f8;
border: 1px solid #d9d9d9;
-moz-box-shadow: 0 0 16px -4px rgba(0, 0, 0, 0.5);
-webkit-box-shadow: 0 0 16px -4px rgba(0, 0, 0, 0.5);
box-shadow: 0 0 16px -4px rgba(0, 0, 0, 0.5);
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
vertical-align:middle;
text-align:center;
padding:20px;
display:inline-block;
margin:auto;
}
.loginBrand{font-family: 'LatoRegular', sans-serif;
font-size: 28px;
text-transform: uppercase;
letter-spacing: 1px;
line-height: 48px;
 text-align:center;
color:#fff;
margin-bottom:15px;
}

.loginWrapper{ margin-bottom:200px; margin:auto;
margin-top:100px; text-align:center;
}
.loginBody .inputLogin {
margin: 5px;
padding: 0 10px;
width: 300px;
height: 34px;
color: #404040;
background: white;
border: 1px solid;
border-color: #c4c4c4 #d1d1d1 #d4d4d4;
border-radius: 2px;
outline: 5px solid #eff4f7;
-moz-outline-radius: 3px;
-webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
}
.loginForm{display:inline-block; margin:auto;}

.loginForm .rememberMe{color:#999; line-height:18px;}

.loginForm .rememberMe label{margin:0px; vertical-align:middle;}
.loginForm .rememberMe input{margin:0px; vertical-align:middle;}

.loginForm .btn{margin-top:20px;}

.separatorLine{border-top:1px dotted #ddd;}

.loginFooter{color:white; text-align:center; margin-top:40px;}

.loginGoogle{padding:30px 10px; 
background-color: #e7e7e7;
border-radius: 2px;
-moz-outline-radius: 3px;
width:200px;
text-align:center;
}
.loginGoogle .services{margin:0px; padding:0px; margin:auto; display:inline-block;}
.loginGoogle .auth-services{margin:0px; padding:0px;}
.loginGoogle .auth-services li{margin:0px; padding:0px;}


.loginGoogle .auth-services a{color:#666;}
.loginGoogle .auth-services a:hover{text-decoration:none; color:#999;}

/* ----- END LOGIN ------*/

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
background-color: #96d896;
border-color: #96d896;
}
  .btn-default{
  color: #ffffff;
background-color: #7F8C8D;
font-weight:600;
border-color: #7F8C8D;
}
  .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open .dropdown-toggle.btn-default {
color: #ffffff;
background-color: #666;
border-color: #666;}

    .btn-danger{
  color: #d9534f;
background-color: #eee;
border-color: #ddd;
}


.btn-default.disabled, .btn-default[disabled], fieldset[disabled] .btn-default, .btn-default.disabled:hover, .btn-default[disabled]:hover, fieldset[disabled] .btn-default:hover, .btn-default.disabled:focus, .btn-default[disabled]:focus, fieldset[disabled] .btn-default:focus, .btn-default.disabled:active, .btn-default[disabled]:active, fieldset[disabled] .btn-default:active, .btn-default.disabled.active, .btn-default[disabled].active, fieldset[disabled] .btn-default.active {
background-color:#ccc;
border-color: #ccc;
color:#fff;
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

#Menu{ margin-top: 10px; margin-left:10px; margin-right:10px; border-top: 5px solid #24D900; height:55px;z-index:1060; background-color:#ECF0F1;}
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

#Menu .navbar-nav>li.active>a{background-color:rgba(255,255,255,0.6);}


.popover{width:300px; max-width:300px;}
.popoverButtons{ border-top:1px dotted #ccc; margin-top:10px; padding-top:10px;}
.popoverButtons button{  width:110px; margin-right:10px;}


/* ------ BTN INITIAL FONT SIZES ------- */
.btn{ font-size:15px;}
.btn-lg{ font-size:18px;}
.btn-sm{ font-size:13px;}
.btn-xs{ font-size:13px;}
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
color: #7F8C8D;
text-align:left;
margin:0px;
line-height:auto; padding-bottom:20px; }

#screenCrearPresupuesto h1.pageTitle{ padding-bottom:0px;}

h3{font-size: 24px;
font-weight: 100;
color: #ddd;
margin-bottom:10px; margin-top:10px;text-shadow: 0 1px 3px #000;
font-family:'GudeaRegular', Arial, sans-serif;
}

h3.tableTitle{ color: #666; text-shadow:none; background-color:#eee; padding:10px; margin-bottom:0px;}

#screenInicio .panel .alert{margin-bottom:0px;}

.panel-default>.panel-heading { background-color:#7F8C8D; border-color:#7F8C8D;}

.panel-heading h3 { text-shadow:none; color:white;}
.panel-success>.panel-heading h3 {  color:#333;}

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
.contenedorPresu .grid-view{ margin-bottom:0px;} 
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


.nav-tabs{border-bottom:1px solid #ddd;}

.nav-tabs>li>a{font-size:16px; color:#7F8C8D;  font-weight:600;}

.nav-tabs>li>a .badge{background-color:#fff; color:#7F8C8D;}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{  background-color:#7F8C8D; color:white !important; cursor:default; border:1px solid #7F8C8D;}

.nav-tabs>li.active>a{ background-color:#7F8C8D;color:#fff !important;}
.nav-tabs>li>a:hover{ color:#666 !important; background-color:white;}

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

.buttonsFloatBottom{ padding:5px; text-align:right; margin-top:20px; background-color:rgba(0,0,0,0.2);}
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

.rowSeparator{ font-size:20px; margin-top:30px;  padding:5px; background-color:rgba(255,255,255,0.9);
color: #666;
text-align: center;
text-transform: uppercase;
font-size: 16px;
letter-spacing: 2px;
font-weight: 600;
position:relative;
}
.rowSeparator.rowHybrid{ 
height: 41px;
line-height: 33px;

}
.noTopMargin{ margin-top:0px;}

a.label-danger{ cursor:pointer;}
a.label-danger:hover{ color:white;}

#screenAgregarProductos{ margin-bottom:60px;}
#screenAgregarProductos table td{ vertical-align:middle;}
#screenAgregarProductos table td label{ vertical-align:middle;}

#screenAgregarProductos .nav-tabs{margin-bottom:15px;}

#screenAgregarProductos .table.tablaIndividual thead>tr>th, #screenAgregarProductos .table.tablaIndividual tbody>tr>th, #screenAgregarProductos .table.tablaIndividual tfoot>tr>th, #screenAgregarProductos .table.tablaIndividual thead>tr>td, #screenAgregarProductos .table.tablaIndividual tbody>tr>td, #screenAgregarProductos .table.tablaIndividual tfoot>tr>td {
padding: 6px 8px;
}
.btnAddHybrid{position:absolute; right:5px;}

.tablaIndividual{ margin-bottom:20px; background-color:rgba(255,255,255,1); max-height:100px; overflow:auto; font-size:14px;}
.table.tablaIndividual { margin-bottom:30px;}
.tablaIndividual td button{ margin:5px; margin-left:0px; vertical-align:middle;}
.table.tablaIndividual th{ font-weight:600;  font-size:14px; line-height:15px; color:#555; background-color:#ddd;}
.table.tablaIndividual th a{ font-weight:600;  font-size:14px; line-height:15px; color:#555; background-color:#ddd; font-family:"GudeaRegular"}
.table.tablaIndividual thead>tr>th, .table.tablaIndividual tbody>tr>th, .table.tablaIndividual tfoot>tr>th, .table.tablaIndividual thead>tr>td, .table.tablaIndividual tbody>tr>td, .table.tablaIndividual tfoot>tr>td{vertical-align:middle; padding:5px;}

#screenProductos .table.tablaIndividual { margin-bottom:5px;}

.contenedorPresu .table.tablaIndividual{ margin-bottom:10px;} 

.buttonsTable button:last-child{margin-right:0px;}
.buttonsTableProd{min-width:163px;}
.buttonsTablePres{min-width:400px;}
.buttonsTableOrder{width:52px;}
.buttonsTableOrder button{margin-top:0px;}
.buttonsTablePresWait{width:150px;}

.combined { width:100%;}
.combined select{display:inline-block !important; width:60% !important;}
.combined button{display:inline-block; width:35%; margin:0px !important;}


.ulEditImagen{min-width:160px; width:150px; padding:5px;}
.ulEditImagen li{min-width:150px; width:150px;}
.ulEditImagen li img{width:100%;}

.dropdownEditImagen{ color:#777; cursor:pointer; text-decoration:underline;}
.dropdownEditImagen i { text-decoration:none; margin-right:6px;}
/*---------- END EDIT CREATE FORM -------------*/

/* ------ MODALS ------- */
.modal{z-index:1070;}
.modal-title{ font-size:1.6em; color:#666; }
.modal-header {padding: 9px 15px;}
.modal-header .close{padding: 0px; margin-top:0px; line-height:34px;}
.modal-footer {padding: 9px 15px;}
.modal-body{ overflow:hidden;}
.modal-backdrop{z-index:1060;}


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

#screenCrearPresupuesto .nav-tabs>li>a{color:#666;}
#screenCrearPresupuesto .nav-tabs>li>a:hover{background-color:rgba(255,255,255,0.5);}
#screenCrearPresupuesto .nav-tabs>li.active>a:hover{background-color:white; color:#333 !important; border:1px solid white;}


#campoTipoPrecio{ width:65px; display:inline-block;}

h2 a.superEdit{ position:absolute; top:10px; right:30px; cursor:pointer; font-size:20px;}

#header-budget-description{padding-bottom: 10px;
font-size: 18px;
margin-top: -5px;}

.btnAlternateView{ margin-left:5px;}

#myModalFormBudget .modal-dialog{ width:700px;}


#myModalAddProduct .modal-dialog{ width:90%;}
#myModalAddProduct .label{ font-size:15px;}
#myModalAddProduct .table.tablaIndividual{ margin-bottom:0px;}


.groupAgregar{width:150px;}
.groupAgregar .checkAgregado{margin-left:10px; color:#5cb85c; display:none;}

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
padding-bottom: 20px; position:relative;}

.tituloAreaPresu{
margin: 0px;
margin-bottom: 15px;
color: #666;
font-size: 24px;}

.buttonsAreaPresu .btn{margin-left:10px;}

.agregarImp{ position:absolute; right:10px; top:0px;}

.totalPresupuesto{ background-color:#eee; height:120px; margin-top:20px; margin-bottom:30px;}

.tablePresuTotal{ background-color:;}
.tablePresuTotal td{ line-height:20px; vertical-align:middle !important;}
.superTotal{ font-size:20px;}


.panelPresu{/* background-color:#eee;*/margin:0px; border:0px none; padding-bottom:20px; padding-top:20px;  border-bottom:2px dotted #dedede;  border-radius:0px;}

.panelPresu h2{margin-bottom:10px;}
.panelPresu .versionDrop{display:block; margin:0px;margin-bottom:15px;text-shadow:none; color:#666;font-size: 24px;
font-weight: 100;
font-family:'GudeaRegular', Arial, sans-serif;}

.panelPresu .table td{padding:3px;}

.contenedorPresu{ /*background-color:#eee;*/ padding:0px; margin:0px; border-bottom:2px dotted #dedede; padding-top:10px; padding-bottom:20px; margin-bottom:0px;}

.contenedorPresu .col-sm-12{ padding-right:10px;padding-left:10px;  }

.panelPresuFinal { /*background-color:#eee;*/ margin:0px 0px; padding-top:20px; border-top:2px dotted #dedede; }


.panel-body .tablaDatosPanel{ margin-top:10px; margin-bottom:10px !important;}


.navTabsPencil.nav-tabs>li a{position:relative; padding-right:35px;}
.navTabsPencil{ margin-right:340px; position:relative; height:45px; border:0px none;}
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

.label-total{font-size:20px;}
.label-subtotal{font-size:16px;}
.label-subtotal .usd{font-size:16px; vertical-align:baseline;}

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

#modalPlaceHolder .formHasLabel{ width:74px;}
#conversorMonedas .formHasLabel{width:84%;}

#modalPlaceHolder .labelPrecio {line-height: 20px; font-size:14px; margin-top:4px; display:inline-block;}

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

#warningEmpty{ margin:5px 0px;}

/* ------ END CREAR PRESU ------- */

/* ------ CREAR IMPORTADOR ------- */

#myModalFormImporter .modal-dialog{width:850px;}

#myModalFormImporter .modal-body{padding:10px;}

#myModalFormImporter h4{margin-top:15px;}

#myModalFormImporter .form-group{margin-bottom:5px;}


.grupoAereo{background-color:#eee; border-right:2px solid #fff; margin-top:5px;}
.grupoMaritimo{background-color:#eee; margin-top:5px;}

/* ------ END CREAR IMPORTADOR ------- */

/* ------ CURRENCY ------- */

.table .miniTableCurrency thead th{font-family:'GudeaRegular'; font-size:12px; background-color:#eee; border-color:#eee;}

.table .miniTableCurrency .btn{margin-left:5px;}
/* ------ END CURRENCY ------- */

/*------------- CLAUSES ------------*/
.clauseScroll{height:300px;overflow-y:auto; padding:5px;}

#screenClausulas .nicEdit-main{background-color:white;}

#screenClausulas .nicEdit-main:focus{outline:none;}

.buttonsPresuClause{min-width:200px; text-align:right; vertical-align:top;}


#myModalChangeClause .modal-dialog{width:80%;}

#myModalChangeClause .nicEdit-main:focus{outline:none; }

#myModalChangeClause .from-control{width:100%; }

.nicEdit-main{cursor:text;}

/*------------- END CLAUSES ------------*/

/* ------ UPLOAD IMAGENES PRODUCTO ------- */
.xupload-form{ background-color:rgba(255,255,255,0.5);  font-size:16px;border: 3px dotted #eee; line-height:60px; height:250px; 
width:auto; padding:50px; border-radius:0px; display:block;margin-right:20px;margin-left: 20px; margin:auto;}

.xupload-form.file_upload_highlight{background-color:white; font-size:16px;}

.xupload-form div{color:#666;}

#files{margin-top:20px;}

.imageUploadCont{width:120px;}

.tablaUploadImagenes .imageUploadCont img{width:100%;}

/* ------ END UPLOAD IMAGENES PRODUCTO ------- */


/* ------ READ ONLY ------- */
@page *{
    margin:0px; background-color:white;
    
}

@page{
  footer: html_myFooter;
  margin-top: 0.5cm;
  margin-bottom: 1cm;
  margin-left: 0.5cm;
  margin-right: 0.5cm;
  margin-header: 5mm; 
  margin-footer: 5mm; 
}

@media print
{
body {background-color:white;}




.tableReadOnly .conDesc td{width:inherit !important; }
.tableReadOnly .sinDesc td{width:inherit !important;}

.tableReadOnly .conDesc th{width:inherit !important; }
.tableReadOnly .sinDesc th{width:inherit !important;}
}



.tableReadOnly .conDesc td{width:12% !important; }
.tableReadOnly .sinDesc td{width:16% !important;}

.descContainer{width:inherit !important;}

#screenReadOnly{ font-size:14px; background-color:white;padding-top:30px; padding-bottom:30px;}

.budgetLogo{margin:auto; display:inline-block;width:300px; height:100px; background-color:black; background-size:80%; background-repeat:no-repeat; background-position:center; background-image:url(images/logo.png);}

.budgetCabecera{ text-transform:uppercase; letter-spacing:2px; color:#333; }


.budgetBloque{ font-family:'GudeaRegular'; border-bottom:1px dotted #ccc; padding-bottom:20px; margin-bottom:20px;}

.budgetProduct{font-family:'GudeaBold';	 text-transform:uppercase;}

.budgetPropuesta{ text-transform:uppercase; letter-spacing:2px;}
.budgetName{font-size:18px; font-family:'GudeaBold';	 text-transform:uppercase; letter-spacing:initial; margin:3px -2px;}
.budgetClient{ text-transform:uppercase;}
.budgetVersion{ text-transform:uppercase;}
.budgetDate{ text-transform:uppercase;}

.budgetTitle{ letter-spacing:1px;  color:#999; font-size:30px; text-align:left;}


.budgetNota{padding-bottom:20px; margin-bottom:40px; border-bottom:1px dotted #ccc;}

.superBudgetTotal{background-color:#999; color:#fff; letter-spacing:1px; padding:5px; font-size:17px;border-bottom: 2px solid white;}

div.superBudgetTabla .tablaDatos td.superBudgetTotal{margin-top:5px; background-color:#999; color:#fff; letter-spacing:1px; padding:5px; font-size:17px;border-bottom: 2px solid white;}


div.superBudgetTabla .tablaDatos td.lastRow{background-color:#ddd; border-top:0px none; font-size:15px;}

div.superBudgetEnd{margin-top:50px; color:#ccc; font-size:20px; text-align:center;}
div.superBudgetTabla{margin-bottom:20px; margin-top:50px; font-size:15px;}
div.superBudgetTabla .tablaDatos td{background-color:#eee; font-size:15px; border-top:1px solid white;}
.superBudgetTabla .tablaDatos{margin-bottom:0px; width:100%;  margin: 0px;border:5px solid #ddd; }

.newTotal{font-size:18px; text-align:right; padding:10px; font-weight:bold; border-bottom:4px solid #eee; color: #333;
font-family: "GudeaBold";
background-color:white;
}

div.superBudgetTabla .tablaDatos td.newTotal{font-size:18px; text-align:right; padding:10px; font-weight:bold; border-bottom:4px solid #eee; color: #333;
font-family: "GudeaBold";
background-color:white;
}

div.superBudgetTabla .tablaDatos td.finalTotal{font-size:18px; padding:10px; font-weight:bold; border-bottom:4px solid #eee; color: #333;
font-family: "GudeaBold";
background-color:white;
}

.superBudgetTablaFinal .tablaDatos{border:5px solid #333; }
div.superBudgetTablaFinal .tablaDatos td.superBudgetTotal{background-color:#333;}

.noBreak{page-break-inside: avoid; }

div.superBudgetFinal{}
div.superBudgetTabla .tablaDatos td{}

.budgetDesc{   margin-bottom:15px; padding: 0px 5px;}

.nicEdit-scroll{height:350px !important; overflow-y:auto !important;}

.nicEdit-main{ padding-bottom:25px;}
.nicEdit-main , .nicEdit-main div, .nicEdit-main ul, .nicEdit-main ol, .nicEdit-main  p, .nicEdit-main  span{
      font-size: 15px !important;
      font-family:"GudeaRegular" !important;
}
 .nicEdit-main ul, .nicEdit-main ol{padding-left:30px;padding-top:10px !important}
 .nicEdit-main p{padding-left:10px !important; padding-top:10px !important;}
 .nicEdit-main span{padding-left:10px !important; padding-top:10px !important;}
 
.nicEdit-main .budgetSubtitle{ font-size: 16px !important;font-weight:normal; letter-spacing:1px; 
padding:5px; background-color:#eee; text-transform:uppercase;
font-family:'GudeaRegular'; text-align:left;
padding-bottom: 5px;
margin-top:20px; margin-bottom:5px;}



div.budgetClausulas{ padding-left:40px;margin-bottom:15px; padding: 0px 5px;font-size: 12px !important; padding-bottom:40px; text-align:left;}

div.budgetClausulas blockquote{
margin: 0 0 0 40px;
border: none;
padding: 0px;
font-size:12px !important;}

div.budgetClausulas blockquote span{
font-size:12px !important;}


div.budgetClausulas ul{text-indent:15px;}
div.budgetClausulas ol{text-indent:15px;}


div.budgetClausulas p, div.budgetClausulas  span{ padding-left:10px !important; line-height:16px !important;}

div.budgetClausulas div.budgetSubtitle,  div.budgetSubtitle{  font-size: 16px !important; font-weight:normal; letter-spacing:1px; 
padding:5px; background-color:#eee; text-transform:uppercase;
font-family:'GudeaRegular'; text-align:left;
padding-bottom: 5px;
margin:0px;
margin-top:20px; 
margin-bottom:5px; }

/*solo para View online*/
#screenReadOnlyCaratulaFinal div.budgetClausulas *{
      font-size: 14px !important;
}



.tableReadOnly{width:100%; margin-bottom:0px;}
.tableReadOnly td{border-top: 0.1px solid #ddd; border-top: 0.1px solid #eee; font-size:13px;padding:10px 5px; }
.tableReadOnly th{ padding:10px 5px;}

.tablaDatos {margin-bottom:40px;}
.tablaDatos td{ padding:10px 5px; }
.tablaDatos th{ padding:10px 5px;}


.budgetMono{font-family:'Mono';}

.label-small{/*font-size:15px;color:white; background-color:#ccc; display:inline-block; padding:3px 5px; */ font-weight: bold;}

.label-big{font-size:18px; margin:0px; color:white; background-color:gray;display:inline-block;padding:3px 5px; font-weight: bold;}


.tableReadOnly  td.budgetImgCont{ padding-right:10px;}
.imgTD{width:100px;}

 div.bold{font-family:'GudeaBold'; font-weight:bold;}
 
.table .tablaLimpia td{border-top: 0px transparent; }
.tableReadOnly .tablaLimpia{width:100%;}
.tableReadOnly .tablaLimpia td{border-top: 0px transparent;   }

.tablaLimpia2 {border-top: 0px transparent;  width:100%;}
.tableReadOnly .tablaLimpia2{width:100%;}
.tableReadOnly .tablaLimpia2 td{border-top: 0px transparent;}
.tableReadOnly  .tablaLimpia2 td{border-top: 0px transparent;   }

.tableReadOnly .conDesc{ width:100%; }
.tableReadOnly .sinDesc{width:100%; }

/*
.tableReadOnly .conDesc td{width:12%; }
.tableReadOnly .sinDesc td{width:16%;}*/

.tableReadOnly  td.bold{font-family:'GudeaBold'; font-weight:bold;}

.tableReadOnly  td.lastRow{border-top:1px solid #888; text-transform:uppercase;}


.table .tablaLimpia2 td.bold{font-family:'GudeaBold'; font-weight:bold;}

#screenReadOnlyCaratula{ text-align:center; background-color:white; padding-top:150px;}
#screenReadOnlyCaratulaFinal{ text-align:center; background-color:white; padding-top:20px;}


.logoBig{ margin:auto; }
.mainInfo{border-left: 1px solid #333; margin:auto;  text-align:left; margin-top:20px;}
.mainInfo td{padding-left:10px;text-transform:uppercase;}

.mainInfo td.bigBold{font-weight:bold; font-size:1em;}

.caratulaResumen{ margin-top:100px; text-align:left; }
.caratulaResumen .table td{border-top: 1px solid #ddd; font-size:13px;padding:5px 10px;}
.caratulaResumen .table th{ padding:5px 10px;}

#screenReadOnlyCaratulaFinal .caratulaResumen{margin-top:60px;}

.redDiscount{color:red;}

/* 3 tamanos de producto */
 .tableReadOnly tr.pdfProdBIG .tablaLimpia td img.imgTD{width:250px !important;}
 tr.pdfProdBIG td.pdfTituloProd{font-size:16px; font-size:13px;}

 .tableReadOnly tr.pdfProdMEDIUM img.imgTD{width:150px;}
 tr.pdfProdMEDIUM td.pdfTituloProd{font-size:14px; font-size:13px;}

 .tableReadOnly tr.pdfProdSMALL img.imgTD{width:100px;}
 tr.pdfProdSMALL td.pdfTituloProd{font-size:13px;}
 
 /*solo para que se vea bien la read only online*/
 .tableReadOnly .tablaLimpia td.descContainer{width:20% !important;}
 .tableReadOnly tbody>tr>td{vertical-align:middle;}

 .budgetEndUL{margin-top:10px; margin-bottom:20px;}
 
/* ------ END READ ONLY ------- */


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


.tab-pane .superBoton2{
	position: absolute;
right: 195px;
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