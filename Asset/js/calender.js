var calendarNode = document.querySelector("#calendar");
var currDate = new Date();
var currYear = currDate.getFullYear();
var currMonth = currDate.getMonth() + 1;
var selectedYear = currYear;
var selectedMonth = currMonth;
var selectedMonthName = getMonthName(selectedYear, selectedMonth);
var selectedMonthDays = getDayCount(selectedYear, selectedMonth);

renderDOM(selectedYear, selectedMonth);

function getMonthName (year, month) {
    let selectedDate = new Date(year, month-1, 1);
    return selectedDate.toLocaleString('default', { month: 'long' });
}

function getMonthText () {
    if (selectedYear === currYear)
        return selectedMonthName;
    else
        return selectedMonthName + ", " + selectedYear;
}

function getDayName (year, month, day) {
    let selectedDate = new Date(year, month-1, day);
    return selectedDate.toLocaleDateString('en-US',{weekday: 'long'});
}

function getDayCount (year, month) {
    return 32 - new Date(year, month-1, 32).getDate();
}

function getDaysArray () {
    let emptyFieldsCount = 0;
    let emptyFields = [];
    let days = [];

    switch(getDayName(selectedYear, selectedMonth, 1))
    {
        case "Tuesday":
            emptyFieldsCount = 1;
            break;
        case "Wednesday":
            emptyFieldsCount = 2;
            break;
        case "Thursday":
            emptyFieldsCount = 3;
            break;
        case "Friday":
            emptyFieldsCount = 4;
            break;
        case "Saturday":
            emptyFieldsCount = 5;
            break;
        case "Sunday":
            emptyFieldsCount = 6;
            break;
    }
  
    emptyFields = Array(emptyFieldsCount).fill("");
    days = Array.from(Array(selectedMonthDays + 1).keys());
    days.splice(0, 1);
    
    return emptyFields.concat(days);
}

function renderDOM (year, month) {
  let newCalendarNode = document.createElement("div");
  newCalendarNode.id = "calendar";
  newCalendarNode.className = "calendar";
  
  let dateText = document.createElement("div");
  dateText.append(getMonthText());
  dateText.className = "date-text";
  newCalendarNode.append(dateText);
  
  let leftArrow = document.createElement("div");
  leftArrow.append("«");
  leftArrow.className = "button";
  leftArrow.addEventListener("click", goToPrevMonth);
  newCalendarNode.append(leftArrow);
  
  let curr = document.createElement("div");
  curr.append("📅");
  curr.className = "button";
  curr.addEventListener("click", goToCurrDate);
  newCalendarNode.append(curr);
  
  let rightArrow = document.createElement("div");
  rightArrow.append("»");
  rightArrow.className = "button";
  rightArrow.addEventListener("click", goToNextMonth);
  newCalendarNode.append(rightArrow);
  
  let dayNames = ["M", "T", "W", "T", "F", "S", "S"];
  
  dayNames.forEach((cellText) => {
    let cellNode = document.createElement("div");
    cellNode.className = "cell cell--unselectable";
    cellNode.append(cellText);
    newCalendarNode.append(cellNode);
  });
  
  let days = getDaysArray(year, month);
  
  days.forEach((cellText) => {
    let cellNode = document.createElement("div");
    cellNode.className = "cell";
    cellNode.append(cellText);
    newCalendarNode.append(cellNode);
  });
  
  calendarNode.replaceWith(newCalendarNode);
  calendarNode = document.querySelector("#calendar");
}

function goToPrevMonth () {
    selectedMonth--;
    if (selectedMonth === 0) {
        selectedMonth = 12;
        selectedYear--;
    }
    selectedMonthDays = getDayCount(selectedYear, selectedMonth);
    selectedMonthName = getMonthName(selectedYear, selectedMonth);
  
    renderDOM(selectedYear, selectedMonth);
}

function goToNextMonth () {
    selectedMonth++;
    if (selectedMonth === 13) {
        selectedMonth = 0;
        selectedYear++;
    }
    selectedMonthDays = getDayCount(selectedYear, selectedMonth);
    selectedMonthName = getMonthName(selectedYear, selectedMonth);
  
    renderDOM(selectedYear, selectedMonth);
}

function goToCurrDate () {
    selectedYear = currYear;
    selectedMonth = currMonth;

    selectedMonthDays = getDayCount(selectedYear, selectedMonth);
    selectedMonthName = getMonthName(selectedYear, selectedMonth);
  
    renderDOM(selectedYear, selectedMonth);
}