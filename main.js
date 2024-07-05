var mail = document.getElementById('mail');
var btn = document.getElementById('btn');
var form = document.getElementById('myForm');
var names = document.getElementById('name');
var emails = document.getElementById('email');
var texts = document.getElementById('text');

var formData = new FormData(form);
formData.append('name', document.getElementById('name').value);
formData.append('email', document.getElementById('email').value);
formData.append('text', document.getElementById('text').value);

btn.onclick = function() {
    fetch('action.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Проверка наличия тела ответа
            if (!response.body) {
                throw new Error('Response body is undefined');
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                // Обработка успешного ответа
                // alert(data.message);
                mail.style.opacity = 1;
                setTimeout(() => {
                    mail.style.opacity = 0;
                }, 1800);
                names.value = '';
                emails.value = '';
                texts.value = '';
                document.getElementById('myForm').reset();
                // Дополнительные действия после успешной отправки
            } else {
                // Обработка ошибки
                alert(data.message);
            }
        })
        .catch(error => {
            // Обработка ошибок
            console.error('There was a problem with the fetch operation:', error);
            alert('There was a problem with the fetch operation. Check the console for details.');
        });

};