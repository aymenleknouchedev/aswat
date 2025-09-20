document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("tagSearch");
    const resultsBox = document.getElementById("tagResults");
    const tagContainer = document.getElementById("tagContainer");
    const hiddenTagsBox = document.getElementById("hiddenTags");
    let debounceTimer;
    let selectedTags = [];

    function initializeSelectedTags() 
    {
        const existingChips = document.querySelectorAll("#tagInputBox .tag-chip");
        existingChips.forEach(chip => {
            const tagId = chip.querySelector(".remove-tag").getAttribute("data-tag-id");
            const name = chip.querySelector('.chip-name').innerHTML;
            const tag = { id: tagId, name: name };
            appendHiddenTag(tagId);
            chip.querySelector(".remove-tag").addEventListener("click", () => {
                selectedTags = selectedTags.filter(id => id !== tagId);
                chip.remove();
                document.getElementById(`hiddenTag-${tagId}`)?.remove();
            });
        });
    }

    initializeSelectedTags();

    searchInput.addEventListener("input", function () {
        clearTimeout(debounceTimer);
        const query = this.value.trim();

        if (query.length < 2) {
            resultsBox.style.display = "none";
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch(`/dashboard/api/search-tags?search=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    resultsBox.innerHTML = "";
                    if (data.length > 0) {
                        data.forEach(item => {
                            if (!selectedTags.includes(item.id)) {
                                const option = document.createElement("div");
                                option.className = "dropdown-item";
                                option.textContent = item.name;
                                option.style.cursor = "pointer";
                                option.style.color = "grey";
                                option.addEventListener("click", () => {
                                    addTag(item);
                                    resultsBox.style.display = "none";
                                    searchInput.value = "";
                                    searchInput.focus();
                                });
                                resultsBox.appendChild(option);
                            }
                        });
                        resultsBox.style.display = "block";
                    } else {
                        resultsBox.style.display = "none";
                    }
                })
                .catch(err => console.error(err));
        }, 300);
    });

    // Add tag as chip
    function addTag(tag) {
        if (selectedTags.includes(tag.id)) return;
        selectedTags.push(tag.id);

        const chip = document.createElement("div");
        chip.className = "tag-chip";
        chip.innerHTML = `${tag.name} <span>&times;</span>`;

        chip.querySelector("span").addEventListener("click", () => {
            selectedTags = selectedTags.filter(id => id !== tag.id);
            chip.remove();
            document.getElementById(`hiddenTag-${tag.id}`)?.remove();
        });

        tagContainer.insertBefore(chip, searchInput);

        appendHiddenTag(tag.id);
    }

    function appendHiddenTag(id) {
        const hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "tags_id[]";
        hiddenInput.value = id;
        hiddenInput.id = `hiddenTag-${id}`;
        hiddenTagsBox.appendChild(hiddenInput);
    }

    document.addEventListener("click", function (e) {
        if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
            resultsBox.style.display = "none";
        }
    });
});
