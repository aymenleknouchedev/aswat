document.addEventListener("DOMContentLoaded", function () {
    
    const searchInput = document.getElementById("tagSearch");
    const tagContainer = document.getElementById("tagContainer");
    const hiddenTagsBox = document.getElementById("hiddenTags");
    const saveTagBtn = document.getElementById("saveTagBtn");
    const newTagInput = document.getElementById("newTagInput");
    const addTagModal = document.getElementById("addTagModal");
    let selectedTags = [];

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

        const hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "tags_id[]";
        hiddenInput.value = tag.id;
        hiddenInput.id = `hiddenTag-${tag.id}`;
        hiddenTagsBox.appendChild(hiddenInput);
    }

    saveTagBtn.addEventListener("click", function () {
        const newTagName = newTagInput.value.trim();
        if (newTagName === "") return;

        fetch(`/dashboard/api/add-tag`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ name: newTagName })
        })
            .then(res => res.json())
            .then(data => {
                if (data?.id) {
                    addTag(data);
                    newTagInput.value = "";
                    const modal = bootstrap.Modal.getInstance(addTagModal);
                    modal.hide();
                } else {
                    alert("خطأ أثناء إضافة الوسم");
                }
            })
            .catch(err => console.error(err));
    });
});
