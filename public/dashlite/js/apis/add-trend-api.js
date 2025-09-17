document.addEventListener("DOMContentLoaded", () => {
    const saveTrendBtn = document.getElementById("saveTrendBtn");
    const newTrendInput = document.getElementById("newTrendInput");
    const addTrendModal = document.getElementById("addTrendModal");
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    saveTrendBtn.addEventListener("click", async () => {
        const newTrendName = newTrendInput.value.trim();
        if (!newTrendName) {
            newTrendInput.classList.add("is-invalid");
            return;
        }

        newTrendInput.classList.remove("is-invalid");
        saveTrendBtn.disabled = true;
        saveTrendBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> جاري الحفظ...`;

        try {
            const res = await fetch(`/dashboard/api/add-trend`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({ title: newTrendName })
            });

            const data = await res.json();

            console.log(data);

            if (data?.id) {
                newTrendInput.value = "";
                const modal = bootstrap.Modal.getInstance(addTrendModal);
                modal.hide();
                showToast("تمت إضافة الاتجاه بنجاح ✅", "success");
            } else {
                showToast("حدث خطأ أثناء إضافة الاتجاه ❌", "danger");
            }
        } catch (err) {
            console.error(err);
            showToast("فشل الاتصال بالخادم ⚠️", "warning");
        } finally {
            saveTrendBtn.disabled = false;
            saveTrendBtn.innerHTML = "حفظ";
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
