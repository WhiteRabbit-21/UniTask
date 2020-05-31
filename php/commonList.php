<?php
    require_once("connection.php");
    $result = mysqli_query($con, "SELECT * FROM students ORDER BY lastName");
    $row = mysqli_fetch_array($result);
	

    printf("

	<style> 
	T2Caption{font-size:25px;}
	.Centr{
		text-align:left;}
	#studentsTables{margin:25px;
	}
	#studentsTittleTH{padding: 10px;}
	
	</style>

            <table id='studentsTables' cellspacing=''>
                <caption><T2Caption><b>Список студентів<b></T2Caption></caption>
                <tr><th id='studentsTittleTH'>ПІБ</th><th id='studentsTittleTH'>Факультет</th><th id='studentsTittleTH'>Гуртожиток</th><th id='studentsTittleTH'>Кімната</th></tr>
    ");
    do
    {
        printf("
	
                <tr><th id='studentsTH' class='Centr'>" .$row[lastName]. " " .$row[firstName]. "</th>
		    <th id='studentsTH'>" .$row[faculty]. "</th>
	            <th id='studentsTH'>" .$row[dormitory]. "</th>
		    <th id='studentsTH'>" .$row[room]. "</th></tr>
        ");
    }
    while($row = mysqli_fetch_array($result));
    printf("</table>")
?>