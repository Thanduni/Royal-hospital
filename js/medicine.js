
let medicineNames=['Acetaminophen','Adderall','Amitriptyline','Amlodipine','Amoxicillin','Ativan','Atorvastatin','Azithromycin','Benzonatate',
'Brilinta','Bunavail','Buprenorphine','Cephalexin','Ciprofloxacin','Citalopram','Clindamycin','Clonazepam','Cyclobenzaprine','Cymbalta',
'Doxycycline','Dupixent','Entresto','Entyvio','Farxiga','Fentanyl Patch','Gabapentin','Gilenya','Humira','Hydrochlorothiazide','Hydroxychloroquine','Ibuprofen','Imbruvica','Invokana','Januvia','Jardiance','Kevzara','Lexapro','Lisinopril',
'Lofexidine','Loratadine','Lyrica','Melatonin','Meloxicam','Metformin','Methadone','Methotrexate','Metoprolol','Naloxone','Naltrexone','Naproxen',
'Narcan','Nurtec','Omeprazole','Onpattro','Otezla','Ozempic','Panadol','Parasitamol','Pantoprazole','Plan B','Prednisone','Probuphine',
'Rybelsus','secukinumab','Sublocade','Tramadol','Trazodone','Viagra','Wegovy','Wellbutrin','Xanax','Zubsolv'];

// async function getMedicineData(){
//     const fdaRes = await fetch("https://api.fda.gov/drug/event.json?count=patient.drug.medicinalproduct.exact");
//     const fdaData = await fdaRes.json();

//     medicineNames = fdaData.results.map((medicine)=>{
//         return medicine.term;
//     });
// }



console.log( medicineNames);

  function addAutoCompleteDropdownToInputs() {
    // Get all input elements in the page with class "autoComplete-input"
    const inputElements = document.querySelectorAll(".autoComplete-input");
  
    console.log(inputElements);
    // Loop over each input element
    inputElements.forEach((inputElement) => {
      // Add event listener for input event
      inputElement.addEventListener("input", onInputChange);
    });
  
    function onInputChange(event) {
      // Get the input element that triggered the event
      const inputElement = event.target;
  
      // Remove existing dropdown
      removeAutoCompleteDropdown();
  
      // Get rid of case sensitivity
      const value = inputElement.value.toLowerCase();
  
      if (value.length === 0) {
        return;
      }
      const filteredNames = [];
      // Loop over drug names
      medicineNames.forEach((drugName) => {
        if (drugName.substr(0, value.length).toLowerCase() === value) {
          filteredNames.push(drugName);
        }
      });
      createAutoCompleteDropdown(filteredNames, inputElement);
    }
  
    function createAutoCompleteDropdown(list, inputElement) {
      const listElement = document.createElement("ul");
      listElement.className = "autocomplete-list";
      listElement.id = "autocomplete-list";
  
      list.forEach((item) => {
        const listItem = document.createElement("li");
        const itemButton = document.createElement("button");
        itemButton.innerHTML = item;
        itemButton.addEventListener("click", onItemButtonClick);
        listItem.appendChild(itemButton);
  
        listElement.appendChild(listItem);
      });
  
      inputElement.parentNode.appendChild(listElement);
    }
  
    function removeAutoCompleteDropdown() {
      const listElement = document.querySelector("#autocomplete-list");
      if (listElement) {
        listElement.remove();
      }
    }
  
    function onItemButtonClick(event) {
      event.preventDefault();
      const buttonElement = event.target;
      const inputElement = buttonElement.parentNode.parentNode.parentNode.querySelector(".autoComplete-input");
      inputElement.value = buttonElement.innerHTML;
  
      removeAutoCompleteDropdown();
    }
  }
  
  // Call the function to add the autocomplete dropdown to all input elements with class "autoComplete-input"
  addAutoCompleteDropdownToInputs();
  