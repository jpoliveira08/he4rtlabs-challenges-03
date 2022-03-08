function divInteraction() {
    verticalNav = document.querySelector("#mySideNav");
    verticalNav.offsetWidth === 0 ? verticalNav.style.width = "250px" : verticalNav.style.width = "0px";
}

function openReports() {
    const reportList = document.getElementById('report-list');
    reportList.style.display === 'none' ? reportList.style.display = 'block' : reportList.style.display = 'none';

    const arrow = document.getElementById('arrow');
    arrow.classList.toggle('fa-arrow-up');
}