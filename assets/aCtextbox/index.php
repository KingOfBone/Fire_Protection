<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Autocomplete textbox using jQuery, PHP and MySQL by CodexWorld</title>
  <link rel="stylesheet" href="jquery-ui.css">
  <script src="jquery-1.10.2.js"></script>
  <script src="jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#skills" ).autocomplete({
      source: 'search.php'
    });
  });
  </script>
</head>
<body>
 
<div class="ui-widget">
  <label for="skills">Skills: </label>
  <input id="skills">
</div>
</body>
</html>