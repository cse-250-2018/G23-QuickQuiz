//Question class
class Question {
  constructor() {
    this.statement="";
    this.options=[];
    this.answer=-1;
    this.course="";
    this.marks="";
    this.difficulty="";
    this.id=-1;
  }
}
//Option class
class Option {
  constructor() {
    this.value="";
  }
}
//Exam class
class Exam {
  constructor() {
    this.startTime="";
    this.endTime="";
    this.name="";
    this.questions=[];
  }
}


//Mark option as correct answer
function markCorrect(optPrefix){
    let opt=optPrefix.parentElement;
    let qst=opt.parentElement;
    let options=qst.querySelectorAll(".option_container");
    for(let i=0;i<options.length;i++){
        if(options[i].isSameNode(opt)) options[i].setAttribute("correct","1"),options[i].classList.add("correct_option");
        else options[i].setAttribute("correct","0"),options[i].classList.remove("correct_option");
    }
    
}


//Uploads the submission to the server
function answerToServer(exam){
    
    let req=new XMLHttpRequest();
    let url="extra/submit_randomQuiz.php";
	req.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
            if(this.responseText!="true"){
			     //alert(this.responseText);
			}
            window.location.href = "quizSummary.php";
	  	}
	};
	req.open("POST", url, false);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send("jsonExam="+JSON.stringify(exam));
}

//Submits the answer
function answerSubmit(){
    let questions=document.querySelectorAll(".question_container");
    let exam=new Exam();
    for(let i=0;i<questions.length;i++){
        let question=new Question();
        let options=questions[i].querySelectorAll(".option_container");
        question.id=(questions[i].querySelector(".question")).getAttribute("id");
        //alert(question.id);
        for(let j=0;j<options.length;j++){
            let option=new Option();
            if(options[j].getAttribute("correct")=="1") question.answer=j;
            question.options.push(option);
        }
        exam.questions.push(question);
    }
    answerToServer(exam);
}
