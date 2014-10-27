<?php
//inclumos la base de datos
include("./Connections/cx.php");
//inlcuimos lso calendarios
include("scrips/calendario/calendario.php");
//include("scrips/calendario/calendario.php");

//esctraemos todas las variables
extract($_REQUEST);
//icniaializacmos las secciones
session_start();
$mensaje='';
if(!isset($_SESSION["login"]))
{
$insert=mysql_query("INSERT INTO bitacora (text) VALUES('Acceso de Intruso fallido al Área de Registro  Mediante la URL')");
header("location: index.php");
}

//desturi session
if(isset($des))
{	
	//echo "<h1>funca</h1>";
		//unset($_SESSION['login']);
		$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Cerro Sessión')");
		session_destroy();
		
		header("location: index.php");
		
}

$borrar_tempo=mysql_query("delete from t_01");
$borrar_tempo=mysql_query("delete from t_02");
$borrar_tempo=mysql_query("delete from t_03");
$borrar_tempo=mysql_query("delete from tempo");
/*
$query_anio=mysql_query("SELECT periodo FROM datos");
$row_anio=mysql_fetch_array($query_anio);

$date=date('Y-m-d');
$antes=explode('-',$date);
$resta=intval($antes[0])-$row_anio['periodo'];
$date2=$resta."-".date('m-d');
$query_rango_date=mysql_query("select * from per_consejo where date(per_consejo_des) between '$date2' and '$date' ");
$fet=mysql_fetch_array($query_rango_date);

*/
//consutla para saber si han registrado actas


$query_datos=mysql_query("SELECT * FROM datos");
$row_datos=mysql_fetch_array($query_datos);

	$query_numero_de_per=mysql_query("SELECT per_consejo_id, per_consejo_id   FROM per_consejo  WHERE per_activo=1");
	
	$compro_numero_per=mysql_num_rows($query_numero_de_per);
	if($compro_numero_per==1)
	{
		//NUMERO EDITABLE DE ACTA
			$row_per=mysql_fetch_array($query_numero_de_per);
		$query_numero_de_acta=mysql_query("SELECT * FROM actas  WHERE act_conid=$row_per[per_consejo_id] AND  act_lb=$select1");
		$row__acta=mysql_fetch_array($query_numero_de_acta);
		
		$compro_numero_acta=mysql_num_rows($query_numero_de_acta);
		if($compro_numero_acta<1)
		{
			$n_acta=$row_datos['n_acta_ini'];
			
		}
		else 
		{
			
			$query_nnn=mysql_query("select max(act_num) FROM actas Where act_lb=$select1");
			$nnn=mysql_fetch_array($query_nnn);
			
			$n_acta=$nnn[0]+1;
		}
		/*
		
		//NUMERO AUTOMATICO DE ACTA 
			$row_per=mysql_fetch_array($query_numero_de_per);
		$query_numero_de_acta=mysql_query("SELECT * FROM actas  WHERE act_conid=$row_per[per_consejo_id]");
		
		$compro_numero_acta=mysql_num_rows($query_numero_de_acta);
		if($compro_numero_acta<1)
		{
			$n_acta=1;
			
		}
		else
		{
			$n_acta=$compro_numero_acta+1;
		}
		
		
		
		*/
		
		
	}
	else
	{
		header("location: m_registro_consejo_consejo.php");
	}
	
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla_1.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Registro Actas</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

<script language="javascript" src="scrips/calendario/javascripts.js"></script>

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrap">
<div id="header">
<div id="logo">
<h1 id="sitename"><img src="img/logo1.png"  /><span class="green"></span></h1>
<h2 class="description">&nbsp;</h2>
</div>
<div id="headercontent"><!-- InstanceBeginEditable name="EditRegion_session" -->
<form method="post" name="session" enctype="application/x-www-form-urlencoded"> 
<table width="295" border="0" align="center" background="">
  <tr>
    <td colspan="4" align="center"><h2>Bienvenid@: </h2></td>
  </tr>
  <tr>
    <td width="95" align="center"><img src="img/personas/<?php echo $_SESSION['img']; ?>"  width="50 px" height="70 px" title=" <?php echo $_SESSION['name']; ?>" alt=" <?php echo $_SESSION['name']; ?>"/></td>
    <td width="165" colspan="3" align="center"><h2><?php echo $_SESSION['name']; ?> </h2> </td>
    </tr>
    <tr>
    	<td colspan="4" align="center"><input type="submit"
        name="des" value="Cerrar Sesión"   />      </td>
    </tr>
  </table>
</form>
<!-- InstanceEndEditable --></div>
<div id="sitecption"><!-- InstanceBeginEditable name="EditRegion_tex2" -->
 <p>Alcaldía  <span class="bigger">Municipal</span></p>
  <p> de Usulután</p>
<!-- InstanceEndEditable --></div>
</div>
<div id="main">
<div id="menus">
	<!-- InstanceBeginEditable name="EditRegion_menu" -->
    <div id="mainmenu">
    
    <ul>
    <li class="first" ><a href="inicio.php">Inicio</a></li>
    <li id="active"><a href="./bitacora/bitacora_m_registro.php">Registro</a></li>
    <li><a href="./bitacora/bitacora_m_consultas.php">busquedas</a></li>
    <li><a href="contruccion_reportes.php">reportes</a></li>
    <li><a href="./bitacora/bitacora_m_mantenimiento.php">Mantenimiento</a></li>
    <li><a href="#">salir</a></li>
    <li><a href="#">&nbsp;</a></li>
    
    </ul>
  
    </div>
   
    <div id="submenu">
  
   <li><a href="m_registro_personas.php">Personas</a></li>
    <li><a href="m_registro_empleados.php">Empleados</a> </li>
    <li><a href="m_registro_consejo.php">Concejo</a></li>
    <li><a href="m_registro_actas_menu2.php">Actas</a></li>
    <li><a href="m_registro_acuerdos.php">Acuerdos</a></li>
    </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
 
	

<div align="center">
  
  <table width="75%" border="0" cellspacing="5" align="center">
    <tr>
      
      <td align="center"><h2 >Registro del Actas</h2></td>
      </tr>
    <tr>
      <td align="center">
        <form method="post" name="registro_actas" enctype="application/x-www-form-urlencoded" action="registro/procesa_acta_a.php" >
          <table width="60%" border="0" cellspacing="5">
            <tr>
              <th width="19%" scope="row">N° Acta</th>
              <th width="21%" scope="row"><span id="sprytextfield1">
                <label for="text1"></label>
                <input type="text" name="text1" id="text1" readonly="readonly"  size="10"value="<?php echo $n_acta; ?>" /> <input type="hidden" name="h1" value="<?php echo $row_per['per_consejo_id']; ?>"  />
                <span class="textfieldRequiredMsg">*.</span></span></th>
              <th width="14%"  scope="row" align="right"><input type="hidden" name="lb" value="<?php echo $select1; ?>" />Fecha </th>
              <th width="46%"  align="left"><span id="sprytextfield2">
                <label for="text2"></label>
                <input type="text" name="text2" id="text2" onclick="muestraCalendario('','registro_actas','text2')" style="cursor:pointer" />
                <span class="textfieldRequiredMsg">*.</span></span> </th>
              
              </tr>
            <tr>
              <th colspan="4" scope="row"><input type="button" value="Lista de Personas" name="lista" onclick="open('./consultas/ges_asis.php?id_consejo=<?php echo $row_per['per_consejo_id'];?>&id_acta=<?php echo $n_acta; ?>','per','width=900, height=700','scrollbars=yes')" style="cursor: pointer"    /></th>
              </tr>
            <tr>
              <th colspan="4" scope="row">Hora de inicio<span id="spryselect1">
                <select name="select1" id="select1">
                  <option value="0">-elija la hora-</option>
                  <option value="8">8 HORAS</option>
                  <option value="9">9 HORAS</option>
                  <option value="10">10 HORAS</option>
                  <option value="11">11 HORAS</option>
                  <option value="12">12 HORAS</option>
                  <option value="13">13 HORAS</option>
                  <option value="14">14 HORAS</option>
                  <option value="15">15 HORAS</option>
                  <option value="16">16 HORAS</option>
                  <option value="17">17 HORAS</option>
                  <option value="18">18 HORAS</option>
                  <option value="19">19 HORAS</option>
                  <option value="20">20 HORAS</option>
                  <option value="21">21 HORAS</option>
                  <option value="22">22 HORAS</option>
                  </select>
  <span class="selectInvalidMsg">    *.</span></span></th>
              </tr>
            <tr>
              <th colspan="4" scope="row">hora de finalizacion <span id="spryselect2">
                <label for="select2"></label>
                <select name="select2" id="select2">
                    <option value="0">-elija-</option >
                    <option value="8">8</option >
                    <option value="9">9</option >
                    <option value="10">10</option >
                    <option value="11">11</option >
                    <option value="12">12</option >
                    <option value="13">13</option >
                    <option value="14">14</option >
                    <option value="15">15</option >
                    <option value="16">16</option >
                    <option value="17">17</option >
                    <option value="18">18</option >
                    <option value="19">19</option >
                    <option value="20">20</option >
                    <option value="21">21</option >
                    <option value="22">22</option >
                    <option value="23">23</option >
                </select>
                <span class="selectInvalidMsg">*.</span></span>:<span id="spryselect3">
                <label for="select3"></label>
                <select name="select3" id="select3">
                <option value="0">-elija-</option >
<option value="1">1</option >
<option value="2">2</option >
<option value="3">3</option >
<option value="4">4</option >
<option value="5">5</option >
<option value="6">6</option >
<option value="7">7</option >
<option value="8">8</option >
<option value="9">9</option >
<option value="10">10</option >
<option value="11">11</option >
<option value="12">12</option >
<option value="13">13</option >
<option value="14">14</option >
<option value="15">15</option >
<option value="16">16</option >
<option value="17">17</option >
<option value="18">18</option >
<option value="19">19</option >
<option value="20">20</option >
<option value="21">21</option >
<option value="22">22</option >
<option value="23">23</option >
<option value="24">24</option >
<option value="25">25</option >
<option value="26">26</option >
<option value="27">27</option >
<option value="28">28</option >
<option value="29">29</option >
<option value="30">30</option >
<option value="31">31</option >
<option value="32">32</option >
<option value="33">33</option >
<option value="34">34</option >
<option value="35">35</option >
<option value="36">36</option >
<option value="37">37</option >
<option value="38">38</option >
<option value="39">39</option >
<option value="40">40</option >
<option value="41">41</option >
<option value="42">42</option >
<option value="43">43</option >
<option value="44">44</option >
<option value="45">45</option >
<option value="46">46</option >
<option value="47">47</option >
<option value="48">48</option >
<option value="49">49</option >
<option value="50">50</option >
<option value="51">51</option >
<option value="52">52</option >
<option value="53">53</option >
<option value="54">54</option >
<option value="55">55</option >
<option value="56">56</option >
<option value="57">57</option >
<option value="58">58</option >
<option value="59">59</option >

                </select>
                <span class="selectInvalidMsg">*.</span></span>:<span id="spryselect4">
                <label for="select4"></label>
                <select name="select4" id="select4">
                                <option value="0">-elija-</option >
                                <option value="1">1</option >
                                <option value="2">2</option >
                                <option value="3">3</option >
                                <option value="4">4</option >
                                <option value="5">5</option >
                                <option value="6">6</option >
                                <option value="7">7</option >
                                <option value="8">8</option >
                                <option value="9">9</option >
                                <option value="10">10</option >
                                <option value="11">11</option >
                                <option value="12">12</option >
                                <option value="13">13</option >
                                <option value="14">14</option >
                                <option value="15">15</option >
                                <option value="16">16</option >
                                <option value="17">17</option >
                                <option value="18">18</option >
                                <option value="19">19</option >
                                <option value="20">20</option >
                                <option value="21">21</option >
                                <option value="22">22</option >
                                <option value="23">23</option >
                                <option value="24">24</option >
                                <option value="25">25</option >
                                <option value="26">26</option >
                                <option value="27">27</option >
                                <option value="28">28</option >
                                <option value="29">29</option >
                                <option value="30">30</option >
                                <option value="31">31</option >
                                <option value="32">32</option >
                                <option value="33">33</option >
                                <option value="34">34</option >
                                <option value="35">35</option >
                                <option value="36">36</option >
                                <option value="37">37</option >
                                <option value="38">38</option >
                                <option value="39">39</option >
                                <option value="40">40</option >
                                <option value="41">41</option >
                                <option value="42">42</option >
                                <option value="43">43</option >
                                <option value="44">44</option >
                                <option value="45">45</option >
                                <option value="46">46</option >
                                <option value="47">47</option >
                                <option value="48">48</option >
                                <option value="49">49</option >
                                <option value="50">50</option >
                                <option value="51">51</option >
                                <option value="52">52</option >
                                <option value="53">53</option >
                                <option value="54">54</option >
                                <option value="55">55</option >
                                <option value="56">56</option >
                                <option value="57">57</option >
                                <option value="58">58</option >
                                <option value="59">59</option >

                </select>
                <span class="selectInvalidMsg">*.</span></span></th>
              </tr>
            <tr>
              <th colspan="4" scope="row"><p>&nbsp;</p>
                <p>tipo de acta &nbsp;
                  <input type="radio" name="radio" id="radio1" value="1" checked="checked" />
                  <label for="radio">Ordinaria </label>
                  <input type="radio" name="radio" id="radio2" value="2" />Extra ordinaria	
                  </label>
                  <input type="radio" name="radio" id="radio3" value="3" disabled="disabled" />
                  <label for="radio3">Otros</label>
                  </p>    </th>
              </tr>
            <tr>
            <tr>
            <th scope="row" colspan="4" align="center" ><input type="button" name="observa" value="Observaciones del Consejo" onclick="open('./obser/add_obser.php','per','width=700, height=500','scrollbars=yes')" style="cursor: pointer"   /><br />&nbsp;</th>
           
            </tr>
            
              <th scope="row">Acta</th>
              <th colspan="3" scope="row"><span id="sprytextarea1">
                <label for="textarea1"></label>
                <textarea name="textarea1" id="textarea1" cols="45" rows="10"></textarea>
                <span id="countsprytextarea1">&nbsp;</span><span class="textareaRequiredMsg">*.</span><span class="textareaMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></span></th>
              </tr>
            <tr>
              <th colspan="4" scope="row"><p>
                <input type="submit" name="guardar" value="Guardar"  />
                &nbsp; &nbsp; &nbsp;<input type="reset" value="Borrar"  />
                </p></th>
              </tr>
            <tr>
              <th colspan="4" scope="row">* Dato Obligatorio</th>
              </tr>
            </table>
          </form>
        
        </td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      </tr>
  </table>
  <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"], counterId:"countsprytextarea1", counterType:"chars_count", maxChars:65000});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"0", validateOn:["change"], isRequired:false});
    </script>
</div
>
    <script type="text/javascript">
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {isRequired:false, invalidValue:"0", validateOn:["change"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {isRequired:false, invalidValue:"0", validateOn:["change"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {isRequired:false, invalidValue:"0", validateOn:["change"]});
    </script>
    <!-- InstanceEndEditable -->
    </div>
<div class="clear"></div>



</div>
</div>
<div id="footer">
Aplicaion_actas&amp;acuerdos &copy; Todos los Derechos reservados 2012<br />

Tec. Oscar René Sánchez<br />
version 0.2.0</div>



</div>
</body>
<!-- InstanceEnd --></html>
