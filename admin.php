<?php
    include 'navbar.php';
    $sql = $koneksiPdo ->prepare('select*from admin');
    $sql ->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center> <a href="admin_input.php"> <input type="button" class="mt-5 btn btn-primary" value="Add New Admin"> </a> </center>
    <table align=right class="table table-responsive-md table-hover mt-5"> 
		<thead>
			<th> ID Admin</th>
			<th> Nama </th>
			<th> Email </th>
			<th colspan=3> Action </th>
			
		</thead> 
		<?php while ($data=$sql->fetch()){ ?>
			<tr>
				<td> <?php echo $data['id_admin']; ?> </td>
				<td> <?php echo $data['nama']; ?> </td>
				<td> <?php echo $data['email']; ?> </td>
				<td width=10%> <?php echo "<a href=#> <input type='button' class='btn btn-warning btn-sm' value='Edit'> </a>";?> </td>
		<?php } ?></table> </form> </div>
</body>
</html>