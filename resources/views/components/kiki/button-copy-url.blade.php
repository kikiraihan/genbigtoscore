@props([
    'url'=>'https://www.example.com',
    'id'=>'1',
    'text'=>'',
])

<button id="cub_{{$id}}" class="hover:text-blue-500  flex">
    <span>
        {{$text}}
    </span>
    <span class="material-icons-outlined" style="font-size: 20px">
        link
    </span>
    <span class="badge badge-dark ml-2" id="copy-status-{{$id}}"></span>
</button>

<script>
    document.getElementById('cub_{{$id}}').addEventListener('click', function() {
        const fixedUrl = '{{$url}}';
        const statusSpan = document.getElementById('copy-status-{{$id}}');
        
        navigator.clipboard.writeText(fixedUrl).then(function() {
            const originalText = statusSpan.textContent;
            statusSpan.textContent = 'url disalin!';
            setTimeout(function() {
                statusSpan.textContent = originalText;
            }, 2000); // Ubah teks kembali setelah 2 detik
        }, function(err) {
            console.error('Gagal menyalin teks: ', err);
        });
    });
</script>
