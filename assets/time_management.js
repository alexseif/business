function setComplete() {
    const dateField = document.querySelector('#time_management_completed_date');
    const timeField = document.querySelector('#time_management_completed_time');

    let date = new Date();
    dateField.value = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0);
    timeField.value = date.getHours().toString() + ':' + date.getMinutes().toString().padStart(2, '0');
    return false;
}

const completeBtn = document.querySelector('#tm_complete');
completeBtn.addEventListener('click', setComplete);
