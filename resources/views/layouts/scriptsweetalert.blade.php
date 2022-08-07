{{-- jalankan sweetalert setelah mentriger event livewire --}}
{{-- kenpa disini? karena harus setelah meload livewirescript --}}

{{-- <script>
    Swal.fire({
        title: 'Error!',
        text: 'Do you want to continue',
        icon: 'error',
        confirmButtonText: 'Cool'
    })
</script> --}}

<script>
    window.livewire.on('swalMessageError', info => {
        Swal.fire({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            icon: 'warning',
            title: 'Pesan error',
            text: info,
        });
        //$('#modalInput').modal('hide');
    })

    window.livewire.on('swalMessageErrorWithTimer', info => {
        Swal.fire({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: info.length*70,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            icon: 'warning',
            title: 'Pesan error',
            text: info,
        });
        //$('#modalInput').modal('hide');
    })
    
    window.livewire.on('swalAdded', counter => {
        Swal.fire({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            icon: 'success',
            title: 'Berhasil',
            text: 'berhasil menambahkan ' + counter + ' data!',
        });
        //$('#modalInput').modal('hide');
    })
    
    window.livewire.on('swalUpdated', () => {
        Swal.fire({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2000,
            //timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            icon: 'success',
            title: 'Berhasil',
            text: 'data telah diubah!',
            confirmButtonText: 'Oke',
        });
        //dropUpOpen=false;
        //$('#modalInput').modal('hide');
    })
    
    window.livewire.on('swalToDeleted', (tujuan, idhapus) => {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Anda akan menghapus data tersebut!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.value) {
                
                window.livewire.emit(tujuan, idhapus);
                
                Swal.fire(
                'Terhapus!',
                'data telah dihapus.',
                'success'
                )
                
            }
        });
    })
    
    window.livewire.on('swalToDeletedWithMessage', (tujuan, idhapus,message) => {
        Swal.fire({
            title: 'Anda yakin?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.value) {
                
                window.livewire.emit(tujuan, idhapus);
                
                Swal.fire(
                'Terhapus!',
                'data telah dihapus.',
                'success'
                )
                
            }
        });
    })
    
    
    
    window.livewire.on('tutupModal', () => {
        $('#modalInput').modal('hide');
    })
    
    
    window.livewire.on('swalAndaYakin', (tujuan, idModel, pesan) => {
        Swal.fire({
            title: 'Anda yakin?',
            text: pesan,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.value) {
                
                window.livewire.emit(tujuan, idModel);
                
                Swal.fire(
                'Berhasil!',
                'data telah diupdate.',
                'success'
                )
                
            }
        });
    })
    
    window.livewire.on('swalAndaYakinCeklis', (tujuan, pesan) => {
        Swal.fire({
            title: 'Anda yakin?',
            text: pesan,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.value) {
                
                window.livewire.emit(tujuan);
                
                Swal.fire(
                'Berhasil!',
                'data telah diupdate.',
                'success'
                )
                
            }
        });
    })
    
    
    // KHUSUS
    window.livewire.on('swalSelectPindahUnit', (currentUnit, option, idAnggota) => {
        
        const { value: fruit } = Swal.fire({
            title: 'Pindah Unit',
            text:"Unit sebelumnya : "+currentUnit,
            input: 'select',
            inputOptions: option,
            inputPlaceholder: 'Pilih unit baru',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                return 'Anda harus mengisinya!'
                }
            },
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('terkonfirmasiPindahUnit',result.value, idAnggota);
            }
        });

        
    })
    
    window.livewire.on('swalCheckboxPilihRole', (html, idAnggota) => {
        
        const { value: formValues } = Swal.fire({
            title: 'Pilih Role',
            html: '<div class="text-left px-2">'+html+'</div>',
            showCancelButton: true,
            focusConfirm: false,
            preConfirm: () => {}
        }).then((result)=>{
            if (result.value) {

                var hasilsatu;
                Array.prototype.forEach.call(document.getElementsByName('satu'), function(el) {
                    if(el.checked) hasilsatu=el.value
                })
                
                hasildua=[];
                Array.prototype.forEach.call(document.getElementsByClassName('divCheckboxRole'), function(el) {
                    if(el.childNodes['0'].checked) hasildua.push(el.childNodes['0'].value)
                })
                
                window.livewire.emit('terkonfirmasiEditRole',hasilsatu,hasildua, idAnggota)

            }
        })
        
        
    })



    window.livewire.on('swalMulaiKepengurusanBaru', (currentRole, idAnggota) => {

        const { value: text } = Swal.fire({
        title: 'Mulai Kepengurusan Baru',
        html:
        "<div class='text-left'>"
            +"<div><b class='text-red-300'>Perhatian </b>yang akan terjadi setelah anda menekan tombol ok adalah:</div>"
            +"<small><ul>"
                +"<li>"
                    +"1. Anggota yang tidak diinputkan, akan didemisionerkan semua. Semua demisioner berstatus nonaktif/pasif dan akan direset rolenya menjadi anggota. Kecuali untuk Korwil sebelumnya diganti rolenya tetap korwil|admin, karena dia akan memilih korwil baru nanti. Korwil akan berpindah ketika korwil baru sudah dipilih, dan korwil lama kemudian akan menjadi anggota|admin"
                +"</li>"
                +"<li>"
                    +"2. Semua anggota yang diinputkan, akan memiliki status aktif, dan akan memiliki role anggota sebagai awal."
                +"</li>"
                +"<li>"
                    +"3. Selanjutnya untuk mengatur role dan unit, dapat dilakukan manual pada kolom action."
                +"</li>"
            +"</ul></small>"
            +"<br><small>Pastikan anda menginput nama sesuai dengan database.</small>"
        +"</div>",
        input: 'textarea',
        inputLabel: 'Silahkan input nim semua pengurus aktif',
        inputPlaceholder: '53141312\n53141313\n53141311\n...\n(setiap baris untuk satu nama)',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        inputValidator: (value) => {
            if (!value) {
            return 'Anda harus mengisinya!'
            }
        },
        showCancelButton: true
        })
        .then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Tekan Ya jika sudah yakin",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, lanjutkan!'
                }).then((hasil) => {
                    if (hasil.value) {
                        
                        window.livewire.emit('terkonfirmasiKepengurusanBaru',result.value)
                        // Swal.fire(result.value)
                        
                        Swal.fire(
                        'Wait!',
                        'Nama-nama pengurus aktif sedang dibuat',
                        'info'
                        )
                        
                    }
                });

            }
        });

    })
    
    
    
    
    
    
</script>
