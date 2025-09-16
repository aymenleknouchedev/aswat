document.addEventListener("DOMContentLoaded", function () {
    const trendInput = document.getElementById("trendSearch");
    const trendResults = document.getElementById("trendResults");
    const trendHidden = document.getElementById("trendHidden");
    let debounceTrend;

    trendInput.addEventListener("input", function () {
        clearTimeout(debounceTrend);
        const query = this.value.trim();

        if (query.length < 2) {
            trendResults.style.display = "none";
            return;
        }

        debounceTrend = setTimeout(() => {
            fetch(`/dashboard/api/search-trends?search=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    trendResults.innerHTML = "";
                    if (data.length > 0) {
                        data.forEach(item => {
                            const option = document.createElement("div");
                            option.className = "dropdown-item";
                            option.textContent = item.title;
                            option.dataset.value = item.id;
                            option.style.cursor = "pointer";
                            option.style.color = "grey";
                            option.addEventListener("click", () => {
                                trendInput.value = item.title;
                                trendHidden.value = item.id;
                                trendResults.style.display = "none";
                            });
                            trendResults.appendChild(option);
                        });
                        trendResults.style.display = "block";
                    } else {
                        trendResults.style.display = "none";
                    }
                })
                .catch(err => console.error(err));
        }, 300);
    });

    document.addEventListener("click", function (e) {
        if (!trendInput.contains(e.target) && !trendResults.contains(e.target)) {
            trendResults.style.display = "none";
        }
    });
});
