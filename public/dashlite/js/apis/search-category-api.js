document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("categorySearch");
    const resultsBox = document.getElementById("categoryResults");
    const hiddenInput = document.getElementById("categoryHidden");
    let debounceTimer;

    searchInput.addEventListener("input", function () {
        clearTimeout(debounceTimer);
        const query = this.value.trim();

        if (query.length < 2) {
            resultsBox.style.display = "none";
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch(`/dashboard/api/search-categories?search=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    resultsBox.innerHTML = "";
                    if (data.length > 0) {
                        data.forEach(item => {
                            const option = document.createElement("div");
                            option.className = "dropdown-item";
                            option.textContent = item.name;
                            option.dataset.value = item.id;
                            option.style.cursor = "pointer";
                            option.style.color = "grey";
                            option.addEventListener("click", () => {
                                searchInput.value = item.name;
                                hiddenInput.value = item.id;
                                resultsBox.style.display = "none";
                            });
                            resultsBox.appendChild(option);
                        });
                        resultsBox.style.display = "block";
                    } else {
                        resultsBox.style.display = "none";
                    }
                })
                .catch(err => console.error(err));
        }, 300);
    });

    document.addEventListener("click", function (e) {
        if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
            resultsBox.style.display = "none";
        }
    });
});