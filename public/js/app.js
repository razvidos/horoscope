document.addEventListener('DOMContentLoaded', function() {
    const SHOW_PREDICTION_EVENT = new Event('show_prediction');
    document.querySelectorAll('.circle_div').forEach(element => {
        element.querySelector('img').addEventListener('click', function(e) {
            document.dispatchEvent(SHOW_PREDICTION_EVENT);
            let prediction = e.target.parentElement.querySelector('.prediction');

            let regExp = /[a-zA-Z]/g;
            if (!regExp.test(prediction.innerText)) {
                console.log('Generate prediction');
                let url = '/api/get_daily_prediction';
                url += '?date=' + document.querySelector('input[name="date"]').value;
                url += '&horoscope_id=' + element.dataset.id
                fetch(url).then((response) => {
                    return response.json();
                }).then((data) => {
                    prediction.innerText = data.prediction_text;
                    element.classList.add('new');
                });
            }
            prediction.classList.toggle('hidden');
        });
    });

    document.addEventListener('show_prediction', function() {
        document.querySelectorAll('.prediction').forEach(element => {
            element.classList.add('hidden');
        })
    });

    document.querySelectorAll('.circle_div').forEach(element => {
        let regExp = /[a-zA-Z]/g;
        let prediction = element.querySelector('.prediction');

        if (regExp.test(prediction.innerText)) {
            element.classList.add('old');
        }
    })
});
