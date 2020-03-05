<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	<title>Multiplication table</title>
</head>
<body>
<h1>Multiplication table</h1>

<?php

for($i = 1; $i < 10; $i++)
{
	echo "<tr>";
	for($j = 1; $j < 10; $j++)
    {
	    if ($i == 1 || $j == 1)
		{
			echo "<th>".($i*$j)."</th>";
		}
		else
		{
			echo "<td>".($i*$j)."</td>";
		}
    }
	echo "</tr>";
}

echo "</table>";

?>

</body>
</html>
