<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Grupo Breitkopf | Dashboard</title>
    <link rel="apple-touch-icon" href="images/ico/apple-icon-120.png">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/extensions/pace.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/weather-icons/climacons.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/meteocons/style.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/charts/morris.css">
	  <link rel="stylesheet" type="text/css" href="vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
	  <link rel="stylesheet" type="text/css" href="vendors/css/extensions/sweetalert.css">
	  <link rel="stylesheet" type="text/css" href="vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/tables/extensions/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/tables/extensions/colReorder.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/tables/extensions/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/tables/extensions/fixedHeader.dataTables.min.css">

    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <link rel="stylesheet" type="text/css" href="css/colors.css">
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="css/core/menu/menu-types/vertical-overlay-menu.css">
    <link rel="stylesheet" type="text/css" href="css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="css/core/colors/palette-gradient.css">
	    
    <link rel="stylesheet" type="text/css" href="css/pages/timeline.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- END Custom CSS-->
	
	    <link rel="apple-touch-icon" href="images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/extensions/pace.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/tables/extensions/responsive.dataTables.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <link rel="stylesheet" type="text/css" href="css/colors.css">
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="css/core/menu/menu-types/vertical-overlay-menu.css">
    <link rel="stylesheet" type="text/css" href="css/core/colors/palette-gradient.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
  <script type="text/javascript" src="nicEdit-latest.js"></script>
  <script type="text/javascript">
//<![CDATA[
  bkLib.onDomLoaded(function() {
        new nicEditor({maxHeight : 200}).panelInstance('area');
        new nicEditor({fullPanel : true,maxHeight : 200}).panelInstance('area1');
  });
  //]]>
  </script>
  <script type="text/javascript">
function id(el) {
  return document.getElementById(el);
}
function mostra(element) {
  if (element) {
    id(element.value).style.display = 'block';
  }
}
function esconde_todos($element, tagName) {
  var $elements = $element.getElementsByTagName(tagName),
      i = $elements.length;
  while(i--) {
    $elements[i].style.display = 'none';
  }
}
window.addEventListener('load', function() {
  var $Masculino = id('Masculino'),
      $Feminino = id('Feminino'),
	  $Outro = id('Outro'),
      $sexo  = id('sel-sexo');

  //mostrando no onload da página
  esconde_todos(id('palco'), 'div');
  mostra(document.querySelector('input[name="rd-sexo"]:checked'));


  //mostrando ao clicar no radio
  var $radios = document.querySelectorAll('input[name="rd-sexo"]');
  $radios = [].slice.call($radios);

  $radios.forEach(function($each) {
    $each.addEventListener('click', function() {
      esconde_todos(id('palco'), 'div');
      mostra(this);
    });
  });
});
</script>
  </head>