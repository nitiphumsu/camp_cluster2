<!DOCTYPE html>
<html>

<head>
    <title>Password Generator</title>
</head>

<body>
    <form method="post" action="<?php echo base_url() . '/CampProject/passShow' ?>">
        Email <input type="email" id="email" name="email"> <br>
        Password <input type="text" id="password" name="password"> <br>
        <button type="submit">submit</button>
    </form>

</body>

</html>