<?php
include_once 'connect.php';

if(isset($_POST['selected_option']))
    $selected_option=filter_input(INPUT_POST, "selected_option", FILTER_SANITIZE_STRING);
else exit(); // No value is sent

$query="SELECT * FROM models WHERE manufacturer_id='$selected_option'"; // Just an example. Build the query as per your logic

// Process your query
$stmt = $pdo->prepare($query);
$stmt->execute();

$options="<option value='all'>Vsi modeli</option>";

while($row = $stmt->fetch()) // For simplicity. Proceed with your PDO
{
    $options.="<option value=".$row['id'].">".$row['name']."</option>"; // Where option_value will be the value for you option and Text for the Option is the text displayed for the particular option
}
echo $options;
?>