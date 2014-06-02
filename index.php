<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">      
	<title>My Contact Book</title>
	<link rel="stylesheet" type="text/css" href="./contacts.css">
</head>

<body>
	<div id="banner"> 						<!-- Banner -->
		<img id="banner_image" src="./contactlogo.jpg" alt="My Contacts Logo">
	</div>  <!-- Banner -->
	
	<div id="index_preamble">				<!-- preamble -->
		It's now easier to use <span id="highlight_word">My Contact Book</span> to keep track of all your contacts.   
		You can save your friends' telephone numbers and email addresses and then utilize the search functionality to find their information with ease.
	</div>  <!-- preamble -->
	
	<div id="links_index">					<!-- links -->
		<table id="tab_links">
			<tr>	<!-- link to insertion page -->
				<td id="td_links"><a href="./insert_contact.php"><img id="img_link_icon_index" src="./img_insert.jpg" alt="insert"></a></td>
				<td><span id="highlight_word">Insert a new contact</span></td>
			</tr>
			<tr>	<!-- link to search page -->
				<td id="td_links"><a href="./search_contact.php"><img id="img_link_icon_index" src="./img_search.jpg" alt="search"></a></td>
				<td><span id="highlight_word">Search your contacts</span></td>
			</tr>
		</table>
	</div>  <!-- links -->

</body>

</html>