

const choices = ["Rock", "Paper", "Scissor"];
const playerDisplay = document.getElementById("playerDisplay");
const computerDisplay = document.getElementById("computerDisplay");
const resultDisplay = document.getElementById("resultDisplay");

function playGame(playerChoice){

    const computerChoice = choices[Math.floor(Math.random() * 3)];

    let result="";

    if(playerChoice === computerChoice){
        result = "IT'S A TIE!";
    } 
    else{
        switch(playerChoice){
            case "Rock":
                result = (computerChoice === "Scissor") ? "YOU WIN!" : "YOU LOSE!";
                break;
            case "Paper":
                result = (computerChoice === "Rock") ? "YOU WIN!" : "YOU LOSE!";
                break;
            case "Scissor":
                result = (computerChoice === "Paper") ? "YOU WIN!" : "YOU LOSE!";
                break;   
        }
    }

    playerDisplay.textContent = `PLAYER: ${playerChoice}`;
    computerDisplay.textContent = `COMPUTER: ${computerChoice}`;
    resultDisplay.textContent = result;
}