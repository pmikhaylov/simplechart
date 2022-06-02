<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная</title>
</head>

<body>
    <h1>Постройте график отношения доллара к рублю</h1>
    @if( $errors->any() )
    	<div>
        	<ul>
        		@foreach($errors->all() as $error)
        			<li>{{ $error }}</li>
        		@endforeach
        	</ul>
    	</div>
    @endif

	<p>Задайте период для графика</p>
	<form method="get" action="/check">
		<p>От <input type="date" name="datefirst" id="datefirst"><br></p>
		<p>До <input type="date" name="datesecond" id="datesecond"><br></p>
		<button type="submit">Готово</button>
	</form>
	
	<?php if( isset($_GET["date1"]) && isset($_GET["date2"]) ): ?>
		<?php $xml = simplexml_load_file('https://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=' . $_GET["date1"] . '&date_req2=' . $_GET["date2"] . '&VAL_NM_RQ=R01235');
		$series = array();
		foreach( $xml->Record as $record )
		{
		    $date = date( $record['Date']);
		    $arr = array('YY' => $date[6] . $date[7] . $date[8] . $date[9],
		                 'mm' => $date[3] . $date[4],
		                 'dd' => $date[0] . $date[1],
		                 'y' => floatval( str_replace(',' , '.' , $record->Value ) ) );
		    array_push( $series, $arr );
		}
		?>
		<div id="container" style="width:100%; height:400px;"></div>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		
        <script>
        	document.addEventListener('DOMContentLoaded', function () 
        	{
            	var uData = <?php echo json_encode($series)?>;
    			outData = [];
    			for (i = 0; i < uData.length; i++) 
    			{
        			outData[i] = 
        			{
            			x: Date.UTC( parseInt(uData[i].YY) , parseInt(uData[i].mm) -1 , parseInt(uData[i].dd) ),
            			y: uData[i].y
        			}
    			}
    			
        		const chart = Highcharts.chart('container', 
        		{
            		title: 
            		{
            		    text: 'Динамика курса доллара'
            		},
            		xAxis: 
            		{
            		    type: 'datetime'
            		},
            		yAxis: 
            		{
                		title: 
                		{
                	    	text: 'Курс'
                		}
            		},
            		series: 
            		[{
                		name: 'Курс',
                		data: outData
            		}]
        		});
    		});
		</script>
	<?php endif; ?>
	
</body>
</html>