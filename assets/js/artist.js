document.querySelectorAll('.carousel').forEach(function(carousel) {

    // Pause on hover
    carousel.addEventListener('mouseenter', () => {
        bootstrap.Carousel.getInstance(carousel).pause();
    });

    carousel.addEventListener('mouseleave', () => {
        bootstrap.Carousel.getInstance(carousel).cycle();
    });

    // Counter update
    carousel.addEventListener('slide.bs.carousel', function(e) {
        let id = carousel.id.replace('carousel', '');
        let counter = document.getElementById('counter' + id);
        if (counter) {
            counter.innerText = (e.to + 1) + " / " + carousel.querySelectorAll('.carousel-item').length;
        }
    });

});

function resetFilters() {

    // 🔥 Show loader
    showLoader();

    // ⏳ Wait 2 seconds
    setTimeout(() => {

        location.reload(); // simple way to reset all filters and show loader

        // OPTIONAL: reload data
        // loadPackages();

        // ❌ Hide loader
        hideLoader();

    }, 500);
}

document.getElementById('searchInput').addEventListener('keyup', debounceFilter);
document.getElementById('locationInput').addEventListener('keyup', debounceFilter);
document.getElementById('priceFilter').addEventListener('change', debounceFilter);

function filterPackages() {

    let search = document.getElementById('searchInput').value.toLowerCase();
    let location = document.getElementById('locationInput').value.toLowerCase();
    let price = document.getElementById('priceFilter').value;

    let visibleCount = 0;

    document.querySelectorAll('.col-md-4[data-area]').forEach(card => {

        let name = card.querySelector('.artist-name') ? card.querySelector('.artist-name').innerText.toLowerCase() : '';
        let areas = card.getAttribute('data-area') || '';
        let priceText = card.querySelector('.price') ? card.querySelector('.price').innerText.replace('₹', '') : '0';
        let finalPrice = parseInt(priceText);

        let show = true;

        if (search && !name.includes(search)) show = false;

        if (location) {
            let areaList = areas.split('/');
            let match = areaList.some(a => a.trim().includes(location));
            if (!match) show = false;
        }

        if (price) {
            let [min, max] = price.split('-');
            min = parseInt(min);
            max = max ? parseInt(max) : Infinity;

            if (finalPrice < min || finalPrice > max) show = false;
        }

        if (show) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    let noResults = document.getElementById('noResults');
    noResults.style.display = visibleCount === 0 ? 'block' : 'none';
}

let filterTimeout;

function debounceFilter() {

    // 🔥 show loader immediately
    showLoader();

    // clear previous typing
    clearTimeout(filterTimeout);

    filterTimeout = setTimeout(() => {

        filterPackages();

        // ❌ hide loader after filtering
        hideLoader();

    }, 400); // delay
}