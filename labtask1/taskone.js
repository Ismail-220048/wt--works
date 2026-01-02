// task 1  declaring variables of hacker company
var hackerCompanyName = "CyberTech ";
var hackerCompanyLocation = "nuzvidu";
var hackerCompanyFoundedYear = 2006;
var hackercomapnyCEO ="isamil";
console.log("Hacker Company Name: " + hackerCompanyName);
console.log("Location: " + hackerCompanyLocation);
console.log("Founded Year: " + hackerCompanyFoundedYear);
console.log("CEO: " + hackercomapnyCEO);
// task 2 craeting basic function to display company info
function displayCompanyinfo() {
    console.log("Welcome to " + hackerCompanyName );
    console.log("Located in: " + hackerCompanyLocation);
    console.log("Founded in: " + hackerCompanyFoundedYear);
    console.log("CEO: " + hackercomapnyCEO);
}
displayCompanyinfo();

const updateCEO =(newCEO) =>  {
    hackercomapnyCEO = newCEO;
    console.log("Updated CEO: " + hackercomapnyCEO);    

}
updateCEO('siddarth nandan sahoo');
//mathmatical oprations
function addition(a,b){
    return a + b;
}
var sum= addition(5,10);
console.log("Sum: " + sum);
  function subtraction(a,b){
    return a - b;
}
var difference= subtraction(10,5);
console.log("Difference: " + difference);



//task 3 use build in functions  alert() and prompt()
alert("Welcome to " + hackerCompanyName + " located in " + hackerCompanyLocation);

var userName = prompt("Please enter your name:");
console.log("User Name: " + userName);
alert("Hello " + userName + ", welcome to " + hackerCompanyName + "!");
//degub console log);

