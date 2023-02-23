// function generate_year_range(start, end) {
//     var years = "";
//     for (var year = start; year <= end; year++) {
//         years += "<option value='" + year + "'>" + year + "</option>";
//     }
//     return years;
// }

// today = new Date();
// currentMonth = today.getMonth();
// currentYear = today.getFullYear();
// selectYear = document.getElementById("year");
// selectMonth = document.getElementById("month");


// createYear = generate_year_range(1970, 2050);
// /** or
//  * createYear = generate_year_range( 1970, currentYear );
//  */

// document.getElementById("year").innerHTML = createYear;

// var calendar = document.getElementById("calendar");
// var lang = calendar.getAttribute('data-lang');

// var months = "";
// var days = "";

// var monthDefault = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

// var dayDefault = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

// if (lang == "en") {
//     months = monthDefault;
//     days = dayDefault;
// } else if (lang == "id") {
//     months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
//     days = ["Ming", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"];
// } else if (lang == "fr") {
//     months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
//     days = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
// } else {
//     months = monthDefault;
//     days = dayDefault;
// }


// var $dataHead = "<tr>";
// for (dhead in days) {
//     $dataHead += "<th data-days='" + days[dhead] + "'>" + days[dhead] + "</th>";
// }
// $dataHead += "</tr>";

// //alert($dataHead);
// document.getElementById("thead-month").innerHTML = $dataHead;


// monthAndYear = document.getElementById("monthAndYear");
// showCalendar(currentMonth, currentYear);



// function next() {
//     currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
//     currentMonth = (currentMonth + 1) % 12;
//     showCalendar(currentMonth, currentYear);
// }

// function previous() {
//     currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
//     currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
//     showCalendar(currentMonth, currentYear);
// }

// function jump() {
//     currentYear = parseInt(selectYear.value);
//     currentMonth = parseInt(selectMonth.value);
//     showCalendar(currentMonth, currentYear);
// }

// function showCalendar(month, year) {

//     var firstDay = ( new Date( year, month ) ).getDay();

//     tbl = document.getElementById("calendar-body");

    
//     tbl.innerHTML = "";

    
//     monthAndYear.innerHTML = months[month] + " " + year;
//     selectYear.value = year;
//     selectMonth.value = month;

//     // creating all cells
//     var date = 1;
//     for ( var i = 0; i < 6; i++ ) {
        
//         var row = document.createElement("tr");

        
//         for ( var j = 0; j < 7; j++ ) {
//             if ( i === 0 && j < firstDay ) {
//                 cell = document.createElement( "td" );
//                 cellText = document.createTextNode("");
//                 cell.appendChild(cellText);
//                 row.appendChild(cell);
//             } else if (date > daysInMonth(month, year)) {
//                 break;
//             } else {
//                 cell = document.createElement("td");
//                 cell.setAttribute("data-date", date);
//                 cell.setAttribute("data-month", month + 1);
//                 cell.setAttribute("data-year", year);
//                 cell.setAttribute("data-month_name", months[month]);
//                 cell.className = "date-picker";
//                 cell.innerHTML = "<span>" + date + "</span>";

//                 if ( date === today.getDate() && year === today.getFullYear() && month === today.getMonth() ) {
//                     cell.className = "date-picker selected";
//                 }
//                 row.appendChild(cell);
//                 date++;
//             }


//         }

//         tbl.appendChild(row);
//     }

// }

// function daysInMonth(iMonth, iYear) {
//     return 32 - new Date(iYear, iMonth, 32).getDate();
// }


let currentDate = dayjs();
let daysInMonth = dayjs().daysInMonth();
let firstDayPosition = dayjs().startOf("month").day();
let monthNames = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December"
];
let weekNames = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
let dateElement = document.querySelector("#calendar .calendar-dates");
let calendarTitle = document.querySelector(".calendar-title-text");
let nextMonthButton = document.querySelector("#nextMonth");
let prevMonthButton = document.querySelector("#prevMonth");
let dayNamesElement = document.querySelector(".calendar-day-name");
let todayButton = document.querySelector("#today");
let dateItems = null;
let newMonth = null;

weekNames.forEach(function (item) {
  dayNamesElement.innerHTML += `<div>${item}</div>`;
});

function plotDays() {
  let count = 1;
  dateElement.innerHTML = "";

  let prevMonthLastDate = currentDate.subtract(1, "month").endOf("month").$D;
  let prevMonthDateArray = [];

  //plot prev month array
  for (let p = 1; p < firstDayPosition; p++) {
    prevMonthDateArray.push(prevMonthLastDate--);
  }
  prevMonthDateArray.reverse().forEach(function (day) {
    dateElement.innerHTML += `<button class="calendar-dates-day-empty">${day}</button>`;
  });

  //plot current month dates
  for (let i = 0; i < daysInMonth; i++) {
    dateElement.innerHTML += `<button class="calendar-dates-day">${count++}</button>`;
  }

  //next month dates
  let diff =
    42 - Number(document.querySelector(".calendar-dates").children.length);
  let nextMonthDates = 1;
  for (let d = 0; d < diff; d++) {
    document.querySelector(
      ".calendar-dates"
    ).innerHTML += `<button class="calendar-dates-day-empty">${nextMonthDates++}</button>`;
  }

  //month name and year
  calendarTitle.innerHTML = `${
    monthNames[currentDate.month()]
  } - ${currentDate.year()}`;
}

//highlight current date
function highlightCurrentDate() {
  dateItems = document.querySelectorAll(".calendar-dates-day");
  if (dateElement && dateItems[currentDate.$D - 1]) {
    dateItems[currentDate.$D - 1].classList.add("today-date");
  }
}

//next month button event
nextMonthButton.addEventListener("click", function () {
  newMonth = currentDate.add(1, "month").startOf("month");
  setSelectedMonth();
});

//prev month button event
prevMonthButton.addEventListener("click", function () {
  newMonth = currentDate.subtract(1, "month").startOf("month");
  setSelectedMonth();
});

//today button event
todayButton.addEventListener("click", function () {
  newMonth = dayjs();
  setSelectedMonth();
  setTimeout(function () {
    highlightCurrentDate();
  }, 50);
});

//set next and prev month
function setSelectedMonth() {
  daysInMonth = newMonth.daysInMonth();
  firstDayPosition = newMonth.startOf("month").day();
  currentDate = newMonth;
  plotDays();
}

//init
plotDays();
setTimeout(function () {
  highlightCurrentDate();
}, 50);
