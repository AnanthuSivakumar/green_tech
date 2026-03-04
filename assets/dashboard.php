<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY id DESC");
?>

<h2>Contact Messages</h2>
<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>Name</th>
<th>Phone</th>
<th>Email</th>
<th>Message</th>
<th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['message']; ?></td>
<td><?php echo $row['created_at']; ?></td>
</tr>
<?php } ?>
</table>