window.addEventListener('DOMContentLoaded', function () {
    const button = document.querySelector("#saveReview");
    button.addEventListener('click', () => {
        const rating = document.querySelector('#rating').value;
        const reviewText = document.querySelector('#reviewText').value;
         
        const exceptionAlertId = "#reviewSavedFalse";
        const successAlertId = "#reviewSavedTrue";
        const route = "/ITEH-phpDomaci/Controllers/ReviewCreateController.php";
        const query = "rating="+rating+"&reviewText="+reviewText;
        create(route, query, successAlertId, exceptionAlertId);
    });
});