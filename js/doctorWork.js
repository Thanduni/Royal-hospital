function addTimeDuration() {
    // get the total duration of all time durations
    let totalDuration = getTotalDuration();
    alert(totalDuration);
    // check if the total duration is less than 5 hours
    if (totalDuration < 5) {
        // create a new div element for the time duration
        let newDiv = document.createElement("div");

        // create a new input field for the start time
        let newStartTime = document.createElement("input");
        newStartTime.type = "time";
        newStartTime.name = "start_time";
        newStartTime.step = "1800";
        newStartTime.required = true;
        newDiv.appendChild(newStartTime);

        // create a new input field for the duration
        let newDuration = document.createElement("input");
        newDuration.type = "number";
        newDuration.name = "duration";
        newDuration.min = "1";
        newDuration.max = "5";
        newDuration.step = "0.5";
        newDuration.required = true;
        newDiv.appendChild(newDuration);

        // add the new div element to the time-durations div
        let timeDurationsDiv = document.getElementById("time-durations");
        timeDurationsDiv.appendChild(newDiv);
    }
    else if(totalDuration > 5){
        let inputs = document.getElementsByName("duration");

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
        lastNode.value = 5 - (totalDuration - lastNode.value);
    }

}