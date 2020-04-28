<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="font-family: Arial; font-size: 12px;">
<div>
    <p>
        You have requested a password reset, please follow the link below to reset your password.
    </p>
    <p>
        Please ignore this email if you did not request a password change.
    </p>

    <p>
        <a href="<?php echo base_url().'auth/updatepassword?resetToken='.$resetlink;?>">
            Follow this link to reset your password.
        </a>
    </p>
</div>
</html>
