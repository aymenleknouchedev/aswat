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

                                                    <div class="d-flex {{ $isOwner ? 'justify-content-end' : 'justify-content-start' }}">
                                                        <div class="message-bubble {{ $isOwner ? 'message-owner' : 'message-other' }}">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="user-avatar sm">
                                                                        {{ substr($review->reviewer->name, 0, 1) }}{{ substr($review->reviewer->surname, 0, 1) }}
                                                                    </div>
                                                                    
                                                                    <div class="d-flex flex-column mx-2">
                                                                        <span class="fw-bold">{{ $review->reviewer->name }} {{ $review->reviewer->surname }}</span>
                                                                    </div>
                                                                </div>
                                                                
                                                                @if($isOwner)
                                                                <a href="#" class="delete-review text-danger" data-id="{{ $review->id }}">
                                                                    <em class="icon ni ni-trash"></em>
                                                                </a>
                                                                @endif
                                                            </div>
                                                            
                                                            <div class="message-content">
                                                                <p class="mb-0">{{ $review->message }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="text-center py-5">
                                                    <em class="icon ni ni-chat-round fs-2 text-light"></em>
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
                                                <input id="message_text" name="review_description" class="form-control form-control-lg" />
                                                <input type="hidden" id="content_id" value="{{ $id }}" />
                                                <button 
                                                    id="send_message" 
                                                    class="btn btn-primary position-absolute"
                                                >
                                                    <em class="icon ni ni-send"></em>
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

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const siteLang = localStorage.getItem('siteLang') || 'en';
        const sendBtn = document.getElementById("send_message");

        if (siteLang === "ar") {
            sendBtn.classList.add("send-btn-rtl");
        } else {
            sendBtn.classList.add("send-btn-ltr");
        }
    });
</script>

<style>
    /* LTR (default) */
    .send-btn-ltr {
        right: 5px;
        top: 5px;
        height: calc(100% - 10px);
    }

    /* RTL */
    .send-btn-rtl {
        left: 5px;
        top: 5px;
        height: calc(100% - 10px);
    }


    .message-bubble {
        max-width: 70%;
        padding: 12px 16px;
        border-radius: 18px;
        margin-bottom: 8px;
        position: relative;
    }
    
    .message-owner {
        background-color: #e3f2fd;
        border-bottom-right-radius: 4px;
    }
    
    .message-other {
        background-color: #f5f5f5;
        border-bottom-left-radius: 4px;
    }
    
    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #4a6cf7;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
    }
    
    .user-avatar.sm {
        width: 32px;
        height: 32px;
        font-size: 12px;
    }
    
    .message-content {
        word-wrap: break-word;
    }
    
    #reviews-container {
        min-height: 400px;
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
                        <div class="d-flex justify-content-end">
                            <div class="message-bubble message-owner">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar sm">
                                            {{ substr(auth()->user()->name, 0, 1) }}{{ substr(auth()->user()->surname, 0, 1) }}
                                        </div>
                                        <div class="d-flex flex-column mx-2">
                                            <span class="fw-bold">{{ auth()->user()->name }} {{ auth()->user()->surname }}</span>
                                        </div>
                                    </div>
                                    <a href="#" class="delete-review text-danger" data-id="${data.review.id}">
                                        <em class="icon ni ni-trash"></em>
                                    </a>
                                </div>
                                <div class="message-content">
                                    <p class="mb-0">${data.review.message}</p>
                                </div>
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
