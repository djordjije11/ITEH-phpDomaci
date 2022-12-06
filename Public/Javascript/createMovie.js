const addMovie = (name, year, description, route, successAlertId, exceptionAlertid) =>{
    const query = "name="+document.querySelector(name).value+"&year="+document.querySelector(year).value+"&description="+document.querySelector(description).value;
    create(route, query, successAlertId, exceptionAlertid);
};