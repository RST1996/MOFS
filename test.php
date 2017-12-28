<?php
	print_r($_GET);
?>
<!DOCTYPE html>
<html>
<body>

<form action="test.php" method="get">
  <input list="browsers" name="browser">
  <datalist id="browsers">
    <option value="Internet Explorer">abc</option>
    <option value="Firefox">
    <option value="Chrome">
    <option value="Opera">
    <option value="Safari">
  </datalist>
  <input type="submit">
</form>

<p><strong>Note:</strong> The datalist tag is not supported in Internet Explorer 9 and earlier versions, or in Safari.</p>

</body>
</html>