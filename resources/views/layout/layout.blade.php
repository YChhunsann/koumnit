<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <link href="https://bootswatch.com/5/spacelab/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    @include('layout.nav')
    <div class="container py-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.like-button').forEach(button => {
                button.addEventListener('click', async (e) => {
                    e.preventDefault();

                    const koumnitId = button.dataset.id;
                    const liked = button.dataset.liked === '1';
                    const url = liked ?
                        `/koumnits/${koumnitId}/unlike` :
                        `/koumnits/${koumnitId}/like`;

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                'Accept': 'application/json',
                            },
                        });

                        if (response.ok) {
                            const data = await response.json();

                            // Toggle like icon and count
                            button.dataset.liked = liked ? '0' : '1';
                            button.innerHTML = `
                            <span class="${liked ? 'far' : 'fas'} fa-heart me-1 ${liked ? '' : 'text-danger'}"></span>
                            <span class="like-count">${data.likes}</span>
                        `;
                        } else {
                            console.error('Error toggling like:', await response.text());
                        }
                    } catch (error) {
                        console.error('Network error:', error);
                    }
                });
            });
        });
    </script>

</body>

</html>
