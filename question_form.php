<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Answer Questions</title>
</head>
<body>

<h2>Answer the Questions</h2>

<form action="check_answers.php" method="post">
  <?php foreach ($questions as $index => $question): ?>
    <label for="answer<?php echo $index; ?>">Question <?php echo $index + 1; ?>: <?php echo $question; ?></label><br>
    <input type="text" id="answer<?php echo $index; ?>" name="answers[]" required><br><br>
  <?php endforeach; ?>
  <input type="submit" value="Submit Answers">
</form>

</body>
</html>
