<?php 
// Converts a unix timestamp to iCal format (UTC) - if no timezone is 
// specified then it presumes the uStamp is already in UTC format. 
// tzone must be in decimal such as 1hr 45mins would be 1.75, behind 
// times should be represented as negative decimals 10hours behind 
// would be -10 
	ini_set('display_errors','off');
    ini_set('date.timezone', 'America/Mexico_City');
    error_reporting(E_ALL ^ E_NOTICE);

	if (!function_exists('json_encode')) {
	    function json_encode($content) {
	        require_once '../JSON.php';
	        $json = new Services_JSON;
	        return $json->encode($content);
	    }
	}

	function unixToiCal($uStamp = 0, $tzone = 0.0) { 
	
		$uStampUTC = $uStamp + ($tzone * 3600);        
		$stamp  = date("Ymd\THis\Z", $uStampUTC); 
		
		return $stamp;        

	}
	function db_conect($db){
		global $conn;
		// echo "vamos bien conect";
		if ($db = "prod") {
			$conn = oci_connect('wp_db', 'wp1', 'PROD_MX');
		} elseif($db = "mxoptix") {
			$conn = oci_connect('phase2', 'g4it2day', 'MXOPTIX');
		}
		return $conn;   
	} 

	function getJsonData($stid){
		$table = array();
		oci_fetch_all($stid, $table,0,-1, OCI_FETCHSTATEMENT_BY_ROW);

		/*
			 {
				name: 'OSABW1',
				color: 'rgba(119, 152, 191, .5)',
				data: [fecha,tiempoCiclo]
			}
		*/
		$seriesNames = array();
		$n = array();
		/* 
			SERIAL_NUM
			PASS_FAIL
			PROCESS_DATE
			SYSTEM_ID
			STEP_NAME
			CYCLE_TIME
		Esto lo utilizaba para el formato de las fechas pero ya no es necesario
		*/
		$i=0;
		foreach ($table as $key => $value) {
			if (in_array($value['SYSTEM_ID', $seriesNames)) {
				$n[i] = array(array_search($value['SYSTEM_ID', $seriesNames));
			} else {
				# code...
			}
			
			$newTable[$i] = array(strtotime($value['TESTHOUR'])*1000, (float)$value['CYCLE_TIME']);
			$i++;
		}
		
		$n = json_encode($n);
		file_put_contents('n.json', $n);
		return $n;
	}



	if (true) {
		$query = file_get_contents("./cicle_time_query.sql");
		$conn = oci_connect('phase2', 'g4it2day', 'MXOPTIX');
		$stid = oci_parse($conn, $query);
		oci_execute($stid);
	} else {
		$pack_id = false;
	}

	$datos = getJsonData($stid);
	//Sets database conection to PROD_MX
	// $conn = oci_connect('query', 'query', 'rduxu');

	//Sets and execute the query

?><!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Utilizacion OSABW1</title>

		<script type="text/javascript" src="./jquery-1.8.1.min.js"></script>
		<script type="text/javascript">
$(function () {
	var chart;
	$(document).ready(function() {
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'container',
				type: 'scatter',
				zoomType: 'xy'
			},
			title: {
				text: 'Tiempo de ciclo por pieza'
			},
			subtitle: {
				text: 'OSABW1'
			},
			xAxis: {
				type: 'datetime',
				title: {
					enabled: true,
					text: 'Hora de registro'
				},
				startOnTick: true,
				endOnTick: true,
				showLastLabel: true
			},
			yAxis: {
				title: {
					text: 'Tiempo de ciclo'
				},
				alternateGridColor: null,
				plotBands: [{ // Light air
                    from: 0.0,
                    to: 8.0,
                    color: 'rgba(68, 170, 213, 0.1)',
                    label: {
                        text: 'Buen tiempo de ciclo',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // Light breeze
                    from: 8.0,
                    to: 100,
                    color: 'rgba(0, 0, 0, 0)',
                    label: {
                        text: 'Tiempo de ciclo normal excedido',
                        style: {
                            color: '#606060'
                        }
                    }
                }]
			},
			tooltip: {
				formatter: function() {
						return ''+  Highcharts.dateFormat('%e. %b %Y, %H:%M', this.x) +' | [' + this.y +' min]';
				}
			},
			legend: {
				layout: 'vertical',
				align: 'left',
				verticalAlign: 'top',
				x: 100,
				y: 70,
				floating: true,
				backgroundColor: '#FFFFFF',
				borderWidth: 1
			},
			plotOptions: {
				scatter: {
					marker: {
						radius: 5,
						states: {
							hover: {
								enabled: true,
								lineColor: 'rgb(100,100,100)'
							}
						}
					},
					states: {
						hover: {
							marker: {
								enabled: false
							}
						}
					}
				}
			},
			 series: [<?php print_r($series); ?>]
		});
	});
	
});
		</script>
	</head>
	<body>
<script src="./js/highcharts.js"></script>
<script src="./js/modules/exporting.js"></script>

<div id="container" style="min-width: auto; height: auto; margin: 0 auto"></div>

</body>
</html>
