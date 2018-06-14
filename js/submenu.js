$(document).ready(function () {
    $("#Incidencias").on("click", changeActiveMenu);
    $("#Departamentos").on("click", changeActiveMenu);
    $("#TIC_USERS").on("click", changeActiveMenu);
});

function removeOldActiveMenu() {
    $(".submenu_wrapper label").each(function () {
        $(this).removeClass("active");
    });
}

function changeActiveMenu(e) {
    removeOldActiveMenu();
    $(e.currentTarget).next("label").addClass("active");
}