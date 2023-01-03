$(document).ready(function(){
    $("#department").change(function(){
        var val = $(this).val();
        if(val == "Anesthetics")
        {
            $("#doctor").html("<option value='Dr.Thaduni'>Dr.Thaduni</option><option value='Dr.Kalana'>Dr.Kalana</option>");
        }
        else if(val == "Cardiology")
        {
            $("#doctor").html("<option value='De.Nareash'>Dr.Nareash</option><option value='Dr.Dhathchaya'>Dr.Dhathchaya</option>");
        }
        else if(val == "Gastroentology"){
            $("#doctor").html("<option value='Dr.Anjana'>Dr.Anjana</option><option value='Dr.Saduni'>Dr.Saduni</option>");
        }
        else{
            $("#doctor").html("<option value=''>Select A Department First</option>");
        }
    });
});