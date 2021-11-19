let currentQuestion = 0;
let answer = [];
let correctAnswers = 0;
let questionCount = document.querySelector('div#question-all').dataset.questioncount;
let questionBlocks = document.querySelectorAll('div.question-block');
let respondCharSpan = document.querySelectorAll('.respond-char');
let nickname = document.querySelector('div#question-all').dataset.nickname;

const token = questionBlocks.item(currentQuestion).querySelector('input[name="_token"]').getAttribute('value');


let successButtons = document.querySelectorAll('.btn-success');
let answerButtons = document.querySelectorAll('button.checkbox');

function chooseAnswer() {
    let currentElement = getInnermostHovered().closest('button');
    let highlightedChar = currentElement.querySelector(".respond-char");

    currentElement.classList.toggle("active");
    highlightedChar.classList.toggle("highlighted-answer");


}

function doAnswer() {
    let questionId = questionBlocks.item(currentQuestion).querySelector('span.question_id').dataset.questionId;


    fillAnswerArray();
    if(isLastQuestion()) {
        alert("it's over");
        saveQuizResult();
        displayQuizResult();
        return;
    }
    doNextQuestionVisible(currentQuestion);
    clearPreviousAnswer();

    sendAnswer(answer,questionId);


    answer = [];
    currentQuestion++;



    function fillAnswerArray() {
        questionBlocks.item(currentQuestion).querySelectorAll(".checkbox.active").forEach(element => {
            answer.push(element.dataset.choise);
        })
    }




}

async function displayQuizResult() {
    window.location.replace(`${window.location.origin}/quiz/${nickname}/`);
    // let response =  await fetch(`${window.location.origin}/quiz/${nickname}/`);
    // let result = await response.json();
    // if (!response.ok) {
    //     throw new Error("HTTP error " + response.status);
    // }
    // console.log(result);

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
        body: JSON.stringify(data)
    });
    if (!response.ok) {
        throw new Error("HTTP error " + response.status);
    }
    let result = await response.json();
    console.log(result);

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
    let questionBlockActive = document.querySelectorAll('div.question-block').item(currentQuestion);
    let questionBlockNext = document.querySelectorAll('div.question-block').item(currentQuestion + 1);
    questionBlockActive.style.display="none";


    questionBlockNext.style.display="block";
}

async function sendAnswer(answer,questionId) {
    let data = {
        'answer' : answer,
        'questionId' : questionId,
    }



    let response = await fetch(`/api/answer/${questionId}/`, {
        method: 'POST',
        headers: {
            // 'Content-Type': 'application/json;charset=utf-8',
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
    if(result == true) {
        return correctAnswers++;
    }
}

function isLastQuestion() {

    return currentQuestion >= questionCount - 1? true : false;
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



