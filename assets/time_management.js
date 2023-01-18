function setComplete() {
    const dateField = document.querySelector('#time_management_completed_date');
    const timeField = document.querySelector('#time_management_completed_time');

    let date = new Date();
    dateField.value = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0);
    timeField.value = date.getHours().toString().padStart(2, '0') + ':' + date.getMinutes().toString().padStart(2, '0');
    return false;
}

const completeBtn = document.querySelector('#tm_complete');
if(completeBtn){
    completeBtn.addEventListener('click', setComplete);    
}

function resetTableFilters(){
  const rows = document.getElementById('time-table').getElementsByTagName('tr');
  for(var i=0; i<rows.length;i++){
    rows[i].style.display="";
  }
}

const resetTableBtn = document.querySelector('#reset-table');
if(resetTableBtn){
    resetTableBtn.addEventListener('click', resetTableFilters);    
}

function filterTable(event) {
  // Declare variables
  var filters, table, tr, i;
  filters = JSON.parse(event.target.getAttribute('data-filter'));
  
  table = document.getElementById("time-table");
  tbody = table.getElementsByTagName('tbody')[0];
  tr = tbody.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
      for(filter in filters){
          if(tr[i].getAttribute('data-'+filter) == filters[filter]){
              tr[i].style.display = "";
          }else{
            tr[i].style.display = "none";
          }
      }
  }
}

const filters = document.querySelectorAll('.filters button').forEach(item => {
  item.addEventListener('click', filterTable)
});