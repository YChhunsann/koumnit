<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <!-- Bootstrap Theme -->
    <link href="https://bootswatch.com/5/spacelab/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Font Awesome for Copy Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Highlight.js Style -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom Styles -->
    <style>
        .code-block {
            position: relative;
            margin-top: 1rem;
            margin-bottom: 1rem;
            border-radius: 10px;
            overflow: hidden;
        }

        .code-block pre,
        .code-block code {
            border-radius: 10px;
        }

        .code-block pre {
            margin: 0;
            padding: 1rem;
            background: #0d1117;
            color: #c9d1d9;
        }

        .copy-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 4px 8px;
            font-size: 12px;
            background-color: #ffffffcc;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            z-index: 2;
        }
    </style>
</head>

<body>
    @include('layout.nav')

    <div class="container py-4">
        @yield('content')
    </div>

    <!-- Highlight.js -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('pre code').forEach((el) => {
                hljs.highlightElement(el);
            });
        });
    </script>

    <!-- Copy Button Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('pre').forEach(pre => {
                // Skip if already wrapped
                if (pre.parentElement.classList.contains('code-block')) return;

                const wrapper = document.createElement('div');
                wrapper.className = 'code-block';

                // Move <pre> inside wrapper
                pre.parentNode.insertBefore(wrapper, pre);
                wrapper.appendChild(pre);

                const btn = document.createElement('button');
                btn.innerHTML = '<i class="fas fa-copy"></i>';
                btn.className = 'copy-btn';
                btn.title = 'Copy to clipboard';

                btn.onclick = () => {
                    navigator.clipboard.writeText(pre.innerText);
                    btn.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(() => btn.innerHTML = '<i class="fas fa-copy"></i>', 2000);
                };

                wrapper.appendChild(btn);
            });
        });
    </script>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <!-- Like Button Script (unchanged) -->
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
