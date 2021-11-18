let currentQuestion = 0;
let answer = [];
let correctAnswers = 0;
let questionBlocks = document.querySelectorAll('div.question-block');
let respondCharSpan = document.querySelectorAll('.respond-char');
const token = document.querySelector('input[name="_token"]').getAttribute('value');



let successButton = document.querySelectorAll('div.question-block').item(currentQuestion).querySelector('.btn-success');
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

    doNextQuestionVisible(currentQuestion);
    fillAnswerArray();
    console.log(answer);

    clearPreviousAnswer();

    doAJAXRequest(answer,questionId);


    answer = [];
    currentQuestion++;

    function fillAnswerArray() {
        questionBlocks.item(currentQuestion).querySelectorAll(".checkbox.active").forEach(element => {
            answer.push(element.dataset.choise);
        })
    }
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

function doAJAXRequest(answer,questionId) {
   let data = {
       answer: `${answer.join(',')}`,
       questionId: `${questionId}`,
   }
   console.log(data);


    let response = fetch(`/api/answer/${questionId}/`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8',
            // "X-CSRF-TOKEN": token,

        },
        body: JSON.stringify(data)
    });
    // let result = response.json();
    // alert(result.message);
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



