@props([
    'url'=>'https://www.example.com',
    'id'=>'1',
    'text'=>'',
])

<button id="cub_{{$id}}" class="hover:text-blue-500  flex">
    <span>
        {{$text}}
    </span>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
      </svg>
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
