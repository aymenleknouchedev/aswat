@extends('layouts.admin')

@section('title', 'أصوات جزائرية | تعديل خبر عاجل')
@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                                    <div>
                                        <h4 class="nk-title" data-en="Content Reviews" data-ar="مراجعات المحتوى">مراجعات المحتوى</h4>
                                        <p class="text-soft" data-en="Manage and track all reviews and comments" data-ar="إدارة وتتبع جميع المراجعات والتعليقات">إدارة وتتبع جميع المراجعات والتعليقات</p>
                                    </div>
                                </div>

                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="d-flex flex-column" id="reviews-container">
                                            @if($reviews->count() > 0)
                                                @foreach ($reviews as $review)
                                                    @php
                                                        $isOwner = auth()->id() === $review->reviewer_id;
                                                    @endphp

                                                    <div class="note-item {{ $isOwner ? 'note-owner' : 'note-other' }}">
                                                        <div class="note-header d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <span class="fw-bold">{{ $review->reviewer->name }} {{ $review->reviewer->surname }}</span>
                                                                <small class="text-light ms-2">{{ $review->created_at->format('Y-m-d H:i') }}</small>
                                                            </div>
                                                            @if($isOwner)
                                                                <a href="#" class="delete-review text-light" data-id="{{ $review->id }}">
                                                                    <em class="icon ni ni-trash"></em>
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="note-body">
                                                            <p class="mb-0">{{ $review->message }}</p>
                                                        </div>
                                                    </div>

                                                @endforeach
                                            @else
                                                <div class="text-center py-5">
                                                    <em class="icon ni ni-file-text fs-2 text-light"></em>
                                                    <p class="mt-2 text-muted" data-en="No reviews yet" data-ar="لا توجد مراجعات حتى الآن">لا توجد مراجعات حتى الآن</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-bordered mt-3">
                                    <div class="card-inner">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 position-relative">
                                                <input id="message_text" name="review_description" class="form-control form-control-lg" placeholder="أضف ملاحظة جديدة..." />
                                                <input type="hidden" id="content_id" value="{{ $id }}" />
                                                <button 
                                                    id="send_message" 
                                                    class="btn btn-primary position-absolute"
                                                    style="right: 5px; top: 5px; height: calc(100% - 10px);"
                                                >
                                                    <em class="icon ni ni-plus"></em>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection

<style>
    .note-item {
        display: flex;
        flex-direction: column;
        border-radius: 8px;
        margin-bottom: 15px;
        border: 1px solid #e5e5e5;
        max-width: 60%;
    }

    @media (max-width: 768px) {
        .note-item {
            max-width: 90%;
        }
    }

    .note-owner {
        align-self: flex-start;
        width: 100%;
    }

    .note-other {
        align-self: flex-end;
        width: 100%;
    }

    .note-header {
        padding: 8px 12px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 5px 5px 0 0;
    }

    .note-body {
        padding: 10px;
        font-size: 13px;
        color: #333;
        border-radius: 0 0 5px 5px;
    }

    .note-owner .note-header {
        background: #4a6cf7;
        color: #fff;
    }
    .note-owner .note-body {
        background: #eaf0ff;
    }

    .note-other .note-header {
        background: #6c757d;
        color: #fff;
    }
    .note-other .note-body {
        background: #f5f5f5;
    }

    #reviews-container {
        min-height: 300px;
        max-height: 60vh;
        overflow-y: auto;
        padding: 10px;
    }
    #reviews-container::-webkit-scrollbar {
        width: 6px;
    }
    #reviews-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    #reviews-container::-webkit-scrollbar-thumb {
        background: #c5c5c5;
        border-radius: 10px;
    }
    #reviews-container::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Send new review
        document.getElementById("send_message").addEventListener("click", async function(e) {
            e.preventDefault();

            if (!document.getElementById("message_text").value.trim()) {
                return;
            }
            
            const contentId = document.getElementById("content_id").value;
            const message = document.getElementById("message_text").value.trim();

            try {
                const response = await fetch('/dashboard/api/store/reviews', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        content_id: contentId,
                        message: message
                    })
                });

                const data = await response.json();

                if (data.review) {
                    const reviewsContainer = document.getElementById("reviews-container");
                    const newReviewHTML = `
                        <div class="note-item note-owner">
                            <div class="note-header d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-bold">{{ auth()->user()->name }} {{ auth()->user()->surname }}</span>
                                    <small class="text-light ms-2">${new Date().toLocaleString()}</small>
                                </div>
                                <a href="#" class="delete-review text-light" data-id="${data.review.id}">
                                    <em class="icon ni ni-trash"></em>
                                </a>
                            </div>
                            <div class="note-body">
                                <p class="mb-0">${data.review.message}</p>
                            </div>
                        </div>
                    `;
                    reviewsContainer.insertAdjacentHTML('beforeend', newReviewHTML);
                    reviewsContainer.scrollTop = reviewsContainer.scrollHeight;
                    document.getElementById("message_text").value = "";
                }
            } catch (error) {
                console.error('Error sending message:', error);
            }
        });

        document.addEventListener('click', async function(e) {
            if (e.target.closest('.delete-review')) {
                e.preventDefault();
                const button = e.target.closest('.delete-review');
                const reviewId = button.getAttribute('data-id');

                try {
                    const response = await fetch(`/dashboard/api/delete/reviews/${reviewId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await response.json();

                    if (data.message) {
                        window.location.reload();
                    } else if (data.error) {
                        alert(data.error);
                    }
                } catch (error) {
                    console.error('Delete failed:', error);
                    alert('حدث خطأ أثناء حذف المراجعة.');
                }
            }
        });

        // Auto scroll to bottom
        const reviewsContainer = document.getElementById('reviews-container');
        if (reviewsContainer) {
            reviewsContainer.scrollTop = reviewsContainer.scrollHeight;
        }
    });
</script>
