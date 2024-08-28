document.getElementById('dropdownButton').addEventListener('click', function() {
    var dropdownMenu = document.getElementById('dropdownMenu');
    if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
        dropdownMenu.style.display = 'block';
    } else {
        dropdownMenu.style.display = 'none';
    }
});

window.addEventListener('click', function(e) {
    if (!document.getElementById('dropdownButton').contains(e.target)) {
        document.getElementById('dropdownMenu').style.display = 'none';
    }
});
