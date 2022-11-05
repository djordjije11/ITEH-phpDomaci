const create = (route, query, successAlertId, exceptionAlertId) => {
    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const resp = JSON.parse(this.response);

            if(resp.success) {
                const el = document.querySelector(successAlertId);
                el.style.display = 'flex';

                window.setTimeout(function() {
                    el.style.display = 'none';
                }, 5000);

            } else if (resp.message) {

                const el = document.querySelector(exceptionAlertId);
                el.textContent = resp.message;
                el.style.display = 'flex';

                window.setTimeout(function() {
                    el.style.display = 'none';
                }, 5000);

            }
        }
    }

    request.open(
            "POST",
            route,
            true
        );
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(query);
};