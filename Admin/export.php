<?php
include __DIR__ . '/../includes/db.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=contact_messages.xls");

$result = $conn->query("SELECT * FROM contact_messages");

echo "ID\tName\tEmail\tPhone\tUrgent\tDate\tIP\tMessage\n";

while($row = $result->fetch_assoc()){
    echo $row['id']."\t";
    echo $row['name']."\t";
    echo $row['email']."\t";
    echo $row['phone']."\t";
    echo ($row['urgent'] ? 'Yes' : 'No')."\t";
    echo $row['preferred_date']."\t";
    echo $row['ip_address']."\t";
    echo $row['message']."\n";
}
exit();