<!-- Unified Media Modal -->
<div class="modal fade" id="mediaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">مكتبة الوسائط</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label for="mediaSourceSelect">اختر مصدر الوسائط:</label>
                    <select id="mediaSourceSelect" class="form-select">
                        <option value="library">من المكتبة</option>
                        <option value="upload">رفع من الجهاز</option>
                        <option value="link">رابط مباشر</option>
                    </select>
                </div>

                <!-- Library Grid -->
                <div id="mediaLibrarySection" class="source-section">
                    <div class="d-flex flex-wrap gap-2" id="mediaLibraryGrid">
                        {{-- سيتم تعبئته ديناميكياً --}}
                    </div>
                </div>

                <!-- Upload Section -->
                <div id="mediaUploadSection" class="source-section" style="display:none;">
                    <input type="file" id="mediaUploadFile" class="form-control mb-2">
                    <input type="text" id="mediaUploadName" class="form-control mb-2" placeholder="اسم الوسائط (اختياري)">
                    <input type="text" id="mediaUploadAlt" class="form-control" placeholder="نص بديل (Alt Text)">
                    <button class="btn btn-success mt-2" id="mediaUploadBtn">رفع</button>
                </div>

                <!-- Link Section -->
                <div id="mediaLinkSection" class="source-section" style="display:none;">
                    <input type="url" id="mediaLinkInput" class="form-control mb-2" placeholder="https://example.com/media.jpg">
                    <input type="text" id="mediaLinkAlt" class="form-control" placeholder="نص بديل (Alt Text)">
                    <button class="btn btn-primary mt-2" id="mediaAddLinkBtn">إضافة</button>
                </div>

            </div>

        </div>
    </div>
</div>
