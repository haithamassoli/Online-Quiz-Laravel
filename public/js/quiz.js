const submit_Button = document.querySelector(".submit-btn");
const question = document.querySelector(".question");
const allAnswers = document.querySelector(".all-answers");
const spans = document.querySelector(".spans");
const container = document.querySelector(".quiz-container");
const timeText = document.querySelector(".time_left_txt");
const timeCount = document.querySelector(".timer_sec");
const input = document.querySelectorAll("input");
const quizName = document.querySelector(".quiz-name");
const info_box = document.querySelector(".info_box");
const continue_btn = info_box.querySelector(".buttons .restart");
const Show_Answer = document.querySelector(".Show_Answer");
const result_box = document.querySelector(".result_box");
const score_text = document.querySelector(".score_text");
const result = document.querySelector(".result");
const time_line = document.querySelector(".time_line");
const result_img = document.querySelector(".result_img");
const footer = document.querySelector("footer");
const userId = document
    .querySelector("meta[name='user-id']")
    .getAttribute("content");

let largeDiv = document.createElement("div");
let userAnswer;
let numOfQuestion = 0;
let right_answer;
let correct = 0;
let user_answers = [];
let right_answers = [];
let labelAns = [];
let options;
const questionsNum = document.querySelector(".questionsNum");

continue_btn.addEventListener("click", () => {
    info_box.classList.remove("activeInfo");
    container.classList.add("active");
    startTimer(15);
    startTimerLine(15);
});

Show_Answer.addEventListener("click", () => {
    result_box.classList.remove("activeResult");
    container.classList.add("active");
    footer.classList.remove("active");
});

let link = window.location.href.split("/");
let exam_id = link.slice(-1)[0];

function loadQuestions(number) {
    fetch(`http://127.0.0.1:8000/api/exam/${exam_id}`)
        .then((response) => response.json())
        .then((data) => {
            if (number < data[0].exam_num_qus) {
                window.exam_num_qus = data[0].questions.length;
                window.question_id = data[0].questions[number].id;
                console.log(data[0]);
                quizName.innerHTML = data[0].exam_name;
                options = data[0].questions[number].question_options;
                addQuestion(
                    options,
                    data[0].questions[number].question_content
                );
                createBullets(number);
                right_answer = data[0].questions[number].correct_answer;
            }
        });
}
loadQuestions(numOfQuestion);

submit_Button.addEventListener("click", () => {
    checkRightAnswer(right_answer);
    numOfQuestion++;
    reset();
    loadQuestions(numOfQuestion);
    if (numOfQuestion > window.exam_num_qus - 1) {
        loadResult();
        container.classList.remove("active");
        result_box.classList.add("activeResult");
        numOfQuestion = 0;
        clearInterval(counter);
        clearInterval(counterLine);
    }
    if (numOfQuestion == window.exam_num_qus - 1) {
        submit_Button.textContent = "Submit";
    }
    clearInterval(counter);
    clearInterval(counterLine);
    startTimer(15);
    startTimerLine(15);
});

function createBullets(numOfQuestion) {
    for (let i = 0; i <= window.exam_num_qus - 1; i++) {
        const span = document.createElement("span");
        spans.appendChild(span);
        if (i === numOfQuestion) {
            span.classList.add("active-question");
        }
    }
}

function loadResult() {
    fetch(`http://127.0.0.1:8000/api/exam/${exam_id}`)
        .then((response) => response.json())
        .then((data) => {
            // store_user_answer();
            clearInterval(counter);
            clearInterval(counterLine);
            result.innerHTML = "";
            let counterResult = 0;
            // show questions content
            for (let i = 0; i < data[0].questions.length; i++) {
                result.appendChild(largeDiv);
                largeDiv.classList.add("largeDiv");
                let h3 = document.createElement("h3");
                let div = document.createElement("div");
                largeDiv.appendChild(div);
                div.classList.add("qusContainer");
                h3.innerHTML =
                    data[0].questions[counterResult].question_content;
                counterResult++;
                div.appendChild(h3);
                let divAnswers = document.createElement("div");
                divAnswers.classList.add("answers");
                for (
                    let j = 0;
                    j < data[0].questions[i].question_options.split(",").length;
                    j++
                ) {
                    let label = document.createElement("label");
                    label.classList.add("resultLabel");
                    label.innerHTML =
                        data[0].questions[i].question_options.split(",")[j];
                    divAnswers.append(label);
                    labelAns.push(label);
                    labelAns.forEach((e) => {
                        if (
                            e.innerHTML !=
                                data[0].questions[i].correct_answer &&
                            e.innerHTML == user_answers[i]
                        ) {
                            e.classList.add("incorrect");
                        }
                    });
                    if (
                        data[0].questions[i].question_options.split(",")[j] ==
                        data[0].questions[i].correct_answer
                    ) {
                        label.classList.add("correct");
                    }
                }
                div.appendChild(divAnswers);
            }
        });
}

function addQuestion(arrayOfOptions, number_of_question) {
    const questionText = document.createElement("h2");
    questionText.innerHTML = number_of_question;
    question.appendChild(questionText);
    for (let i = 0; i <= arrayOfOptions.split(",").length - 1; i++) {
        const answer = document.createElement("div");
        answer.classList.add("answer");
        const input = document.createElement("input");
        input.name = "answer";
        input.type = "radio";
        input.className = "inputRadio";
        input.id = `answer${i}`;
        const label = document.createElement("label");
        label.setAttribute("for", `answer${i}`);
        let options_split = arrayOfOptions.split(",");
        label.textContent = options_split[i];
        answer.appendChild(input);
        answer.appendChild(label);
        allAnswers.appendChild(answer);
    }
}

function checkRightAnswer(correct_answer) {
    const inputAnswers = document.querySelectorAll("input");
    let userAnswer;
    inputAnswers.forEach((input) => {
        if (input.checked) {
            userAnswer = input.nextElementSibling.innerHTML;
            store_user_answer(userAnswer);
            console.log(userAnswer);
            right_answers.push(correct_answer);
            user_answers.push(userAnswer);
            if (userAnswer !== correct_answer) {
            } else {
                correct++;
            }
        }
    });

    score_text.innerHTML = `${
        correct >= 3 ? "perfect" : "Hard luck"
    } ${correct}/5`;
    if (correct >= 3) {
        score_text.style.color = "green";
        result_img.src = "/img/good.jpg";
    } else {
        score_text.style.color = "red";
        result_img.src = "/img/bad.jpg";
    }
}

function reset() {
    allAnswers.innerText = "";
    spans.innerText = "";
    question.innerText = "";
    userAnswer = "";
    right_answer = "";
}

function startTimer(time) {
    counter = setInterval(timer, 1000);
    function timer() {
        timeCount.textContent = time;
        time--;
        if (time < 9) {
            let addZero = timeCount.textContent;
            timeCount.textContent = "0" + addZero; //add a 0 before time value
        }
        if (time < 0) {
            clearInterval(counter);
            clearInterval(counterLine); //clear counter
            reset();
            numOfQuestion++;
            loadQuestions(numOfQuestion);
            startTimer(15);
            startTimerLine(15);

            numOfQuestion > 4 ? loadResult() : "";
        }
    }
}
function startTimerLine(time) {
    counterLine = setInterval(timer, 29);

    function timer() {
        time += 1; //upgrading time value with 1
        time_line.style.width = time * 0.1821 + "%"; //increasing width of time_line with px by time value
        if (time > 100 + "%") {
            //if time value is greater than 549
            clearInterval(counterLine); //clear counterLine
        }
    }
}

// post date to database

function store_user_answer(userAnswer) {
    fetch("http://127.0.0.1:8000/api/exam/create", {
        method: "POST",
        headers: {
            "Content-type": "application/json",
        },
        body: JSON.stringify({
            exam_id: parseInt(exam_id),
            user_id: parseInt(userId),
            question_id: parseInt(window.question_id),
            user_answer: userAnswer,
            marks: 10,
        }),
    })
        .then((res) => res.json())
        .then(() => location.reload);
}