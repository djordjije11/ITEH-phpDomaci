window.addEventListener('DOMContentLoaded', function () {
    const button = document.querySelector("#saveMovie");
    button.addEventListener('click', () => {
        const name = document.querySelector('#name').value;
        const year = document.querySelector('#year').value;
        const description = document.querySelector('#description').value;
         
        const exceptionAlertId = "#movieSavedFalse";
        const successAlertId = "#movieSavedTrue";
        const route = "/ITEH-phpDomaci/Controllers/MovieCreateController.php";
        const query = "name="+name+"&year="+year+"&description="+description;
        create(route, query, successAlertId, exceptionAlertId);
    });
});