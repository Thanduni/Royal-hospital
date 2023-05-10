let testNames = ['skin allergy test','skin biopsy','hearing test','laryngoscopy','capsule endoscopy','coloscopy','endoscopic retrograde cholangiopancreatography','esophagogastroduodenoscopy','esophageal motility study','esophageal pH monitoring','liver biopsy','bone marrow examination','Arterial blood gas (ABG)','Complete blood count (CBC)',
'Comprehensive metabolic panel (CMP) (including CHEM-7)','coagulation tests','C-reactive protein','Erythrocyte sedimentation rate (ESR)','FibroTest','urea breath test','amniocentesis','colposcopy','mammography','hysteroscopy','laparoscopy','Smear tests ','CT scan (B*2****)','magnetic resonance imaging (MRI) (B*3****)','nuclear medicine (C******)','positron-emission tomography (PET)','projectional radiography (B*0****)','ultrasonography (B*4****)','cystoscopy','urodynamic testing',]

console.log( testNames);

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
      testNames.forEach((testName) => {
        if (testName.substr(0, value.length).toLowerCase() === value) {
          filteredNames.push(testName);
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
  