<?php
	session_start();   // for management of errors during keyword insertion
	require 'db_prova_connect.php'; 
?>  
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">      
	<title>Search Contact Results</title>
	<link rel="stylesheet" type="text/css" href="./contacts.css">
</head>

<body>
	<div id="banner"> 					<!-- Banner -->
		<img id="banner_image" src="./contactlogo.jpg" alt="My Contacts Logo">
	</div>  <!-- Banner -->
		
	<!-- search input checks  --> 
	<?php 
		// pattern checking for searching:
			$search_firstname_pattern = "#^[a-zA-Z'\s\-]*$#";
			$search_surname_pattern = "#^[a-zA-Z'\s\-]+$#";
			$search_telephone_pattern = "#^[0-9]{6,16}$#";
			$search_email_pattern = "#^[A-Za-z0-9_\.]*@[A-Za-z0-9_\.]*$#";
			
			$search_firstname_pattern_check = preg_match($search_firstname_pattern,$_POST['firstname']);
			$search_surname_pattern_check = preg_match($search_surname_pattern,$_POST['surname']);
			$search_telephone_pattern_check = preg_match($search_telephone_pattern,$_POST['telephone']);
			$search_email_pattern_check = preg_match($search_email_pattern,$_POST['email']);

			
		// search field checks
		//
		// check that AT LEAST ONE search field has been compiled --> NB. alternatively use empty("") = true
		if ( $_POST['firstname'] == "" && $_POST['surname'] == "" && $_POST['telephone'] == "" && $_POST['email'] == "" ){
			// reload the search contact page
			header('Location:./search_contact.php');	
			// define the $_SESSION parameters and error message	
			$_SESSION['no_search_error'] = "*** At least one search field must be specified! ***";   		
			$_SESSION['firstname'] = $_POST['firstname'];
			$_SESSION['surname'] = $_POST['surname'];
			$_SESSION['telephone'] = $_POST['telephone'];
			$_SESSION['email'] = $_POST['email'];
		}

		// check that if the firstname search field is not empty, then the firstname is in the correct format
		if ( $_POST['firstname'] != "" && $search_firstname_pattern_check != 1 ){
			// reload the search contact page
			header('Location:./search_contact.php');	
			// define the $_SESSION parameters and error message	
			$_SESSION['firstname_error'] = "* The firstname must contain only valid characters.";   		
			$_SESSION['firstname'] = $_POST['firstname'];
			$_SESSION['surname'] = $_POST['surname'];
			$_SESSION['telephone'] = $_POST['telephone'];
			$_SESSION['email'] = $_POST['email'];
		}
		
		// check that if the surname search field is not empty, then the surname is in the correct format
		if ( $_POST['surname'] != "" && $search_surname_pattern_check != 1 ){
			// reload the search contact page
			header('Location:./search_contact.php');	
			// define the $_SESSION parameters and error message	
			$_SESSION['surname_error'] = "* The surname must contain only valid characters.";   		
			$_SESSION['firstname'] = $_POST['firstname'];
			$_SESSION['surname'] = $_POST['surname'];
			$_SESSION['telephone'] = $_POST['telephone'];
			$_SESSION['email'] = $_POST['email'];
		}

		// check that if the telephone number search field is not empty, then the telephone number is in the correct format
		if ( $_POST['telephone'] != "" && $search_telephone_pattern_check != 1 ){
			// reload the search contact page
			header('Location:./search_contact.php');	
			// define the $_SESSION parameters and error message	
			$_SESSION['telephone_error'] = "* The telephone number must consist of between 6 and 16 digits.";   		
			$_SESSION['firstname'] = $_POST['firstname'];
			$_SESSION['surname'] = $_POST['surname'];
			$_SESSION['telephone'] = $_POST['telephone'];
			$_SESSION['email'] = $_POST['email'];
		}
		
		// check that if the email search field is not empty, then the email address is in the correct format
		if ( $_POST['email'] != "" && $search_email_pattern_check != 1 ){
			// reload the search contact page
			header('Location:./search_contact.php');	
			// define the $_SESSION parameters and error message	
			$_SESSION['email_error'] = "* The email address must be in the correct format.";   		
			$_SESSION['firstname'] = $_POST['firstname'];
			$_SESSION['surname'] = $_POST['surname'];
			$_SESSION['telephone'] = $_POST['telephone'];
			$_SESSION['email'] = $_POST['email'];
		}

		//
		// CONSTRUCTION OF THE SEARCH STRING
		//
		// configure the search query string parts in the case that they are not empty and satisfy the checks
		//
		// initialize the empty query string array
		$query_string_array = array();
		
		// add a part to the search query in the case that the corresponding search field is not-empty and satisfies the match criteria
		//
		if ( $_POST['firstname'] != "" && $search_firstname_pattern_check == 1 ){
			array_push($query_string_array, "Firstname = \"{$_POST['firstname']}\""); 
		}
		
		if ( $_POST['surname'] != "" && $search_surname_pattern_check == 1 ){
			array_push($query_string_array, "Surname = \"{$_POST['surname']}\"");
		}

		if ( $_POST['telephone'] != "" && $search_telephone_pattern_check == 1 ){
			array_push($query_string_array, "Telephone = \"{$_POST['telephone']}\"");
		}
		
		if ( $_POST['email'] != "" && $search_email_pattern_check == 1 ){
			array_push($query_string_array, "Email = \"{$_POST['email']}\"");
		}
		
				
		// construct the concatenated query string ending
		$search_query_ending = $query_string_array[0];		// default query ending with only a single part
		
		// in the case of multiple (match consistent) search keywords
		if ( count($query_string_array) > 1 ){
			for ( $i=1; $i < count($query_string_array); $i++ ){
				$search_query_ending = $search_query_ending." AND ".$query_string_array[$i];
			}
		}
	
		// construct the final search query string
			$search_query = "SELECT * FROM contacts WHERE ".$search_query_ending;
			$search_result = mysql_query($search_query, $db); 
			$search_rows = mysql_num_rows($search_result);	
				
			// some results found (NB. No difference in display of results if number of records = 1 or > 1!
				if ($search_rows):
			?>
					<div id="preamble_results">					<!-- preamble results -->
						<span>Here are the results of your search for:
							<span id="search_keywords">
								<?php
									$search_keywords_string = $query_string_array[0];
									if ( count($query_string_array) > 1 ){
										for ( $i=1; $i < count($query_string_array); $i++ ){
											$search_keywords_string = $search_keywords_string.", ".$query_string_array[$i];
										}
									}
									echo $search_keywords_string;
								?>
							</span>
						</span>
					</div>  <!-- preamble results -->

					<div id="div_results">						<!-- search results -->
						<table id="table_search_results">
							<tr>
								<td id="td_search_results">Contact ID</td>
								<td id="td_search_results">Name</td>
								<td id="td_search_results">Telephone Number</td>
								<td id="td_search_results">Email Address</td>
							</tr>
							<?php 
								while ( $search_row = mysql_fetch_assoc($search_result) ): 
							?>
							<tr>					
								<td id="td_search_results_data"><?php echo $search_row['id']; ?></td> 
								<td id="td_search_results_data"><?php echo $search_row['firstname']." ".$search_row['surname']; ?></td> 
								<td id="td_search_results_data"><?php echo $search_row['telephone']; ?></td> 
								<td id="td_search_results_data"><?php echo $search_row['email']; ?></td> 
							</tr>
							<?php endwhile; ?>		
						</table>
					</div>	<!-- search results -->	
			
			<!-- no results found -->
			<?php
				else:
			?>
			
			<div id="no_results"> 								<!-- no search results -->
				<span>Sorry, there are no contacts that match your search criteria:
					<span id="search_keywords">
						<?php
							$search_keywords_string = $query_string_array[0];
							if ( count($query_string_array) > 1 ){
								for ( $i=1; $i < count($query_string_array); $i++ ){
									$search_keywords_string = $search_keywords_string.", ".$query_string_array[$i];
								}
							}
							echo $search_keywords_string;
						?>
					</span>
				</span>
			</div>  <!-- no search results -->
							
			<?php
				endif;
			?>
	
	
	<div id="links_search_contact_results">			<!-- links -->
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
				<td>Return to the search contacts page</td>
			</tr>
		</table>
	</div>  <!-- links -->
			
</body>

</html>