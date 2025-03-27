@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center">
    <div class="p-4 p-lg-5 text-center text-lg-start border rounded-lg w-100">
        <h1 class="mb-2">Welcome to tings</h1>
        <p class="text-muted">Laravel has an incredibly rich ecosystem.<br>We suggest starting with the following.</p>
        
        <ul class="list-unstyled">
            <li class="d-flex align-items-center mb-3">
                <span class="d-inline-flex align-items-center justify-content-center border rounded-circle me-3" style="width: 24px; height: 24px; border-color: #e3e3e0;">
                    <span class="bg-secondary rounded-circle" style="width: 10px; height: 10px;"></span>
                </span>
                <span>
                    Read the 
                    <a href="https://laravel.com/docs" target="_blank" class="text-danger fw-semibold text-decoration-underline">
                        Documentation
                        <svg width="12" height="12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.5 6V2H5M4 9l5-5"/>
                        </svg>
                    </a>
                </span>
            </li>
        </ul>

        <a href="https://cloud.laravel.com" target="_blank" class="btn btn-dark">
            Deploy now
        </a>
    </div>
</div>
@endsection

@if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
@endif
