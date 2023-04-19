let appointmentInfo='',
dateParts = '',
year = '',
month = '',
day = '',
dateObject = [],
allClasses = [];
let card = '';
let appointmentCard = document.getElementById("appointmentCard");
const months = ["January", "February", "March", "April", "May", "June", "July",
  "August", "September", "October", "November", "December"];
const Weeks = [ "Sunday","Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

$.ajax({
  type: "GET",
  url: "../Doctor/getAppointmentDetails.php",
  success: function(response) {
    appointmentInfo = $.parseJSON(response);
    appointmentInfo.forEach(function (item){
       dateParts = item.date.split("-");

       year = parseInt(dateParts[0]);
       month = parseInt(dateParts[1]);
       day = parseInt(dateParts[2]);
      dateObject.push({year, 'month': month - 1, day});
      // yearArr.push(year);
      // monthArr.push(month);
      // dateArr.push(date);
    });

    const daysTag = document.querySelector(".days"),
        currentDate = document.querySelector(".current-date"),
        prevNextIcon = document.querySelectorAll(".iconslr span");

// getting new date, current year and month
    let date = new Date(),
        currYear = date.getFullYear(),
        currMonth = date.getMonth();

// storing full name of all months in array

    let renderCalendar = () => {
      let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
          lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
          lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
          lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
      let liTag = "";

      for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
        liTag += `<li class="inactive clickdate" data-today = ${lastDateofLastMonth - i + 1}>${lastDateofLastMonth - i + 1}</li>`;
      }
      for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
        // adding active class to li if the current day, month, and year matched
        let isToday = '';
        for (let j = 0; j < dateObject.length; j++){
          isToday = i === dateObject[j].day && currMonth === dateObject[j].month
          && currYear === dateObject[j].year ? "activeactive" : "";
          if(isToday === "activeactive"){
            // console.log(i + " " + currMonth + " " + currYear);
            break;
          }
        }
        liTag += `<li class="${isToday}" data-today = ${i}>${i}</li>`;
      }

      for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
        liTag += `<li class="inactive" data-today = ${i - lastDayofMonth + 1}>${i - lastDayofMonth + 1}</li>`
      }
      currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
      daysTag.innerHTML = liTag;

      let activeDates = document.getElementsByClassName("activeactive");
      for (let i = 0; i < activeDates.length; i++) {
        activeDates[i].addEventListener("click", () => {
          appointmentCard.innerHTML = '';
          if (!activeDates[i]) {
            return;
          }

          for (let j = 0; j < dateObject.length; j++){
            if(currYear === dateObject[j].year &&
                currMonth === dateObject[j].month &&
                parseInt(activeDates[i].textContent) === dateObject[j].day){
                dateParts = appointmentInfo[j].date.split("-");

                year = parseInt(dateParts[0]);
                month = parseInt(dateParts[1]);
                day = parseInt(dateParts[2]);

                if(year === dateObject[j].year &&
                    month-1 === dateObject[j].month &&
                    day === dateObject[j].day){

                  card = "<div class=\"card-Appointment\">\n" +
                      "                                <i class=\"fa-solid fa-circle-xmark fa-2xl\" id='close' onclick=\"closeAppointmentCards()\"></i>" +
                      "                        <table>\n" +
                      "                            <tr>\n" +
                      "                                <td>Patient Name:</td>\n" +
                      "                                <td>" + appointmentInfo[j].name + "</td>\n" +
                      "                            </tr>\n" +
                      "                            <tr>\n" +
                      "                                <td>Date:</td>\n" +
                      "                                <td>" + appointmentInfo[j].date + "</td>\n" +
                      "                            </tr>\n" +
                      "                            <tr>\n" +
                      "                                <td>Time:</td>\n" +
                      "                                <td>" + appointmentInfo[j].time + "</td>\n" +
                      "                            </tr>\n" +
                      "                        </table>\n" +
                      "                    </div>";

                  appointmentCard.innerHTML+=card;

                }
            }
          }
        });
      }

    }

    renderCalendar();



    prevNextIcon.forEach(icon => { // getting prev and next icons
      icon.addEventListener("click", () => { // adding click event on both icons
        // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if(currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
          // creating a new date of current year & month and pass it as date value
          date = new Date(currYear, currMonth, new Date().getDate());
          currYear = date.getFullYear(); // updating current year with new date year
          currMonth = date.getMonth(); // updating current month with new date month
        } else {
          date = new Date(); // pass the current date as date value
        }
        renderCalendar(); // calling renderCalendar function
      });
    });

  },
  error: function(xhr, status, error) {
    console.log("Error: " + error);
  }
});

function closeAppointmentCards(){
  let cardListParent = document.getElementById("appointmentCard");
  let cardlist = document.getElementsByClassName("card-Appointment");

  for(let i=0; i<cardlist.length; i++){
    cardListParent.removeChild(cardlist[i]);
  }
}