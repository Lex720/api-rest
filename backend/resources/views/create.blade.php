<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <title>API</title>
  
  <!-- BEGIN META -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="your,keywords">
  <meta name="description" content="Short explanation about this website">

</head>

<body>

<form action="/user" method="post">

  <!--<input type="hidden" name="_token" value="<?php //echo csrf_token(); ?>">-->
  <?php //echo csrf_field(); ?>

  <p>
      <input name="name" type="text">
      <label for="name">Name</label>
  </p>

  <p>
      <input name="email" type="text">
      <label for="email">email</label>
  </p>

  <p>
      <input name="password" type="password">
      <label for="password">Pass</label>
  </p>

  <button type="submit">Save</button>

</form>

</body>

</html>