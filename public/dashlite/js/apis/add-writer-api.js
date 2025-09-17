document.addEventListener("DOMContentLoaded", () => {
  const saveWriterBtn = document.getElementById("saveWriterBtn");
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

  if (!saveWriterBtn) {
    console.error("❌ saveWriterBtn not found (id=saveWriterBtn).");
    return;
  }

  saveWriterBtn.addEventListener("click", async (e) => {
    e.preventDefault();

    // Collect inputs separately
    const name = document.getElementById("writerName")?.value.trim() || "";
    const slug = document.getElementById("writerSlug")?.value.trim() || "";
    const bio = document.getElementById("writerBio")?.value.trim() || "";

    const imageFile = document.getElementById("writerImage")?.files[0] || null;
    const facebook = document.getElementById("writerFacebook")?.value.trim() || "";
    const x = document.getElementById("writerX")?.value.trim() || "";
    const instagram = document.getElementById("writerInstagram")?.value.trim() || "";
    const linkedin = document.getElementById("writerLinkedin")?.value.trim() || "";

    // Build FormData manually
    const formData = new FormData();
    formData.append("name", name);
    formData.append("slug", slug);
    formData.append("bio", bio);
    if (imageFile) formData.append("image", imageFile);
    formData.append("facebook", facebook);
    formData.append("x", x);
    formData.append("instagram", instagram);
    formData.append("linkedin", linkedin);

    // Button UI feedback
    const originalText = saveWriterBtn.innerHTML;
    saveWriterBtn.disabled = true;
    saveWriterBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> جاري الحفظ...`;

    try {
      const res = await fetch("/dashboard/api/add-writer", {
        method: "POST",
        headers: {
          ...(csrfToken ? { "X-CSRF-TOKEN": csrfToken } : {})
        },
        body: formData
      });

      const data = await res.json();
      console.log("server response:", data);

      if (data?.id) {
        // Reset fields
        document.getElementById("writerName").value = "";
        document.getElementById("writerSlug").value = "";
        document.getElementById("writerBio").value = "";
        document.getElementById("writerFacebook").value = "";
        document.getElementById("writerX").value = "";
        document.getElementById("writerInstagram").value = "";
        document.getElementById("writerLinkedin").value = "";

        showToast("تمت إضافة الكاتب بنجاح ✅", "success");
      } else {
        showToast("حدث خطأ أثناء إضافة الكاتب ❌", "danger");
      }
    } catch (err) {
      console.error(err);
      showToast("فشل الاتصال بالخادم ⚠️", "warning");
    } finally {
      saveWriterBtn.disabled = false;
      saveWriterBtn.innerHTML = originalText;
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
      </div>`;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
  }
});
