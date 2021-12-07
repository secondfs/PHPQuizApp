let currentQuestion = 1;
let answer = [];
let correctAnswers = 0;
let questionCount = document.querySelector('div#question-all').dataset.questioncount;
let questionBlocks = document.querySelectorAll('div.question-block');
let respondCharSpan = document.querySelectorAll('.respond-char');
let nickname = document.querySelector('div#question-all').dataset.nickname;

const token = questionBlocks.item(currentQuestion - 1).querySelector('input[name="_token"]').getAttribute('value');

//todo get counters from API to clean up js

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


    fillAnswerArray();

    const response = sendAnswer(answer,questionId);

    (() => {
        response.then((a) => {
            currentQuestion = a.currentQuestion;
            if( a.isLastQuestion) {
                alert('last');
                saveQuizResult();
                displayQuizResult();
                return;
            }
        });
    })();


    doNextQuestionVisible(currentQuestion);
    clearPreviousAnswer();

    answer = [];

    function fillAnswerArray() {
        questionBlocks.item(currentQuestion - 1 ).querySelectorAll(".checkbox.active").forEach(element => {
            answer.push(parseInt(element.dataset.choise));
        })
    }



}

async function displayQuizResult() {
    window.location.replace(`${window.location.origin}/quiz/${nickname}/`);
}

async function saveQuizResult() {

    let data = {
        'correct_answers' : correctAnswers,
        'nickname' : nickname,
    }

    let response = await fetch(`/api/quiz/${nickname}/`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            "X-CSRF-TOKEN": token,

        },
        // body: JSON.stringify(data)
        body: JSON.stringify(data)
    });
    if (!response.ok) {
        throw new Error("HTTP error " + response.status);
    }
    let result = await response.json();
    console.log('quiz saves');
    return;

}

function clearPreviousAnswer() {
    answerButtons.forEach( element => { element.classList.remove("active")});
    respondCharSpan.forEach( element => { element.classList.remove("highlighted-answer")});
}

function getInnermostHovered() {
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

async function sendAnswer(answer,questionId) {
    let data = {
        'nickname' : nickname,
        'answer' : answer,
        'questionId' : questionId,
    }

    let response = await fetch(`/api/answer/${questionId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            "X-CSRF-TOKEN": token,

        },
        body: JSON.stringify(data)
    });
    if (!response.ok) {
        throw new Error("HTTP error " + response.status);
    }
    let result = await response.json();
    return result;


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




//do async request (xhr) after answering last question





