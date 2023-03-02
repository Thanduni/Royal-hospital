function displayMedicineUpdateForm(medID) {
    let form = document.getElementById("addForm");

    let tableCon = document.getElementsByClassName(medID + "_tableCon");
    document.getElementById("titleOperation").innerHTML = "Update Medicine | Medicine ID : " + medID;

    let medicineName = tableCon[0].textContent;
    let companyName = tableCon[1].textContent;
    let unitCost = tableCon[2].textContent;
    let unitType = tableCon[3].textContent;
    // alert(unitType);

    let userForm = document.getElementById('userForm');

    let IN_medicineName = document.getElementById("IN_medicineName");
    let IN_companyName = document.getElementById("IN_companyName");
    let IN_unitType = document.getElementById("IN_unitType");
    let IN_unitCost = document.getElementById("IN_unitCost");

    IN_medicineName.value = medicineName;
    IN_companyName.value = companyName;
    IN_unitCost.value = unitCost;

    if(unitType == 'cards')
        IN_unitType.selectedIndex = 1;
    else if(unitType == 'bottles')
        IN_unitType.selectedIndex = 2;
    else if(unitType == 'pills')
        IN_unitType.selectedIndex = 3;
    else if(unitType == 'injections')
        IN_unitType.selectedIndex = 4;
    else if(unitType == 'tablets')
        IN_unitType.selectedIndex = 5;
    form.scrollIntoView();

}