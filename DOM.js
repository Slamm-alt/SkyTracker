
function changeLanguage(language) {
    const languageText = document.querySelector('#language-selector');
    if (language === 'EN') {
        languageText.textContent = 'EN | EDR';
    } else {
        languageText.textContent = 'EDR | EN';
    }
}

function showLogin() {
    alert('Login Form will appear soon!');
}

document.addEventListener("DOMContentLoaded", function() {
    const loginButton = document.querySelector('.login-button');
    loginButton.addEventListener('click', showLogin);

    const languageSelector = document.querySelector('#language-selector');
    languageSelector.addEventListener('click', function() {
        const currentText = languageSelector.textContent.trim();
        if (currentText === 'EN | EDR') {
            changeLanguage('EDR');
        } else {
            changeLanguage('EN');
        }
    });
});
