@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-3">Search Users</h2>
            <input type="text" id="searchInput" class="form-control" placeholder="Search for users...">

            <!-- Results -->
            <ul id="searchResults" class="list-unstyled mt-4">
                <!-- Dynamic user results will appear here -->
            </ul>
            <a href=""></a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            let query = $(this).val();
            if (query.length > 1) {
                $.ajax({
                    url: "{{ route('search') }}",
                    type: 'GET',
                    data: { query: query },
                    success: function(response) {
                        $('#searchResults').empty();
                        if (response.length > 0) {
                            response.forEach(user => {
                                $('#searchResults').append(`
                                    <li class="mb-3">
                                        <div class="card shadow-sm" style="width: 100%; max-width: 100%; border-radius: 10px;">
                                            <div class="row g-0">
                                                <div class="col-md-2 d-flex justify-content-center align-items-center">
                                                     <a href="/profile/${user.id}" class="text-dark fw-bold text-decoration-none">
                                                        <img src="${user.profile_picture}" class="img-fluid rounded-circle" alt="${user.username}" style="max-width: 50px; height: auto;">
                                                    </a>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="card-body p-2">
                                                        <h5 class="card-title text-truncate" style="max-width: 80%;">${user.username}</h5>
                                                        <p class="card-text text-truncate" style="max-width: 100%; font-size: 0.9rem; color: #555;">${user.bio || 'No bio available'}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                `);
                            });
                        } else {
                            $('#searchResults').append('<li>No users found</li>');
                        }
                    }
                });
            } else {
                $('#searchResults').empty();
            }
        });
    });
</script>
@endsection
