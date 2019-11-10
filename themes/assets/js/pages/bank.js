base_url = window.location.origin;

function hapus(id)
{
	swal({
	  title: "Apakah Anda Yakin",
	  text: "Ingin Menghapus Data Ini?",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	    window.location.href = base_url+"/soalpedia/members/bank/delete/"+id;
	  } else {
	    swal("Your imaginary file is safe!");
	  }
	});
}