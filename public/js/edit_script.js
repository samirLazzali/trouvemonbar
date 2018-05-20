
function add_tr(obj) {
    var tr = $(obj).parent();
    tr.after(tr.clone());
}

function del_tr(obj) {
    $(obj).parent().remove();
}


