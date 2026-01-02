var hackerCompanyName = "CyberTech ";
var hackerCompanyLocation = "nuzvidu";
var hackerCompanyFoundedYear = 2006;
var hackercomapnyCEO ="isamil";
alert("Welcome to " + hackerCompanyName + " located in " + hackerCompanyLocation);

var userName = prompt("Please enter your name:");
console.log("User Name: " + userName);
alert("Hello " + userName + ", welcome to " + hackerCompanyName + "!");
//manuopliating html  task 4
function displayMessage() {
 document.getElementById("id1").innerText='this is new title'
}
function addtext() {
    document.getElementById("id2").innerHTML += '<p> this is added text</p>';
    document.getElementById("id2").style.color = 'red';
    document.getElementById("id2").style.fontSize = '30px';
    document.getElementById("id2").style.backgroundColor = 'blue';
}
function removetext() {
    document.getElementById("id2").innerHTML = '';
}
function toggleStyle() {
    let element = document.getElementById("box");
    element.classList.toggle("change");
}
function changeStyle() {
    let box = document.getElementById("inline");

    // Dynamically change style
    inline.style.backgroundColor = "yellow";
    inline.style.color = "red";
    inline.style.fontSize = "20px";
    inline.style.padding = "20px";
}
//mouse hover
const box = document.getElementById("hoverBox");

        // Mouseover event
        box.addEventListener("mouseover", function() {
            box.style.backgroundColor = "orange";
            box.style.color = "white";
            
            console.log("Mouse is over the box!");
        });

        // Mouseout event
        box.addEventListener("mouseout", function() {
            box.style.backgroundColor = "lightblue";
            box.style.color = "black";
            
            console.log("Mouse left the box!");
        });// Get the form element
const form = document.getElementById("contactForm");


form.addEventListener("submit", function(event) {
    event.preventDefault(); 
    const name = document.getElementById("nameField").value;
    const email = document.getElementById("emailField").value;

    console.log("Form submitted!");
    console.log("Name:", name, "Email:", email);

    alert("Thank you! Your form has been submitted.");
});
//print function
function print1(){
    window.print();
    console.log("Print dialog opened!");
}

