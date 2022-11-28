const addReview = (movieId, rating, reviewText, route, successAlertId, exceptionAlertId) => {
    const query = "rating="+document.querySelector(rating).value+"&reviewText="+document.querySelector(reviewText).value+"&movieId="+movieId;
    create(route, query, successAlertId, exceptionAlertId);
};