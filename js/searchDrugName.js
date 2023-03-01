var names =["Thanduni","Chathundi","Thisarani","Aluthwala","Ama","Sevmi","Hansi"];

//sorted names in ascending order
let sortedNames = names.sort();
console.log(sortedNames);
//reference
let input = document.getElementById("input");

//execute function on keyup
input.addEventListener("keyup",(e)=>{
    //initially remove all elements , So that if the user erasesa letter or add new letter then clean previous outputs
    removeElements();
    for(let i of sortedNames){
        //convert to lowercase
        
        if(i.toLocaleLowerCase().startsWith(input.value.toLowerCase()) && input.value != ""){
            //create li element
            let listitem = document.createElement("li");
            //one common class name
            listitem.classList.add("list-items");
            listitem.style.cursor = "pointer";
            listitem.setAttribute("onclick","displayNames('" + i + "')");

            //display matched parts in bold
            let word = "<b>" +i.substring(0,input.value.length)+"</b>";

            word += i.substring(input.value.length);
            //display value in array
            listitem.innerHTML = word;
            document.querySelector(".list").appendChild(listitem);
        }
    }
})

function displayNames(value){
    input.value = value;
    removeElements();
}
function removeElements(){
    //clear all the items
    let item = document.querySelectorAll(".list-items");
    item.forEach((item)=>{
        item.remove();
    });
}
// var DrugNames = ["Panadol","Anastrozol","AndroGel","Annovera","Erleada"];


// function autocomplete(input_text, arr){
//     var currentFocus;

//     input_text.addEventListner("input",function(e){
//         var a,b,i,val=this.value;
//         closeAllLists();

//         if(!val){
//             return false;
//         }
//         currentFocus =-1;

//         a = document.createElement("DIV");
//         a.setAttribute("id", this.id + "autocomplete-list");
//         a.setAttribute("class","autocomplete-items");

//         this.parentNode.appendChild(a);

//         for (i = 0; i < arr.length; i++) {
//             /*check if the item starts with the same letters as the text field value:*/
//             if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
//               /*create a DIV element for each matching element:*/
//               b = document.createElement("DIV");
//               /*make the matching letters bold:*/
//               b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
//               b.innerHTML += arr[i].substr(val.length);
//               /*insert a input field that will hold the current array item's value:*/
//               b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
//               /*execute a function when someone clicks on the item value (DIV element):*/
//                   b.addEventListener("click", function(e) {
//                   /*insert the value for the autocomplete text field:*/
//                   input_text.value = this.getElementsByTagName("input")[0].value;
//                   /*close the list of autocompleted values,
//                   (or any other open lists of autocompleted values:*/
//                   closeAllLists();
//               });
//               a.appendChild(b);
//             }
//           }
//       });
//       /*execute a function presses a key on the keyboard:*/
//       input_text.addEventListener("keydown", function(e) {
//           var x = document.getElementById(this.id + "autocomplete-list");
//           if (x) x = x.getElementsByTagName("div");
//           if (e.keyCode == 40) {
//             /*If the arrow DOWN key is pressed,
//             increase the currentFocus variable:*/
//             currentFocus++;
//             /*and and make the current item more visible:*/
//             addActive(x);
//           } else if (e.keyCode == 38) { //up
//             /*If the arrow UP key is pressed,
//             decrease the currentFocus variable:*/
//             currentFocus--;
//             /*and and make the current item more visible:*/
//             addActive(x);
//           } else if (e.keyCode == 13) {
//             /*If the ENTER key is pressed, prevent the form from being submitted,*/
//             e.preventDefault();
//             if (currentFocus > -1) {
//               /*and simulate a click on the "active" item:*/
//               if (x) x[currentFocus].click();
//             }
//           }
//       });
//       function addActive(x) {
//         /*a function to classify an item as "active":*/
//         if (!x) return false;
//         /*start by removing the "active" class on all items:*/
//         removeActive(x);
//         if (currentFocus >= x.length) currentFocus = 0;
//         if (currentFocus < 0) currentFocus = (x.length - 1);
//         /*add class "autocomplete-active":*/
//         x[currentFocus].classList.add("autocomplete-active");
//       }
//       function removeActive(x) {
//         /*a function to remove the "active" class from all autocomplete items:*/
//         for (var i = 0; i < x.length; i++) {
//           x[i].classList.remove("autocomplete-active");
//         }
//       }
//       function closeAllLists(elmnt) {
//         /*close all autocomplete lists in the document,
//         except the one passed as an argument:*/
//         var x = document.getElementsByClassName("autocomplete-items");
//         for (var i = 0; i < x.length; i++) {
//           if (elmnt != x[i] && elmnt != input_text) {
//           x[i].parentNode.removeChild(x[i]);
//         }
//       }
//     }
//     /*execute a function when someone clicks in the document:*/
//     document.addEventListener("click", function (e) {
//         closeAllLists(e.target);
//     });
// }
