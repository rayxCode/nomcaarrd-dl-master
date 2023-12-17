
@if ($errors->any())
        <script>
            Swal.fire({
                title: "Validation Error!",
                html: `<ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>`,
                icon: "error"
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success!",
                text: "{!! htmlspecialchars(session('success')) !!}",
                icon: "success"
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            Swal.fire({
                title: "Oops...",
                text: "{!! htmlspecialchars(session('info')) !!}",
                icon: "warning"
            });
        </script>
    @endif
    <!-- Sweet alert2-->

