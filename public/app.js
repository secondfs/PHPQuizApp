let startQuizButton = document.getElementById('startQuiz');
let pushNicknameButton = document.getElementById('pushNickname');
let pushNicknameForm = document.querySelector('[name="nickname"]');

// function startQuiz() {
//     startQuizButton.addEventListener('click', hideStartQuiz);
// }
function hideStartQuiz() {
    startQuizButton.style.display = 'none';
}

function switchToNicknameForm() {
    /*
   Better to separate this two later
     */
    pushNicknameForm.style.display = 'flex';
    startQuizButton.parentElement.remove();
    // startQuizButton.style.display = 'none';

}

startQuizButton.addEventListener('click', switchToNicknameForm);




