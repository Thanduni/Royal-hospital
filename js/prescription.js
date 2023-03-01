function addRow(){
    var root = document.getElementById('prescription-table').getElementsByTagName('tbody')[0];
    var rows = root.getElementsByTagName('tr');
    var clone = cloneEl(rows[rows.length - 1]);
    cleanUpInputs(clone);
    root.appendChild(clone);
}
function cloneEl(el) {
    var clo = el.cloneNode(true);
    return clo;
}
function cleanUpInputs(obj) {
    for (var i = 0; n = obj.childNodes[i]; ++i) {
      if (n.childNodes && n.tagName != 'INPUT') {
        cleanUpInputs(n);
      } else if (n.tagName == 'INPUT' && n.type == 'text') {
        n.value = '';
      }
    }  
  }
function drugPrescription(){
    document.querySelector(".prescribe-medicine-content").style.display = "flex";
    document.querySelector(".prescribe-test-content").style.display = "none";
}
function testPrescription(){
    document.querySelector(".prescribe-medicine-content").style.display = "none";
    document.querySelector(".prescribe-test-content").style.display = "flex";
}
// document.getElementById("medicine-button").addEventListener("click", function(){
//     document.querySelector(".prescribe-medicine-content").style.display = "flex";
//     document.querySelector(".prescribe-test-content").style.display = "none";
// })
// document.getElementById("test-button").addEventListener("click", function(){
//     document.querySelector(".prescribe-medicine-content").style.display = "none";
//     document.querySelector(".prescribe-test-content").style.display = "flex";
// })