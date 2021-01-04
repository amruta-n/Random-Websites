<!DOCTYPE html>
<html>
<head>
	<style>
	.error {color: #FF0000;}
	.succ {color: #00CC00}
	</style>
	<title>Book Store</title>
</head>

<body>

<?php
	$servername='localhost';
	$user='root';
	$pass='';
	$db='BookStore';
	$conn=mysqli_connect($servername, $user, $pass, $db);
	if(!$conn){
		die("Connection Failed:". mysqli_connect_error());
	}

	$anameErr="";
?>
	<h2>The Book Store</h2>
	<div class="error">* These fields are mandatory</div>
	<form method="post" >

		<h3><i>~Add a book~</i></h3>
		<label>Book Name<span class="error">* </span>: </label>
		<input type="text" name="abname" id="abname">
		<br>
		<br>
		<label>ISBN No.<span class="error">* </span>: </label>
		<input type="number" name="aisbn" id="aisbn">
		<br>
		<br>
		<label>Book Title: </label>
		<input type="text" name="abtitle" id="abtitle">
		<br>
		<br>
		<label>Author Name<span class="error">* </span>: </label>
		<input type="text" name="aaname" id="aaname">
		<br>
		<br>
		<label>Publisher Name<span class="error">* </span>: </label>
		<input type="text" name="apname" id="apname">
		<br>
		<br>
		<input type="submit" value="Add" name="add">
		<br>
		<br>
		<?php 
			if(isset($_POST['add'])){
				$bname= $_REQUEST['abname'];
				$isbn= $_REQUEST['aisbn'];
				$btitle= $_REQUEST['abtitle'];
				$aname= $_REQUEST['aaname'];
				$pname= $_REQUEST['apname'];
				$sql1="INSERT INTO books VALUES ('$bname', '$isbn', '$btitle', '$aname', '$pname')";
				if(empty($bname) || empty($isbn) ||empty($aname) || empty($pname)){
					echo "<span class=error>Please enter all the mandatory fields!</span>";
				}else if(isset($_POST['aaname']) && 1 === preg_match('~[0-9]~', $_POST['aaname'])){
					echo '<span class=error>Author name cannot contain numbers</span>';
				}else if(isset($_POST['apname']) && 1 === preg_match('~[0-9]~', $_POST['apname'])){
					echo '<span class=error>Publisher name cannot contain numbers</span>';
				}else{
					if(mysqli_query($conn, $sql1)){
						echo "<span class=succ>Record Added Successfully!</span>";
					}else{
						//echo "Error:".mysqli_error($conn);
						echo "<span class=error>Duplicate entry for ISBN No. not accepted</span>";
					}
				}
				
			}
		?>

		<h3><i>~Edit existing book details~</i> </h3>
		<label>Enter ISBN No. of the book to edit details<span class="error">* </span>: </label>
		<input type="number" name="eisbn" id="eisbn">
		<br>
		<br>
		<label>Edit Book Name: </label>
		<input type="text" name="ebname" id="ebname">
		<br>
		<br>
		<label>Edit Book Title: </label>
		<input type="text" name="ebtitle" id="ebtitle">
		<br>
		<br>
		<label>Edit Author Name: </label>
		<input type="text" name="eaname" id="eaname">
		<br>
		<br>
		<label>Edit Publisher Name: </label>
		<input type="text" name="epname" id="epname">
		<br>
		<br>
		<input type="submit" value="Edit" name="edit">
		<br>
		<br>
		<?php
			if(isset($_POST['edit'])){
	
			if($_POST['eisbn']===""){
				echo "<span class=error>Please enter ISBN No. of the book to edit the details!</span>";
			}else if(isset($_POST['epname']) && 1 === preg_match('~[0-9]~', $_POST['epname'])){
				echo '<span class=error>Publisher name cannot contain numbers</span>';
			}else if(isset($_POST['eaname']) && 1 === preg_match('~[0-9]~', $_POST['eaname'])){
				echo '<span class=error>Author name cannot contain numbers</span>';
			}else{
				$isbn2= $_REQUEST['eisbn'];
				$sql2="SELECT * FROM books WHERE `isbn` = '$isbn2'";
				$result2=mysqli_query($conn, $sql2);
				if($result2){
					$nr2=mysqli_num_rows($result2);
					if($nr2===0){
						echo "<span class=error>Please enter an existing ISBN No.</span>";
					}else{
						$isbn2= $_REQUEST['eisbn'];
						if($_POST['ebname']!=""){
							$bname2= $_REQUEST['ebname'];
							$sql2="UPDATE books SET book_name='$bname2' WHERE isbn='$isbn2'";
							mysqli_query($conn, $sql2);
						}
						if($_POST['ebtitle']!=""){
							$btitle2= $_REQUEST['ebtitle'];
							$sql2="UPDATE books SET book_title= '$btitle2' WHERE isbn='$isbn2'";
							mysqli_query($conn, $sql2);
						}
						if($_POST['eaname']!=""){
							
								$aname2= $_REQUEST['eaname'];
								$sql2="UPDATE books SET auth_name='$aname2' WHERE isbn='$isbn2'";
								mysqli_query($conn, $sql2);
							
							
						}
						if($_POST['epname']!=""){
							
								$pname2= $_REQUEST['epname'];
								$sql2="UPDATE books SET pub_name='$pname2' WHERE isbn='$isbn2'";
								mysqli_query($conn, $sql2);
							
						}
						echo "<span class=succ>Record changed Successfully!</span>";
					}
						
				 }
			}	 	
		}
		?>


		<h3><i>~Delete existing book~</i></h3>
		<label>Enter ISBN No. of the book<span class="error">* </span>: </label>
		<input type="number" name="disbn" id="disbn">
		<br>
		<br>
		<input type="submit" value="Delete" name="del">
		<br>
		<br>
		<?php
			if(isset($_POST['del'])){
				if($_POST['disbn']===""){
					echo "<span class=error>Please enter ISBN No. of the book to delete the record!</span>";
				}else{
					$isbn3= $_REQUEST['disbn'];
					$sql3="SELECT * FROM books WHERE `isbn` = '$isbn3'";
					$result=mysqli_query($conn, $sql3);
					if($result){
						$nr=mysqli_num_rows($result);
						if($nr===0){
							echo "<span class=error>Please enter an existing ISBN No.</span>";
						}else{
							$sql4="DELETE FROM books WHERE `isbn` = '$isbn3'";
							$res=mysqli_query($conn, $sql4);
							if($res){
								echo "<span class=succ>Record Deleted Successfully!</span>";
							}else{
								echo "Error:".mysqli_error($conn);
							}
							
						}
						
					 }
				}
			}
		?>


		<h3><i>~Books~</i></h3>
		<table>
			<tr>
				<th>Book Name</th>
				<th>ISBN No.</th>
				<th>Book Title</th>
				<th>Author Name</th>
				<th>Publisher Name</th>
			</tr>
			<?php
				$conn = mysqli_connect("localhost", "root", "", "BookStore");
				$sql="SELECT * FROM books";
				$rs=mysqli_query($conn, $sql);
				$nrow=mysqli_num_rows($rs);
				if($nrow>0){
					while($row=mysqli_fetch_assoc($rs)){
						echo '<tr>';
						echo '<td>'.$row["book_name"].'</td>';
						echo '<td>'.$row["isbn"].'</td>';
						echo '<td>'.$row["book_title"].'</td>';
						echo '<td>'.$row["auth_name"].'</td>';
						echo '<td>'.$row["pub_name"].'</td>';
						echo '</tr>';
					}
				}else{
					echo '';
				}
				mysqli_close($conn);
			?>
			
			
		</table>

	</form>
</body>
</html>
