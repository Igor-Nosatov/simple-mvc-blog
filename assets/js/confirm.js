let deleteBtns = document.querySelectorAll('.delete-btn');

deleteBtns.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        document.getElementById('delete').href = e.target.href;
    });
});
