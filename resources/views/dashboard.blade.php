<html>

<head>
    {{-- <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.4/echo.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.2/dist/echo.iife.js"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>

    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>

</head>

<body>
    <h1 class="text-xl font-semibold mb-4">Markers Dashboard</h1>


    <button id="createMarkerButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create
        Marker</button>
    <br>
    <br>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="border-b border-gray-200 p-2 border-2">User</th>
                        {{-- <th class="border-b border-gray-200 p-2 border-2">Marker ID</th> --}}
                        <th class="border-b border-gray-200 p-2 border-2">Latitude</th>
                        <th class="border-b border-gray-200 p-2 border-2">Longitude</th>
                        <th class="border-b border-gray-200 p-2 border-2">Comment</th>
                        <th class="border-b border-gray-200 p-2 border-2">Response</th>
                    </tr>
                </thead>
                <tbody id="tableBody">

                </tbody>
            </table>
        </div>
    </div>

    <script>

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: 'key',
            cluster: 'mt1',
            forceTLS: true,
            wsHost: window.location.hostname,
            wsPort: 6001,
            wssPort: 6001,
            disableStats: true,
            
        });
        Echo.channel('marker-listener').listen("MarkerListener", (e) => {
            addRow(JSON.parse(e.marker))
        })

        const addRow = (data) => {
            const row = document.createElement('tr');
            row.innerHTML =
                '<td class="border-b border-gray-200 p-2 border-2">' + data.user.name +
                '</td><td class="border-b border-gray-200 p-2 border-2">' + data.lat +
                '</td><td class="border-b border-gray-200 p-2 border-2">' + data.lng +
                '</td><td class="border-b border-gray-200 p-2 border-2">' + data.comment +
                '</td><td class="border-b border-gray-200 p-2 border-2">' + data.response + '</td>';
            document.getElementById('tableBody').appendChild(row);
        };


        const createMarkerButton = document.getElementById('createMarkerButton');

        createMarkerButton.addEventListener('click', () => {
            fetch('/markers', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        userId: '{{ $userId }}',
                        _token: '{{ csrf_token() }}'
                    })
                })
                .then(response => response)
                .then(data => {

                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
</body>

</html>
