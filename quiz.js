$(document).ready(function() {
    var currentQuestionIndex = 0;
    var totalQuestions = $('.quiz').length;
  
    function displayQuestion() {
      $('.quiz').hide();
      $('.quiz:eq(' + currentQuestionIndex + ')').fadeIn();
    }
  
    $('#quizContainer').on('submit', '.quiz', function(e) {
      e.preventDefault();
      var userAnswer = $(this).find('input[type=radio]:checked').val();
      var correctAnswer = $(this).data('correct-answer');
      $.ajax({
        url: 'check_answer.php',
        type: 'POST',
        dataType: 'json',
        data: { answer: userAnswer, correctAnswer: correctAnswer },
        success: function(response) {
          if (response.isCorrect) {
            if (currentQuestionIndex < totalQuestions - 1) {
              currentQuestionIndex++;
              displayQuestion();
            } else {
              alert('Congratulations! You have completed the quiz.');
            }
          } else {
            alert('Sorry, that is incorrect. Please try again.');
          }
        }
      });
    });
  
    displayQuestion();
  });
  