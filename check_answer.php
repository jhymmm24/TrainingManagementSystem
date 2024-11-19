<?php
session_start();

// Get submitted answer and question index
$answer = $_POST['answer'];
$questionIndex = $_POST['questionIndex'];

// Check if answer is correct
$correctAnswer = $_SESSION['answers'][$questionIndex][0];
$isCorrect = ($answer == $correctAnswer) ? true : false;

// If answer is correct, display next question
if ($isCorrect) {
    $nextQuestionIndex = $questionIndex + 1;
    if ($nextQuestionIndex < count($_SESSION['questions'])) {
        echo "<h2>Question {$nextQuestionIndex}</h2>";
        echo "<p>{$_SESSION['questions'][$nextQuestionIndex]}</p>";
        echo "<form id='quizForm'><input type='hidden' name='questionIndex' value='{$nextQuestionIndex}'>";
        foreach ($_SESSION['answers'][$nextQuestionIndex] as $index => $answer) {
            echo "<label><input type='radio' name='answer' value='{$answer}'> {$answer}</label><br>";
        }
        echo "<input type='submit' value='Submit Answer'></form>";
    } else {
        echo "<p>Congratulations! You have completed the quiz.</p>";
    }
} else {
    echo "<p>Sorry, that is incorrect. Please try again.</p>";
}
?>
