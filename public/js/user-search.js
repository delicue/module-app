// resources/js/user-search.js
// Simple client-side user search functionality.
document.getElementById('userSearch').addEventListener('input', function (e) {
    console.log('Search input changed:', e.target.value);
    const searchText = e.target.value.toLowerCase();
    const userItems = document.getElementsByClassName('user-item');

    Array.from(userItems).forEach(item => {
        const name = item.querySelector('.user-name').textContent.toLowerCase();
        const email = item.querySelector('.user-email').textContent.toLowerCase();

        if (name.includes(searchText) || email.includes(searchText)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
    console.log('Filtered user items based on search text:', searchText);
});