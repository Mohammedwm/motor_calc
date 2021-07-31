function massAlert(type,title){ //success , info , warning , error
    toastr.options = {
        progressBar: true,
        timeOut : 3000,
        showEasing : 'swing',
        hideEasing : 'linear',
        showMethod : 'fadeIn',
        hideMethod : 'fadeOut',
        showDuration : 300,
        hideDuration : 1000,
        extendedTimeOut : 1000,
    };

    toastr[type](null,title);
}
