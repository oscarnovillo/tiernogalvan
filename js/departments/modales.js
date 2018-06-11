var modal = document.getElementById('agregarDepartartamento');
var span = document.getElementsByClassName("close-modal")[0];
span.onclick = function () {
    modal.style.display = "none";
};
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

if (urlParam("op") == "add") {
    modal.style.display = "block";
}