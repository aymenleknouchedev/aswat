document.addEventListener("DOMContentLoaded", () => {
    const saveWindowBtn = document.getElementById("saveWindowBtn");
    const newWindowInput = document.getElementById("newWindowInput");
    const addWindowModal = document.getElementById("addWindowModal");
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    saveWindowBtn.addEventListener("click", async () => {
        const newWindowName = newWindowInput.value.trim();
        if (!newWindowName) {
            newWindowInput.classList.add("is-invalid");
            return;
        }

        newWindowInput.classList.remove("is-invalid");
        saveWindowBtn.disabled = true;
        saveWindowBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> جاري الحفظ...`;

        try {
            const res = await fetch(`/dashboard/api/add-window`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({ name: newWindowName })
            });

            const data = await res.json();

            if (data?.id) {
                newWindowInput.value = "";
                const modal = bootstrap.Modal.getInstance(addWindowModal);
                modal.hide();
                showToast("تمت إضافة النافذة بنجاح ✅", "success");
            } else {
                showToast("حدث خطأ أثناء إضافة النافذة ❌", "danger");
            }
        } catch (err) {
            console.error(err);
            showToast("فشل الاتصال بالخادم ⚠️", "warning");
        } finally {
            saveWindowBtn.disabled = false;
            saveWindowBtn.innerHTML = "حفظ";
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
