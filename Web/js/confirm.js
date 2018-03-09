let deleteLinks = document.querySelectorAll('.delete-post');

deleteLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        document.getElementById('delete').href = e.target.href;
    });
});
