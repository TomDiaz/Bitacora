function alertError(errores){

    let nota = '<ul>'

    errores.forEach(element => {
       nota += `<li>${element}</li>` 
    })

    nota += '</ul>'

    console.log(nota)

    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      html: nota,
      type:'error',
      customClass: 'error',
      showConfirmButton: false,

    })

   }