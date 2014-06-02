<?php
	session_start();   // for management of errors during keyword insertion
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">      
	<title>Insert a Contact</title>
	<link rel="stylesheet" type="text/css" href="./contacts.css">
</head>

<body>
	<div id="banner"> 										<!-- Banner -->
		<img id="banner_image" src="./contactlogo.jpg" alt="My Contacts Logo">
	</div>  <!-- Banner -->

	<div id="insert_contact_form_container"> 				<!-- insert contact form container -->
	
		<div id="insert_contact_preamble" class="header">	<!-- insert contact preamble -->
			<p>
			In order to insert a new contact, please compile the form below:
			</p>
		</div>  <!-- insert contact preamble -->
		
		
		<div id="insert_contact_form_div">    						<!-- insert contact form -->
		
			<form id="insert_contact_form" method="POST" action="./insert_contact_confirmation.php"> 
			
				<div id="firstname_div" class="contact_fields">		<!-- firstname -->
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
							
				<div id="surname_div" class="contact_fields">		<!-- surname -->
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

				<div id="telephone_div" class="contact_fields">		<!-- telephone number -->			
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
								
				<div id="insert_submit">							<!-- insert submit -->
					<input id="submitBtn" name="submit" value="Insert" type="submit">
					<span class="identical_contact_error">
						<?php 
							if( isset($_SESSION['identical_error']) ){
								echo $_SESSION['identical_error'];
								unset($_SESSION['identical_error']);
							}
						?></span>
				</div>	<!-- insert submit -->
				
			</form>
				
		</div> 	<!-- insert contact form -->
		
	</div>  <!-- insert contact form container -->
	
	
	<div id="links_insert_contact">			<!-- links -->
		<table id="tab_links">
			<tr>
				<!-- link to index page -->
				<td id="td_links_footer_icon"><a href="./index.php"><img id="img_link_icon_footer" src="./img_index_return.jpg" alt="index"></a></td>
				<td id="td_links_footer_text">Return to the home page</td>
				
				<!-- link to search page -->
				<td id="td_links_footer_icon"><a href="./search_contact.php"><img id="img_link_icon_footer" src="./img_search.jpg" alt="search"></a></td>
				<td>Search your contacts</td>
			</tr>
		</table>
	</div>  <!-- links -->

	
</body>

</html>