<!DOCTYPE html>
<html ng-app="app">

<!-- Mirrored from themesanytime.com/startui/demo/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Nov 2016 01:49:00 GMT -->
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>CRM Midia9 - Potencialize seu Négocio</title>

	<link href="img/favicon.144x144.html" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.html" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.html" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.html" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.html" rel="icon" type="image/png">
	<link href="img/favicon-2.html" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

<link rel="stylesheet" href="<?=base_url('assets')?>/css/separate/vendor/tags_editor.min.css">
<link rel="stylesheet" href="<?=base_url('assets')?>/css/separate/vendor/bootstrap-select/bootstrap-select.min.css">
<link rel="stylesheet" href="<?=base_url('assets')?>/css/separate/vendor/select2.min.css">
<link rel="stylesheet" href="<?=base_url('assets')?>/css/lib/multipicker/multipicker.min.css"> <!-- original css -->
<link rel="stylesheet" href="<?=base_url('assets')?>/css/separate/vendor/multipicker.min.css"> <!-- customization css -->
<link rel="stylesheet" href="<?=base_url('assets')?>/css/separate/vendor/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?=base_url('assets')?>/css/separate/vendor/bootstrap-daterangepicker.min.css">
<link rel="stylesheet" href="<?=base_url('assets')?>/css/lib/clockpicker/bootstrap-clockpicker.min.css">

<link rel="stylesheet" href="<?=base_url('assets')?>/css/lib/lobipanel/lobipanel.min.css">
<link rel="stylesheet" href="<?=base_url('assets')?>/css/separate/vendor/lobipanel.min.css">
<link rel="stylesheet" href="<?=base_url('assets')?>/css/lib/jqueryui/jquery-ui.min.css">
<link rel="stylesheet" href="<?=base_url('assets')?>/css/separate/pages/widgets.min.css">
<link rel="stylesheet" href="<?=base_url('assets')?>/css/lib/font-awesome/font-awesome.min.css">
<link rel="stylesheet" href="<?=base_url('assets')?>/css/lib/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('assets')?>/css/main.css">
<link rel="stylesheet" href="<?=base_url('assets')?>/css/style.css">

<link rel="stylesheet" type="text/css" href="http://cdn.marketingmidia9.com.br/css/ngDialog.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ng-dialog/0.6.4/css/ngDialog-theme-plain.css">

</head>
<body class="with-side-menu control-panel control-panel-compact">

	<?=$header?>

	<div class="mobile-menu-left-overlay"></div>
	<?=$menu?>

	<?=$content?>


	<script src="<?=base_url('assets')?>/js/lib/jquery/jquery.min.js"></script>
	<script src="<?=base_url('assets')?>/js/lib/tether/tether.min.js"></script>
	<script src="<?=base_url('assets')?>/js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="<?=base_url('assets')?>/js/plugins.js"></script>

	<script type="text/javascript" src="<?=base_url('assets')?>/js/lib/jqueryui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?=base_url('assets')?>/js/lib/lobipanel/lobipanel.min.js"></script>
	<script type="text/javascript" src="<?=base_url('assets')?>/js/lib/match-height/jquery.matchHeight.min.js"></script>
	<script type="text/javascript" src="<?=base_url('assets')?>/charts/loader.js"></script>

	<script src="<?=base_url('assets')?>/js/lib/peity/jquery.peity.min.js"></script>
	<script src="<?=base_url('assets')?>/js/lib/table-edit/jquery.tabledit.min.js"></script>

	<script src="<?=base_url('assets')?>/js/lib/jquery-tag-editor/jquery.caret.min.js"></script>
	<script src="<?=base_url('assets')?>/js/lib/jquery-tag-editor/jquery.tag-editor.min.js"></script>
	<script src="<?=base_url('assets')?>/js/lib/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="<?=base_url('assets')?>/js/lib/moment/moment-with-locales.min.js"></script>
		<script src="<?=base_url('assets')?>/js/lib/eonasdan-bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<script src="<?=base_url('assets')?>/js/lib/clockpicker/bootstrap-clockpicker.min.js"></script>
	<script src="<?=base_url('assets')?>/js/lib/daterangepicker/daterangepicker.js"></script>
	<script src="<?=base_url('assets')?>/js/lib/daterangepicker/pt-br.js"></script>
	<script src="<?=base_url('assets')?>/js/lib/select2/select2.full.min.js"></script>

	<script type="text/javascript" src="http://cdn.marketingmidia9.com.br/js/angular.min.js"></script>
	<script type="text/javascript" src="http://cdn.marketingmidia9.com.br/js/angular-route.min.js"></script>
	<script type="text/javascript" src="http://cdn.marketingmidia9.com.br/js/ngDialog.min.js"></script>
	<script type="text/javascript" src="http://cdn.marketingmidia9.com.br/js/ngMask.min.js"></script>
	<script type="text/javascript" src="http://cdn.marketingmidia9.com.br/js/ngStorage.min.js"></script>
	<script type="text/javascript" src="http://cdn.marketingmidia9.com.br/js/angular-bootstrap-select.js"></script>


	<script type="text/javascript" src="<?=base_url()?>/app/factories.js"></script>
	<script type="text/javascript" src="<?=base_url()?>/app/controllers/dashboard.js"></script>
	<script type="text/javascript" src="<?=base_url()?>/app/controllers/empresa.js"></script>
	<script type="text/javascript" src="<?=base_url()?>/app/controllers/usuario.js"></script>
	<script type="text/javascript" src="<?=base_url()?>/app/controllers/produto.js"></script>
	<script type="text/javascript" src="<?=base_url()?>/app/controllers/marketing.js"></script>
	<script type="text/javascript" src="<?=base_url()?>/app/app.js"></script>

	<script>
		/*$(document).ready(function() {
			$('.panel').lobiPanel({
				sortable: true
			});
			$('.panel').on('dragged.lobiPanel', function(ev, lobiPanel){
				$('.dahsboard-column').matchHeight();
			});

			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
				var dataTable = new google.visualization.DataTable();
				dataTable.addColumn('string', 'Day');
				dataTable.addColumn('number', 'Values');
				// A column for custom tooltip content
				dataTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
				dataTable.addRows([
					['MON',  130, ' '],
					['TUE',  130, '130'],
					['WED',  180, '180'],
					['THU',  175, '175'],
					['FRI',  200, '200'],
					['SAT',  170, '170'],
					['SUN',  250, '250'],
					['MON',  220, '220'],
					['TUE',  220, ' ']
				]);

				var options = {
					height: 314,
					legend: 'none',
					areaOpacity: 0.18,
					axisTitlesPosition: 'out',
					hAxis: {
						title: '',
						textStyle: {
							color: '#fff',
							fontName: 'Proxima Nova',
							fontSize: 11,
							bold: true,
							italic: false
						},
						textPosition: 'out'
					},
					vAxis: {
						minValue: 0,
						textPosition: 'out',
						textStyle: {
							color: '#fff',
							fontName: 'Proxima Nova',
							fontSize: 11,
							bold: true,
							italic: false
						},
						baselineColor: '#16b4fc',
						ticks: [0,25,50,75,100,125,150,175,200,225,250,275,300,325,350],
						gridlines: {
							color: '#1ba0fc',
							count: 15
						},
					},
					lineWidth: 2,
					colors: ['#fff'],
					curveType: 'function',
					pointSize: 5,
					pointShapeType: 'circle',
					pointFillColor: '#f00',
					backgroundColor: {
						fill: '#008ffb',
						strokeWidth: 0,
					},
					chartArea:{
						left:0,
						top:0,
						width:'100%',
						height:'100%'
					},
					fontSize: 11,
					fontName: 'Proxima Nova',
					tooltip: {
						trigger: 'selection',
						isHtml: true
					}
				};

				var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
				chart.draw(dataTable, options);
			}
			$(window).resize(function(){
				drawChart();
				setTimeout(function(){
				}, 1000);
			});
		});*/
	</script>
<script src="<?=base_url('assets')?>/js/app.js"></script>
</body>

<!-- Mirrored from themesanytime.com/startui/demo/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Nov 2016 01:49:00 GMT -->
</html>