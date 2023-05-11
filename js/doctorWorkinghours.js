// Initialize an array to store the time slots
let timeSlots = [];
let dayOfWeek = '';
// Initialize variables to track the total duration and the last end time
let totalDuration = 0;
let count = 0;
let lastEndTime = null;

// Function to calculate the duration of a time slot
function calculateDuration(start, end) {
    const diff = new Date(`1970-01-01T${end}:00`).getTime() - new Date(`1970-01-01T${start}:00`).getTime();
    let e = new Date(`1970-01-01T${end}:00`).getTime() / (1000*60*60);
    let s = new Date(`1970-01-01T${start}:00`).getTime() / (1000*60*60);
    return (e - s);
}

function convertToMinutes(timeString) {
    // Split the time string into hours and minutes
    const [hours, minutes] = timeString.split(":");

    // Convert the hours and minutes to numbers
    const hoursNum = parseInt(hours, 10);
    const minutesNum = parseInt(minutes, 10);

    if(minutesNum % 15 !== 0){
        alert("The Time should be multiple of 15 minutes.")
        return false;
    }

    // Calculate the total number of minutes
    const totalMinutes = hoursNum * 60 + minutesNum;

    return totalMinutes;
}

// Function to check if a new time slot overlaps with existing time slots
function checkOverlap(start, end) {
    // console.log(timeSlots.length);
    for (let i = 0; i < timeSlots.length; i++) {
        const existingStart = convertToMinutes(timeSlots[i].start);
        const existingEnd = convertToMinutes(timeSlots[i].end);
        // console.log(convertToMinutes(start) + " <==> " + existingStart);
        if ((convertToMinutes(start) >= existingStart && convertToMinutes(start) <= existingEnd) ||
                (convertToMinutes(end) >= existingStart && convertToMinutes(end) <= existingEnd)) {
            return true;
        }
    }
    return false;
}

// Function to add a new time slot
function addTimeSlot() {
    // Calculate the duration of the time slot
    // count++;

    let newDiv = document.createElement("div");
    let startInput = document.getElementsByClassName("start-time");
    let endInput = document.getElementsByClassName("end-time");

    let start = startInput[startInput.length - 1].value;
    let end = endInput[endInput.length - 1].value;

    if(!convertToMinutes(start) || !convertToMinutes(end))
        return;

    if(new Date(`1970-01-01T${end}:00`).getTime() - new Date(`1970-01-01T${start}:00`).getTime() < 0)
    {
        alert('The start time should be less than end time.');
        return;
    }

    const duration = calculateDuration(start, end);

    // If the duration is greater than 5, display an error message and return
    if (totalDuration + duration > 5) {
        alert('The total duration cannot exceed 5 hours');
        return;
    }

    // If the time slot overlaps with an existing time slot, display an error message and return
    if (checkOverlap(start, end)) {
        alert('The time slots cannot overlap');
        return;
    }

    // Add the time slot to the array and update the total duration and last end time
    timeSlots.push({start, end});
    totalDuration += duration;
    // lastEndTime = end;

    // Create new input fields for the start time and end time
    const startTimeInput = document.createElement('input');
    const endTimeInput = document.createElement('input');
    startTimeInput.type = 'time';
    endTimeInput.type = 'time';
    startTimeInput.required = true;
    endTimeInput.required = true;
    startTimeInput.name = 'start-time[]';
    endTimeInput.name = 'end-time[]';
    startTimeInput.classList.add("start-time");
    endTimeInput.classList.add("end-time");

    newDiv.appendChild(startTimeInput);
    newDiv.appendChild(endTimeInput);
    newDiv.classList.add("newSlots");

    startInput[startInput.length - 1].disabled = true;
    endInput[endInput.length - 1].disabled = true;

    let timeDurationsDiv = document.getElementById("time-durations");
    timeDurationsDiv.appendChild(newDiv);
}

function checkValidation(){
    let startInput = document.getElementsByClassName("start-time");
    let endInput = document.getElementsByClassName("end-time");

    let start = startInput[startInput.length - 1].value;
    let end = endInput[endInput.length - 1].value;

    if(!convertToMinutes(start) || !convertToMinutes(end))
        return false;

    if(new Date(`1970-01-01T${end}:00`).getTime() - new Date(`1970-01-01T${start}:00`).getTime() < 0)
    {
        alert('The start time should be less than end time.');
        return false;
    }

    const duration = calculateDuration(start, end);

    // If the duration is greater than 5, display an error message and return
    if (totalDuration + duration > 5) {
        alert('The total duration cannot exceed 5 hours');
        return false;
    }

    // If the time slot overlaps with an existing time slot, display an error message and return
    if (checkOverlap(start, end)) {
        alert('The time slots cannot overlap');
        return false;
    }

    let startArray = [];
    let endArray = [];
    for(let i=0; i<startInput.length; i++){
        startArray.push(startInput[i].value);
        endArray.push(endInput[i].value);
    }

    console.log(dayOfWeek);
    $.ajax({
        url: '../doctor/fixSchedule.php',
        type: 'POST',
        data: {start: startArray, end: endArray, day: dayOfWeek},
        dataType: 'json',
        success: function(response) {
// update the department select element with the departments returned by the PHP file
            console.log("Status = " + response.status);
            location.replace('http://localhost:8080/ROYALHOSPITAL/Doctor/updateWorkingHours.php');
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + xhr.responseText);
        }
    });
    return true;
}

// Add an event listener to the submit button or form
// When the user submits the form, call the addTimeSlot function with the start and end times from the input fields
// You can use your preferred method to retrieve the values from the input fields, such as by ID or name

let addSlotBtn = document.getElementById("add-time-slot-btn");

addSlotBtn.addEventListener('click', addTimeSlot, false)

let form = document.getElementById("time-slot-form");

function edit(day){
    // e.preventDefault();
    dayOfWeek = day;
    document.getElementById("titleWeek").textContent = day;
    // form.action = '/royalhospital/doctorWork/fixSchedule.php?day=' + day;
}

form.addEventListener('submit', edit, false)



