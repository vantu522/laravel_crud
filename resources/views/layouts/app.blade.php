<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trang chủ')</title>

    <!-- Web Font Loader -->
    <script src={{asset('assets/js/plugin/webfont/webfont.min.js')}}></script>
    <script>
        WebFont.load({
            google: { 
                families: ["Public Sans:300,400,500,600,700"] 
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular", 
                    "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["assets/css/fonts.min.css"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    {{-- config toast --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nav.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">


</head>
<body class="bg-gray-50 min-h-screen flex">
    <div class="flex w-full">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            @include('partials.sidebar')
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <nav class="bg-white shadow-sm " style="" >
                @include('partials.navbar')
            </nav>

            <!-- Page Content -->
            <main class="flex-1 p-6 bg-gray-50" >
                @yield('content')
            </main>

            <!-- Optional Footer -->
            <footer class="bg-white p-4 text-center text-gray-600">
                © {{ date('Y') }} Your Company Name
            </footer>
        </div>
    </div>
      <!-- Optional Scripts -->
      <script src={{asset('assets/js/core/jquery.3.2.1.min.js')}}></script>
      <script src={{asset('assets/js/core/bootstrap.min.js')}}></script>


    <!-- External CDN Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


    @stack('scripts')

    <!-- Toast Render -->
    <script>
        @if(session('success'))
            toastr.success('{{ session('success') }}');
        @endif
        @if(session('error'))
            toastr.error('{{ session('error') }}');
        @endif
    </script>
    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById('previewImage');
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
       <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300, // Chiều cao của editor
                placeholder: 'Nhập nội dung...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
   
</body>
</html>