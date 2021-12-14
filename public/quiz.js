let currentQuestion = 1;

let questionCount = document.querySelector('div#question-all').dataset.questioncount;
let questionBlocks = document.querySelectorAll('div.question-block');
let respondCharSpan = document.querySelectorAll('.respond-char');


// todo remove token from all but 1 question (to header metateg) (done)
const token = document.querySelector("meta[property='token']").getAttribute('content')

let successButtons = document.querySelectorAll('.btn-success');
let answerButtons = document.querySelectorAll('button.checkbox');

function chooseAnswer() {
    let currentElement = getInnermostHovered().closest('button');
    let highlightedChar = currentElement.querySelector(".respond-char");

    currentElement.classList.toggle("active");
    highlightedChar.classList.toggle("highlighted-answer");


}

function doAnswer() {
    let questionId = questionBlocks.item(currentQuestion - 1).querySelector('span.question_id').dataset.questionId;
    let nickname = document.querySelector('div#question-all').dataset.nickname;
    let answerIds = fillAnswerArray();

    sendAnswer(answerIds,questionId,nickname)
        .then( response => response.json())
        .then( ({answersCount,isLastQuestion,correctAnswersCount,correctAnswers}) => {
            //todo show to user correct answer(each) with setTimeout (done)
                if( isLastQuestion) {
                    showQuizResult(nickname);
                }else{
                    highlightCorrectAnswer(correctAnswers);
                    setTimeout( () => {
                        doNextQuestionVisible(currentQuestion);
                        clearPreviousAnswer();
                        currentQuestion++;
                    }, 1000);
                }
            }
        );

}

function fillAnswerArray() {
    let answerIds = [];
    questionBlocks.item(currentQuestion - 1 ).querySelectorAll(".checkbox.active").forEach(element => {
        answerIds.push(parseInt(element.dataset.choise));
    })

    return answerIds;
}

function showQuizResult(nickname) {
    window.location.replace(`${window.location.origin}/quiz/${nickname}/`);
}

function highlightCorrectAnswer(correctAnswers) {
    let correctAnswerEl;
    correctAnswers.forEach(
        answer => {
            correctAnswerEl = document.querySelector(`[data-choise="${answer}"]`);
            correctAnswerEl.classList.add('bg-success');
        }
    )

}
function clearPreviousAnswer() {
    answerButtons.forEach( element => { element.classList.remove("active")});
    respondCharSpan.forEach( element => { element.classList.remove("highlighted-answer")});
}

function getInnermostHovered() { // todo this via css
    let n = document.querySelector(":hover");
    let nn;
    while (n) {
        nn = n;
        n = nn.querySelector(":hover");
    }
    return nn;
}

function doNextQuestionVisible(currentQuestion) {
    let questionBlockActive = document.querySelectorAll('div.question-block').item(currentQuestion - 1);
    let questionBlockNext = document.querySelectorAll('div.question-block').item(currentQuestion);

    questionBlockActive.style.display="none";
    questionBlockNext.style.display="block";
}

async function sendAnswer(answer,questionId,nickname) {
    let data = {
        'nickname' : nickname,
        'answer' : answer,
        'questionId' : questionId,
    }

    return fetch(`/api/answer/${nickname}/${questionId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            "X-CSRF-TOKEN": token,
        },
        body: JSON.stringify(data)
    });
}


answerButtons.forEach(
    element => {
        element.addEventListener('click',chooseAnswer);
    }
)

successButtons.forEach(
    element => {
        element.addEventListener('click', doAnswer);
    }
);






