

// get elements by class
const downButtons = document.getElementsByClassName('more-click');
// loop through elements and add event listener
for (let i = 0; i < downButtons.length; i++) {
    downButtons[i].addEventListener('click', function (el) {
        const id = el.currentTarget.getAttribute('data-id');
        const more = document.getElementById('orders-' + id);
        if (more.style.display === 'table-cell') {
            more.style.display = 'none';
        } else {
            more.style.display = 'table-cell';
        }
    });
}
