const addMovie = (name, year, description, route, successAltertId, exceptionAltertid) =>{
    const query = "name="+document.querySelector(name).value+"&year="+document.querySelector(year).value+"&description="+document.querySelector(description).value;
    create(route, query, successAlertId, exceptionAlertId);
};