var interval;//Timer variable

//Question class
class Question {
  constructor() {
    this.statement="";
    this.options=[];
    this.answer=-1;
    this.course="";
    this.marks="";
    this.difficulty="";
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
//Generates an option field
function genOption(c){
    let opt=document.createElement("div");
    let opt_prefix=document.createElement("div");
    let opt_suffix=document.createElement("div");
    let inp=document.createElement("input");
    opt.classList.add("option_container");
    opt_prefix.classList.add("option_prefix");
    opt_suffix.classList.add("option_suffix");
    opt_suffix.appendChild(inp);
    opt.appendChild(opt_prefix);
    opt.appendChild(opt_suffix);
    inp.setAttribute("required","");
    opt_prefix.innerHTML=c;
    opt.setAttribute("correct","0");
    opt_prefix.setAttribute("onclick","markCorrect(this)");
    return opt;
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

//get an option of <select>
function addOption(val, txt){
    let opt = document.createElement("option");
    opt.value = val;
    //opt.text = txt;
    opt.appendChild( document.createTextNode(txt) );
    
    return opt;
}

//<select> for course list
function courseList(){
    let sel = document.createElement("select");
    sel.add(addOption("Structured Programming Language", "Structured Programming Language"));
    sel.add(addOption("Discrete Math", "Discrete Math"));
    sel.add(addOption("Data Structures", "Data Structures"));
    sel.add(addOption("Algorithm Design & Analysis", "Algorithm Design & Analysis"));
    sel.add(addOption("Object Oriented Programming", "Object Oriented Programming"));
    sel.add(addOption("Numerical Analysis", "Numerical Analysis"));
    sel.add(addOption("Theory of Computation", "Theory of Computation"));
    sel.add(addOption("Ethics & Cyber Law", "Ethics & Cyber Law"));
    sel.add(addOption("Digital Signal Processing", "Digital Signal Processing"));
    sel.add(addOption("Database System", "Database System"));
    sel.add(addOption("Operating System", "Operating System"));
    sel.add(addOption("Computer Networking", "Computer Networking"));
    sel.add(addOption("Computer Graphics", "Computer Graphics"));
    sel.add(addOption("Computer Architecture", "Computer Architecture"));
    sel.add(addOption("Artificial Intelligence", "Artificial Intelligence"));
    sel.add(addOption("Machine Learning", "Machine Learning"));
    sel.add(addOption("Others", "Others"));
    
    return sel;
}

//Creates a question
function getQuestion(){
    
    
    let qstn_container=document.createElement("div");
    let qstn=document.createElement("div");
    let inp=document.createElement("input");
    let cPanel=document.createElement("div");
    let addOpt=document.createElement("img");
    let undo=document.createElement("img");
    qstn_container.classList.add("question_container");
    qstn.classList.add("question");
    inp.setAttribute("placeholder","Is there any question?");
    inp.setAttribute("required","");
    cPanel.classList.add("option_control_panel");
    addOpt.setAttribute("src","images/add_option.svg");
    undo.setAttribute("src","images/undo2.svg");
    qstn.appendChild(inp);
    cPanel.appendChild(addOpt);
    cPanel.appendChild(undo);
    
    let course=document.createElement("div");
    let lvl_course=document.createElement("label");
    let p=document.createElement("p");
    p.innerHTML="<br>";
    lvl_course.innerHTML="Course: ";
    let sel = courseList();
    course.appendChild(lvl_course);
    course.appendChild(sel);
    course.appendChild(p);
    
    let marks=document.createElement("div");
    let lvl_marks=document.createElement("label");
    let inp_marks=document.createElement("input");
    let p2=document.createElement("p");
    p2.innerHTML="<br>";
    lvl_marks.innerHTML="Marks: ";
    inp_marks.setAttribute("required","");
    inp_marks.setAttribute("type", "number");
    inp_marks.setAttribute("min", "1");
    inp_marks.setAttribute("max", "10");
    inp_marks.setAttribute("value", "1");
    marks.appendChild(lvl_marks);
    marks.appendChild(inp_marks);
    marks.appendChild(p2);
    
    let difficulty=document.createElement("div");
    let lvl_difficulty=document.createElement("label");
    lvl_difficulty.innerHTML="Difficulty: ";
    let sel2 = document.createElement("select");
    sel2.add(addOption("easy", "Easy"));
    sel2.add(addOption("medium", "Medium"));
    sel2.add(addOption("hard", "Hard"));

    difficulty.appendChild(lvl_difficulty);
    difficulty.appendChild(sel2);
    
    qstn_container.appendChild(qstn);
    qstn_container.appendChild(cPanel);
    qstn_container.appendChild(course);
    qstn_container.appendChild(marks);
    qstn_container.appendChild(difficulty);
    
    let c='A';
    qstn_container.insertBefore(genOption(c),cPanel);
    markCorrect(qstn_container.querySelector(".option_prefix"));
	c=String.fromCharCode(c.charCodeAt(0)+1);
    qstn_container.insertBefore(genOption(c),cPanel);
    let root=document.getElementById("questions_container");
    root.appendChild(qstn_container);
    addOpt.addEventListener("click", function(){
        c=String.fromCharCode(c.charCodeAt(0)+1);
    qstn_container.insertBefore(genOption(c),cPanel);
    });
    
    undo.addEventListener("click", function(){
        if(c!='B'){
            c=String.fromCharCode(c.charCodeAt(0)-1);
            let chlds = qstn_container.querySelectorAll(".option_container");
            if(chlds[chlds.length-1].getAttribute("correct")=="1") markCorrect(chlds[0].querySelector(".option_prefix"));
            qstn_container.removeChild(chlds[chlds.length-1]);
        }
        
    });
}


//Uploads exam to the server
function examToServer(exam){
	let req=new XMLHttpRequest();
    let url="extra/upload_exam.php";
	req.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText+"wtf");
			if(this.responseText=="true"){
				window.location.href = "exam.php";
			}
	  	}
	};
	req.open("POST", url, false);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send("jsonExam="+JSON.stringify(exam));
}

//Uploads the submission to the server
function answerToServer(exam){
    let req=new XMLHttpRequest();
    let url="extra/submit_answer.php";
	req.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
            if(this.responseText!="true"){
			     alert(this.responseText);
			}
            window.location.href = "results.php?examid="+exam.examid;
	  	}
	};
	req.open("POST", url, false);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send("jsonExam="+JSON.stringify(exam));
}

//Exam gets submitted
function submit(){
    let inputs=document.querySelectorAll("input"); 
    console.log(inputs[1].value);
    for(let i=0;i<inputs.length;i++){
        if(inputs[i].value.length==0){
            inputs[i].reportValidity();
            return ;
        }
    }
    let questions=document.querySelectorAll(".question_container");
    let exam=new Exam();
    let name=document.querySelector("#exam_name input");
    exam.startTime=inputs[1].value;
    exam.endTime=inputs[2].value;
    exam.name=name.value;
    let idx=3;
    for(let i=0;i<questions.length;i++){
        let statement=questions[i].querySelector(".question input");
        idx++;
        let question=new Question();
        question.statement=statement.value;
        let options=questions[i].querySelectorAll(".option_container");
        for(let j=0;j<options.length;j++){
            let option=new Option();
            let opt=options[j].querySelector("input");
            idx++;
            if(options[j].getAttribute("correct")=="1") question.answer=j;
            option.value=opt.value;
            question.options.push(option);
        }
        question.marks=inputs[idx].value;
        idx++;
        let selects=document.querySelectorAll("select");
        question.course=selects[0].value;
        question.difficulty=selects[0].value;
        exam.questions.push(question);
    }
    
    alert(exam.questions.length);
    examToServer(exam);
    
}
//Submits the answer
function answerSubmit(){
    let questions=document.querySelectorAll(".question_container");
    let exam=new Exam();
    for(let i=0;i<questions.length;i++){
        let statement=questions[i].querySelector(".question input");
        let question=new Question();
        let options=questions[i].querySelectorAll(".option_container");
        for(let j=0;j<options.length;j++){
            let option=new Option();
            if(options[j].getAttribute("correct")=="1") question.answer=j;
            question.options.push(option);
        }
        exam.questions.push(question);
    }
    let exm=document.querySelector("#exam_name");
    exam.examid=exm.getAttribute("examid");
    answerToServer(exam);
}
//Initiates the countdown timer for exam
function startCount(tme){
    setInterval(function() {countDown(tme); },1000);
}

//Fuctions of countdown timer
const countDown = tme => {
    let t = tme.split(/[- :]/);
    let d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
    let now = new Date().getTime();
    now+=6*60*60;
    let distance=d-now;
    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("countDown").innerHTML = days + "d " + hours + "h "+ minutes + "m " + seconds + "s ";
    if(distance<=0){
        clearInterval(interval);
        location.reload();
    }
}
