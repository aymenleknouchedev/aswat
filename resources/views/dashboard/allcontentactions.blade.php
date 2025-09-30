@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع إجراءات المحتوى')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')

            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container">

                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview">
                                <table class="table table-orders">
                                    <tbody class="tb-odr-body">
                                        @forelse ($contentActions as $action)
                                            <tr class="tb-odr-item">
                                                <td>
                                                    @if ($action->action_type === 'update')
                                                        <span class="badge badge-primary p-1">
                                                            {{ $action->action_type }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger bg-danger p-1">
                                                            {{ $action->action_type }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{ $action->user->name }} \ {{ $action->user->email }}</td>
                                                <td>{{ $action->content->title }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center" data-en="No actions found" data-ar="لا توجد إجراءات">
                                                    لا توجد إجراءات
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
