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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .copy-btn {
            position: absolute;
            top: 8px;
            right: 10px;
            padding: 4px 8px;
            font-size: 12px;
            background-color: #f3f3f3;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .code-block {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            /* ensures child elements stay within rounded corners */
        }

        /* Apply same radius to pre and code elements */
        .code-block pre,
        .code-block code {
            border-radius: 15px;
        }

        /* Optional: remove any margin/padding overflow that may break the curve */
        .code-block pre {
            margin: 0;
            padding: 1rem;
        }
    </style>
</head>

<body>
    @include('layout.nav')
    <div class="container py-4">
        @yield('content')
    </div>
    <!-- Highlight.js (required for syntax highlighting) -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('pre code').forEach((el) => {
                hljs.highlightElement(el);
            });
        });
    </script>

    <!-- Copy Button Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('pre').forEach(pre => {
                const btn = document.createElement('button');
                btn.innerHTML = '<i class="fas fa-copy"></i>';
                btn.className = 'copy-btn';
                btn.title = 'Copy to clipboard';

                btn.onclick = () => {
                    navigator.clipboard.writeText(pre.innerText);
                    btn.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(() => btn.innerHTML = '<i class="fas fa-copy"></i>', 2000);
                };

                const wrapper = document.createElement('div');
                wrapper.className = 'code-block';
                pre.parentNode.insertBefore(wrapper, pre);
                wrapper.appendChild(pre);
                wrapper.appendChild(btn);
            });
        });
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('pre code').forEach((el) => {
                hljs.highlightElement(el);
            });
        });
    </script>

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
