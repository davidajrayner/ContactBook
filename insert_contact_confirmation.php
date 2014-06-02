<?php
	session_start();   // for management of errors during keyword insertion
	require 'db_prova_connect.php'; 
?>  
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">      
	<title>Insert Contact confirmation</title>
	<link rel="stylesheet" type="text/css" href="./contacts.css">
</head>

<body>
	<div id="banner"> 					<!-- Banner -->
		<img id="banner_image" src="./contactlogo.jpg" alt="My Contacts Logo">
	</div>  <!-- Banner -->
		
		
	<!-- user input checks  --> 
	<?php 
		// pattern checking for insertion:
			$insert_firstname_pattern = "#^[A-Z][a-zA-Z'\s\-]*$#";
			$insert_surname_pattern = "#^[a-zA-Z'\s\-]+$#";
			$insert_telephone_pattern = "#^[0-9]{6,16}$#";
			$insert_email_pattern = "#^[A-Za-z0-9_\.]*@[A-Za-z0-9_\.]*$#";
			
			$insert_firstname_pattern_check = preg_match($insert_firstname_pattern,$_POST['firstname']);
			$insert_surname_pattern_check = preg_match($insert_surname_pattern,$_POST['surname']);
			$insert_telephone_pattern_check = preg_match($insert_telephone_pattern,$_POST['telephone']);
			$insert_email_pattern_check = preg_match($insert_email_pattern,$_POST['email']);
		
					
		// check that the firstname is in the correct format
		if ( $insert_firstname_pattern_check != 1 ){
			// reload the insert contact page
			header('Location:./insert_contact.php');	
			// define the $_SESSION parameters and error message	
			$_SESSION['firstname_error'] = "* This field is mandatory. The firstname must start with a capital letter and contain only valid characters.";   		
			$_SESSION['firstname'] = $_POST['firstname'];
			$_SESSION['surname'] = $_POST['surname'];
			$_SESSION['telephone'] = $_POST['telephone'];
			$_SESSION['email'] = $_POST['email'];
		}
		
		// check that the surname is in the correct format
		if ( $insert_surname_pattern_check != 1 ){
			// reload the insert contact page
			header('Location:./insert_contact.php');	
			// define the $_SESSION parameters and error message	
			$_SESSION['surname_error'] = "* This field is mandatory. The surname must contain only valid characters.";   		
			$_SESSION['firstname'] = $_POST['firstname'];
			$_SESSION['surname'] = $_POST['surname'];
			$_SESSION['telephone'] = $_POST['telephone'];
			$_SESSION['email'] = $_POST['email'];
		}

		// check that the telephone number is in the correct format
		if ( $insert_telephone_pattern_check != 1 ){
			// reload the insert contact page
			header('Location:./insert_contact.php');	
			// define the $_SESSION parameters and error message	
			$_SESSION['telephone_error'] = "* This field is mandatory.  The telephone number must consist of between 6 and 16 digits.";   		
			$_SESSION['firstname'] = $_POST['firstname'];
			$_SESSION['surname'] = $_POST['surname'];
			$_SESSION['telephone'] = $_POST['telephone'];
			$_SESSION['email'] = $_POST['email'];
		}
		
		// check that the email address is in the correct format
		if ( $insert_email_pattern_check != 1 ){
			// reload the insert contact page
			header('Location:./insert_contact.php');	
			// define the $_SESSION parameters and error message	
			$_SESSION['email_error'] = "* This field is mandatory.  The email address must be in the correct format.";   		
			$_SESSION['firstname'] = $_POST['firstname'];
			$_SESSION['surname'] = $_POST['surname'];
			$_SESSION['telephone'] = $_POST['telephone'];
			$_SESSION['email'] = $_POST['email'];
		}


		//
		//
		// insertion of a new contact --> all fields must be compiled correctly
		if ( $insert_firstname_pattern_check == 1 && $insert_surname_pattern_check == 1 && $insert_telephone_pattern_check == 1 
				&& $insert_email_pattern_check == 1 ):
				
		// check if an identical contact is already present in database
			$check_query = "SELECT * FROM contacts WHERE firstname = \"{$_POST['firstname']}\" AND surname = \"{$_POST['surname']}\" AND
								telephone = \"{$_POST['telephone']}\" AND email = \"{$_POST['email']}\" ";
			$check_result = mysql_query($check_query, $db);
			$check_rows = mysql_num_rows($check_result);
								
		// an identical contact found in database --> reload page and show identical error
			if ( $check_rows != 0 ){
				// reload the insert contact page
				header('Location:./insert_contact.php');	
				// define the $_SESSION parameters and error message	
				$_SESSION['identical_error'] = "*** This contact is already present in your database! ***";   		
				$_SESSION['firstname'] = $_POST['firstname'];
				$_SESSION['surname'] = $_POST['surname'];
				$_SESSION['telephone'] = $_POST['telephone'];
				$_SESSION['email'] = $_POST['email'];
			} 
			
		// NO identical contact found in database --> insert new contact into database
			if ( $check_rows == 0 ):
				$insert_query = "INSERT INTO contacts (firstname, surname, telephone, email) 
									VALUES (\"{$_POST['firstname']}\", \"{$_POST['surname']}\", \"{$_POST['telephone']}\",  
												\"{$_POST['email']}\" )";
				$insert_result = mysql_query($insert_query, $db);
				
				// check correct databasse insertion for confirmation message
				$insert_check_query = "SELECT * FROM contacts WHERE firstname = \"{$_POST['firstname']}\" AND surname = \"{$_POST['surname']}\" AND
								telephone = \"{$_POST['telephone']}\" AND email = \"{$_POST['email']}\"";
				$insert_check_result = mysql_query($insert_check_query, $db);
				$insert_check_rows = mysql_num_rows($insert_check_result);
				$insert_row = mysql_fetch_assoc($insert_check_result);

	?>
	
	<div id="confirmation_header" class="header"> 		<!-- insert contact confirmation header -->
		<span id="highlight_word">Congratulations!</span>  
		<span>The following contact was successfully added to your database:</span>
	</div>	<!-- insert contact confirmation header -->
			
	<div id="div_confirmation"> 						<!-- insert contact confirmation -->
		<table id="table_confirmation">
			<tr>
				<td id="td_confirmation">Contact ID</td>
				<td id="td_confirmation_data"><?php echo $insert_row['id']; ?></td> 
			</tr>
			<tr>
				<td id="td_confirmation">Name</td>
				<td id="td_confirmation_data"><?php echo $insert_row['firstname']." ".$insert_row['surname']; ?></td> 
			</tr>
			<tr>
				<td id="td_confirmation">Telephone No.</td>
				<td id="td_confirmation_data"><?php echo $insert_row['telephone']; ?></td> 
			</tr>
			<tr>
				<td id="td_confirmation">Email Address</td>
				<td id="td_confirmation_data"><?php echo $insert_row['email']; ?></td> 
			</tr>
		</table>
		
		<?php
			endif;
		endif;
		?>
			
	</div>  <!-- insert contact confirmation -->

	<div id="links_insert_contact_confirmation">  <!-- links -->
		<table id="tab_links">
			<tr>
				<!-- link to index page -->
				<td id="td_links_footer_icon"><a href="./index.php"><img id="img_link_icon_footer" src="./img_index_return.jpg" alt="index"></a></td>
				<td id="td_links_footer_text">Return to the home page</td>
				
				<!-- link to insertion page -->
				<td id="td_links_footer_icon"><a href="./insert_contact.php"><img id="img_link_icon_footer" src="./img_insert.jpg" alt="insert"></a></td>
				<td id="td_links_footer_text">Insert a new contact</td>
				
				<!-- link to search page -->
				<td id="td_links_footer_icon"><a href="./search_contact.php"><img id="img_link_icon_footer" src="./img_search.jpg" alt="search"></a></td>
				<td>Search your contacts</td>
			</tr>
		</table>
	</div>  <!-- links -->

	
</body>

</html>