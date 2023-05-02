function displayMedicineUpdateForm(medID) {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Storekeeper/updateMedicine.php?id=' + medID;

    let tableCon = document.getElementsByClassName(medID + "_tableCon");
    document.getElementById("titleOperation").innerHTML = "Update Medicine | Medicine ID : " + medID;

    let medicineName = tableCon[0].textContent;
    let companyName = tableCon[1].textContent;
    let unitCost = tableCon[2].textContent;
    let unitQuantity = tableCon[3].textContent;
    // alert(unitType);

    let userForm = document.getElementById('userForm');

    let IN_medicineName = document.getElementById("IN_medicineName");
    let IN_companyName = document.getElementById("IN_companyName");
    let IN_unitQuantity = document.getElementById("IN_unitQuantity");
    let IN_unitCost = document.getElementById("IN_unitCost");

    IN_medicineName.value = medicineName;
    IN_companyName.value = companyName;
    IN_unitCost.value = unitCost;
    IN_unitQuantity.value = unitQuantity;

    form.scrollIntoView();
}

function displayStockForm(itemName){
    let medicineList = document.getElementsByTagName('option');
    let selectMedicine = document.getElementsByName('item_name')[0];

    for(let i=0; i<medicineList.length; i++){
        if(itemName === medicineList[i].value){
            selectMedicine.selectedIndex = i;
            break;
        }
    }
}