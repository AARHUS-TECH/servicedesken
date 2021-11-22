function filterText()
{  
    var rex = new RegExp($('#filterText').val());
    if(rex =="/all/"){clearFilter()}else{
        $('.content').hide();
        $('.content').filter(function() {
        return rex.test($(this).text());
        }).show();
}
}

function clearFilter()
{
    $('.filterText').val('');
    $('.content').show();
}

$(document).ready(function() 
{ 
    $("#elevTable").tablesorter(); 
} 
); 

console.log('Heyo');