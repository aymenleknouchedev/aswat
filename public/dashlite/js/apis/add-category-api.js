document.addEventListener("DOMContentLoaded", () => {
    const saveCategoryBtn = document.getElementById("saveCategoryBtn");
    const newCategoryInput = document.getElementById("newCategoryInput");
    const addCategoryModal = document.getElementById("addCategoryModal");
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    saveCategoryBtn.addEventListener("click", async () => {
        const newCategoryName = newCategoryInput.value.trim();
        if (!newCategoryName) {
            newCategoryInput.classList.add("is-invalid");
            return;
        }

        newCategoryInput.classList.remove("is-invalid");
        saveCategoryBtn.disabled = true;
        saveCategoryBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> جاري الحفظ...`;

        try {
            const res = await fetch(`/dashboard/api/add-category`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({ name: newCategoryName })
            });

            const data = await res.json();

            console.log(data);

            if (data?.id) {
                newCategoryInput.value = "";
                const modal = bootstrap.Modal.getInstance(addCategoryModal);
                modal.hide();
                showToast("تمت إضافة الصنف بنجاح ✅", "success");
            } else {
                showToast("حدث خطأ أثناء إضافة الصنف ❌", "danger");
            }
        } catch (err) {
            console.error(err);
            showToast("فشل الاتصال بالخادم ⚠️", "warning");
        } finally {
            saveCategoryBtn.disabled = false;
            saveCategoryBtn.innerHTML = "حفظ";
        }
    });

    function showToast(message, type = "info") {
        const toast = document.createElement("div");
        toast.className = `toast align-items-center text-bg-${type} border-0 fade show position-fixed bottom-0 end-0 m-3`;
        toast.role = "alert";
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
});
