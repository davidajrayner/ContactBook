<?php
	session_start();
	require 'db_prova_connect.php';
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">      
	<title>Search Contacts</title>
	<link rel="stylesheet" type="text/css" href="./contacts.css">
</head>

<body>
	<div id="banner"> 											<!-- Banner -->
		<img id="banner_image" src="./contactlogo.jpg" alt="My Contacts Logo">
	</div>  <!-- Banner -->

	
	<div id="search_form_container"> 							<!-- search form container -->
	
		<div id="search_contact_preamble" class="header">		<!-- search contact preamble -->
			<p>
				Use one (or more) of the fields below to search for your contact:
			</p>
		</div>  <!-- search contact preamble -->
		
		
		<div id="search_form_div">    							<!-- search form -->
		
			<form id="search_form" method="POST" action="./search_contact_results.php"> 
		
				<div id="firstname_div" class="contact_fields">			<!-- firstname -->
					<span class="contact_fields">Firstname</span><br>
					<input name="firstname" type="text"
						<?php if ( isset($_SESSION['firstname']) ): ?> 
							value = "<?php echo $_SESSION['firstname'];?>" 
						<?php 
								endif; 
								unset($_SESSION['firstname']); ?> >
					<span id="firstname_error" class="error">
						<?php if( isset($_SESSION['firstname_error']) ){
								echo $_SESSION['firstname_error'];
								unset($_SESSION['firstname_error']);
							}
						?>
					</span>
				</div>  <!-- firstname -->
							
				<div id="surname_div" class="contact_fields">				<!-- surname -->
					<span class="contact_fields">Surname</span><br>
					<input name="surname" type="text"
						<?php if ( isset($_SESSION['surname']) ): ?> 
							value = "<?php echo $_SESSION['surname'];?>" 
						<?php 
								endif; 
								unset($_SESSION['surname']); ?> >
					<span id="surname_error" class="error">
						<?php if( isset($_SESSION['surname_error']) ){
								echo $_SESSION['surname_error'];
								unset($_SESSION['surname_error']);
							}
						?>
					</span>
				</div>  <!-- surname -->

				<div id="telephone_div" class="contact_fields">			<!-- telephone number -->			
					<span class="contact_fields">Telephone Number</span><br>
					<input name="telephone" type="text"
						<?php if ( isset($_SESSION['telephone']) ): ?> 
							value = "<?php echo $_SESSION['telephone'];?>" 
						<?php 
								endif; 
								unset($_SESSION['telephone']); ?> >
					<span id="telephone_error" class="error">
						<?php if( isset($_SESSION['telephone_error']) ){
								echo $_SESSION['telephone_error'];
								unset($_SESSION['telephone_error']);
							}
						?>
					</span>
				</div>  <!-- telephone number -->
				
				<div id="email_div" class="contact_fields">			<!-- email address -->
					<span class="contact_fields">Email Address</span><br>
					<input name="email" type="text"
						<?php if ( isset($_SESSION['email']) ): ?> 
							value = "<?php echo $_SESSION['email'];?>" 
						<?php 
								endif; 
								unset($_SESSION['email']); ?> >
					<span id="email_error" class="error">
						<?php if( isset($_SESSION['email_error']) ){
								echo $_SESSION['email_error'];
								unset($_SESSION['email_error']);
							}
						?>
					</span>
				</div>  <!-- email address-->
			
				<div id="search_submit">				<!-- search submit -->
					<input id="submitBtn" name="submit" value="Search" type="submit">
					<span class="identical_contact_error">
						<?php 
							if( isset($_SESSION['no_search_error']) ){
								echo $_SESSION['no_search_error'];
								unset($_SESSION['no_search_error']);
							}
						?></span>
				</div>	<!-- search submit -->
	
			</form>
			
		</div> 	<!-- search form -->	
		
	</div>  <!-- search form container -->

	
	<div id="links_search_contact">  					<!-- links -->
		<table id="tab_links">
			<tr>
				<!-- link to index page -->
				<td id="td_links_footer_icon"><a href="./index.php"><img id="img_link_icon_footer" src="./img_index_return.jpg" alt="index"></a></td>
				<td id="td_links_footer_text">Return to the home page</td>
				
				<!-- link to insertion page -->
				<td id="td_links_footer_icon"><a href="./insert_contact.php"><img id="img_link_icon_footer" src="./img_insert.jpg" alt="insert"></a></td>
				<td>Insert a new contact</td>
			</tr>
		</table>
	</div>  <!-- links -->
	
	
</body>

</html>