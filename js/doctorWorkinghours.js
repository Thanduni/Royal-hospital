function addTimeDuration(id) {
    // get the total duration of all time durations
    let totalDuration = getTotalDuration();

    // check if the total duration is less than 5 hours
    if (totalDuration < 5) {
        // create a new div element for the time duration

        // create a new input field for the start time
        let newStartTime = document.createElement("input");
        newStartTime.type = "time";
        newStartTime.name = "start_time";
        newStartTime.step = "1800";
        newStartTime.required = true;

        // create a new input field for the duration
        let newDuration = document.createElement("input");
        newDuration.type = "number";
        newDuration.name = "duration_" + id;
        newDuration.min = "1";
        newDuration.max = "5";
        newDuration.step = "0.5";
        newDuration.required = true;

        // add the new div element to the time-durations div

        let time = document.getElementById(id + "_time");
        let dur = document.getElementById(id + "_dur");

        time.appendChild(newStartTime);
        dur.appendChild(newDuration);
    }
    else if(totalDuration > 5){
        let inputs = document.getElementsByName("duration_" + id);

        let lastNode = inputs[inputs.length - 1];
        alert(lastNode);
        lastNode.value = 5 - (totalDuration - lastNode.value);
    }
}

function getTotalDuration() {
    // get the durations of all time durations
    let durations = document.getElementsByName("duration");

    // sum the durations
    let totalDuration = 0;
    for (let i = 0; i < durations.length; i++) {
        totalDuration += parseFloat(durations[i].value);
    }

    return totalDuration;
}

function checkTotHrs(){
    let totalDuration = getTotalDuration();

    if(totalDuration > 5){
        let inputs = document.getElementsByName("duration");

        let lastNode = inputs[inputs.length - 1];
        alert(lastNode);
        lastNode.value = 5 - (totalDuration - lastNode.value);
    }

}

function editMonday(){

}

function editTuesday(){

}

function editWednesday(){

}

function editThursday(){

}

function editFriday(){

}

function editSaturday(){

}

function editSunday(){

}