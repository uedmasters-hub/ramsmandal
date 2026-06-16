const items = document.querySelectorAll('.work-item');

items.forEach(item => {

    item.querySelector('.work-row')
        .addEventListener('click', () => {

            items.forEach(i =>
                i.classList.remove('active')
            );

            item.classList.add('active');

        });

});