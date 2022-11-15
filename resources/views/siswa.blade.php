<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
  <body>
    <h1 class="text-center">Data Siswa</h1>

    <div class="container">
        <a href="/tambahsiswa" type="button" class="btn btn-success">Tambah +</a>
        <div class="row g-3 align-items-center mt-2">
            <div class="col-auto">
                <form action="/siswa" method="GET">
              <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline">
            </form>
            </div>
            <div class="col-auto">
                <a href="/exportpdf" class="btn btn-info">Export PDF</a>
            </div>
            <div class="col-auto">
                <a href="/exportexcel" class="btn btn-success">Export Excel</a>
            </div>

            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import Data
                  </button>
            </div>

            <!-- Button trigger modal -->


  <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="/importexcel" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                        </form>
            </div>
        </div>


          </div>
        <div class="row">
            {{-- @if($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                  </div>
            @endif --}}
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">No Telepon</th>
                    <th scope="col">Di buat</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Aksi</th>

                  </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($data as $index => $row)
                    <tr>
                        <th scope="row">{{ $index + $data->firstItem()}}</th>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->jeniskelamin }}</td>
                        <td>0{{ $row->notelpon }}</td>
                        <td>{{ $row->created_at->diffForHumans() }}</td>
                        <td>
                            <img src="{{ asset('fotosiswa/'.$row->foto) }}"  alt="" style="width: 50px;">
                        </td>

                        <td>
                            <a href="/tampilkandata/{{  $row->id  }}"  class="btn btn-info">Edit</a>
                            <a href="#"  class="btn btn-danger delete" data-id="{{ $row->id}}"  data-nama="{{ $row->nama}}">Hapus</a></td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $data->links() }}
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  </body>
  <script>

    $('.delete').click( function () {
        var siswaid = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        swal({
            title: "Yakin ?",
            text: "Kamu akan menghapus data siswa dengan nama "+nama+" ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location = "/hapusdata/"+siswaid+""
            swal("Data Berhasil dihapus", {
            icon: "success",
            });
        } else {
            swal("Data tidak jadi dihapus");
        }
        });
    });

  </script>
  <script>
    @if (Session::has('success'))
    toastr.success("{{ Session::get('success') }}")
    @endif
  </script>
</html>
