<?php include 'home_header.php'; ?>	
	<div id="form_wrapper" role="main" align="left" class="form_wrapper">
		<form name="searchfriend" method="post" action="friend.php" onsubmit="return validateForm()" >
			<h3>Find a friend</h3>		
			<div>
				<label>Search by:</label>
				<input type = 'Radio' name='criteria' value= 'username' checked='checked'>Username</input>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type = 'Radio' name='criteria' value= 'email'>Email</input>					
			</div>
			<div  class="input-group input-group-sm"><input type="text" class="form-control" name="keyname" maxlength="35"/><br/><br/></div>
			<div class="bottom">
				<input type="submit" role='button' class='btn' value="Find" />
				<div class="clear"></div>
			</div>
		</form>			  
   </div>
<?php include 'home_footer.php'; ?>